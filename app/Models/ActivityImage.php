<?php

namespace App\Models;

use App\Enums\ActivityMediaType;
use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    protected $fillable = [
        'activity_id',
        'image',
        'type',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'type' => ActivityMediaType::class,
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function isVideo(): bool
    {
        return $this->type === ActivityMediaType::VIDEO;
    }
}
