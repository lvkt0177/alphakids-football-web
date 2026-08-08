<?php

namespace App\Models;

use App\Enums\RegistrationStatus;
use App\Traits\SearchableUnaccented;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Registration extends Model
{
    use HasFactory, SearchableUnaccented;

    protected $table = 'registrations';

    protected $fillable = [
        'child_name',
        'birth_year',
        'phone',
        'trial_date',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => RegistrationStatus::class,
        'trial_date' => 'date',
    ];

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(
            Branch::class,
            'branch_registration',
            'registration_id',
            'branch_id'
        )->withTimestamps();
    }
}