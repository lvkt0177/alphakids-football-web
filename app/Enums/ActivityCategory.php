<?php

namespace App\Enums;

enum ActivityCategory: string
{
    case TOURNAMENT = 'tournament';
    case MEETUP = 'meetup';
    case WORKSHOP = 'workshop';
    case SUMMER_CAMP = 'summer_camp';
    case FAMILY_DAY = 'family_day';
    case CHARITY = 'charity';

    public function getLabel(): string
    {
        return match ($this) {
            self::TOURNAMENT => 'Giải đấu',
            self::MEETUP => 'Giao lưu',
            self::WORKSHOP => 'Workshop',
            self::SUMMER_CAMP => 'Summer Camp',
            self::FAMILY_DAY => 'Ngày hội gia đình',
            self::CHARITY => 'Thiện nguyện',
        };
    }
}
