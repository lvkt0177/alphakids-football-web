<?php

namespace App\Models;

use App\Enums\ScheduleLevel;
use App\Traits\HasUniqueSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory, HasUniqueSlug;

    public const DAY_ORDER = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'];

    public const DAY_TO_SCHEMA = [
        'Thứ 2' => 'Monday',
        'Thứ 3' => 'Tuesday',
        'Thứ 4' => 'Wednesday',
        'Thứ 5' => 'Thursday',
        'Thứ 6' => 'Friday',
        'Thứ 7' => 'Saturday',
        'Chủ Nhật' => 'Sunday',
    ];

    protected $fillable = [
        'name',
        'location',
        'slug',
        'address',
        'description',
        'image',
        'features',
        'schedule',
        'map_embed_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'schedule' => 'array',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Group the flat {day, start, end} rows by day (each day can carry more than
     * one time slot), ordered Thứ 2 -> Chủ Nhật regardless of the order they were
     * entered in the admin repeater.
     */
    public function scheduleByDay(): array
    {
        $grouped = collect($this->schedule ?? [])
            ->filter(fn ($row) => ! empty($row['day']))
            ->groupBy('day')
            ->map(fn ($rows, $day) => [
                'day' => $day,
                'times' => $rows->map(fn ($row) => [
                    'start' => $row['start'] ?? '',
                    'end' => $row['end'] ?? '',
                    'level' => ScheduleLevel::tryFrom($row['level'] ?? '')?->getLabel(),
                ])->values()->all(),
            ]);

        return collect(self::DAY_ORDER)
            ->map(fn ($day) => $grouped->get($day))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * The card heading prefixes location with "Cơ sở {n}:" already, so a location
     * value that itself starts with "Cơ sở" (very likely - that's the field's own
     * label, and it's exactly what got typed into the seeded data) would repeat the
     * word right next to itself. Strip that redundant lead-in rather than trusting
     * every admin to remember not to type it.
     */
    public function displayLocation(): ?string
    {
        if (! $this->location) {
            return null;
        }

        $stripped = preg_replace('/^\s*cơ\s+sở\s*[:\-–]?\s*/iu', '', $this->location);

        return $stripped !== '' ? $stripped : $this->location;
    }

    /**
     * Prefer the place the admin actually searched for and pasted the embed
     * code of, over re-searching the free-text address.
     */
    public function mapsSearchUrl(): ?string
    {
        if ($url = $this->mapsEmbedPlaceUrl()) {
            return $url;
        }

        if (! $this->address) {
            return null;
        }

        return 'https://www.google.com/maps/search/?api=1&query='.urlencode($this->address);
    }

    /**
     * The embed URL's `pb` param carries two different coordinates, and only one
     * of them is trustworthy. `!1s0x{feature}:0x{cid}` is Google's verified Place
     * ID for whatever the admin actually searched and embedded (a name is
     * base64-encoded right after it) - `maps.google.com/?cid=` resolves straight
     * to that exact business listing. `!2d{lng}!3d{lat}` is just the map
     * viewport's center at the moment "Embed a map" was clicked, which drifts
     * off the real pin if the admin panned/zoomed first - kept only as a
     * second-choice fallback, not the primary source. No `pb` match (or no
     * embed link at all) falls through to the address text search.
     */
    protected function mapsEmbedPlaceUrl(): ?string
    {
        if (! $this->map_embed_url) {
            return null;
        }

        if (preg_match('/!1s0x[0-9a-fA-F]+(?:%3A|:)0x([0-9a-fA-F]+)!2[sz]/', $this->map_embed_url, $matches)
            && ! preg_match('/^0+$/', $matches[1])) {
            return 'https://www.google.com/maps?cid='.$this->hexToDecimal($matches[1]);
        }

        if (preg_match('/!2d(-?\d+\.\d+)!3d(-?\d+\.\d+)/', $this->map_embed_url, $matches)) {
            return 'https://www.google.com/maps/search/?api=1&query='.$matches[2].','.$matches[1];
        }

        return null;
    }

    /**
     * CIDs are 64-bit and routinely set their high bit (e.g. 0xc5d4...), which
     * overflows hexdec() into float and silently mangles the value. GMP isn't
     * installed on this box; bcmath is, so convert digit-by-digit through it
     * instead of trusting hexdec() with anything wider than 63 bits.
     */
    protected function hexToDecimal(string $hex): string
    {
        $decimal = '0';

        foreach (str_split(strtolower($hex)) as $digit) {
            $decimal = bcadd(bcmul($decimal, '16'), (string) hexdec($digit));
        }

        return $decimal;
    }

    /**
     * One OpeningHoursSpecification entry per real {day, start, end} row - a day
     * with two time slots becomes two specs sharing the same dayOfWeek, which is
     * how schema.org expects multiple windows on one day to be expressed.
     */
    public function openingHoursSchema(): array
    {
        $specs = [];

        foreach ($this->schedule ?? [] as $row) {
            $dayOfWeek = self::DAY_TO_SCHEMA[$row['day'] ?? ''] ?? null;

            if (! $dayOfWeek || empty($row['start']) || empty($row['end'])) {
                continue;
            }

            $specs[] = [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'https://schema.org/'.$dayOfWeek,
                'opens' => $row['start'],
                'closes' => $row['end'],
            ];
        }

        return $specs;
    }

    /**
     * SportsActivityLocation (a LocalBusiness subtype) built entirely from real
     * Admin-entered data - no invented hours, address, or description. Fields
     * with nothing behind them are simply omitted rather than sent empty.
     */
    public function structuredData(): array
    {
        $data = [
            '@type' => 'SportsActivityLocation',
            'name' => $this->name,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $this->address,
            ],
        ];

        if ($this->description) {
            $data['description'] = $this->description;
        }

        if ($this->image) {
            $data['image'] = asset('storage/'.$this->image);
        }

        if ($mapsUrl = $this->mapsSearchUrl()) {
            $data['hasMap'] = $mapsUrl;
        }

        if ($hours = $this->openingHoursSchema()) {
            $data['openingHoursSpecification'] = $hours;
        }

        return $data;
    }

    /**
     * Google's own "Share > Embed a map" dialog gives you the whole <iframe> tag to
     * copy, not the bare src URL the field label asks for - admins pasting that
     * verbatim is the expected mistake, not an edge case. Extract the src if a full
     * tag comes in; store the URL as-is otherwise.
     */
    public function setMapEmbedUrlAttribute(?string $value): void
    {
        if ($value !== null && preg_match('/<iframe[^>]*\ssrc=["\']([^"\']+)["\']/i', $value, $matches)) {
            $value = html_entity_decode($matches[1]);
        }

        $this->attributes['map_embed_url'] = $value !== null ? trim($value) : null;
    }
}