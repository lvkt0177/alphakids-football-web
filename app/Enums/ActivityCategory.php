<?php

namespace App\Enums;

enum ActivityCategory: string
{
    case TOURNAMENT = 'tournament';
    case MEETUP = 'meetup';
    case FAMILY_DAY = 'family_day';

    public function getLabel(): string
    {
        return match ($this) {
            self::TOURNAMENT => 'Giải đấu',
            self::MEETUP => 'Giao lưu',
            self::FAMILY_DAY => 'Alpha Together',
        };
    }
}
