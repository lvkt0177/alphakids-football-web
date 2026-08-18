<?php

namespace App\Models;

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
                'times' => $rows->map(fn ($row) => ['start' => $row['start'] ?? '', 'end' => $row['end'] ?? ''])->values()->all(),
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

    public function mapsSearchUrl(): ?string
    {
        if (! $this->address) {
            return null;
        }

        return 'https://www.google.com/maps/search/?api=1&query='.urlencode($this->address);
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