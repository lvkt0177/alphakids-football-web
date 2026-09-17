<?php

namespace App\Enums;

enum ReferralSource: string
{
    case SCHOOL_FLYER = 'school_flyer';
    case REFERRAL = 'referral';
    case WEBSITE_SEARCH = 'website_search';
    case FACEBOOK = 'facebook';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::SCHOOL_FLYER => 'Tờ rơi trường học',
            self::REFERRAL => 'Người quen giới thiệu',
            self::WEBSITE_SEARCH => 'Tìm kiếm Website',
            self::FACEBOOK => 'Facebook',
            self::OTHER => 'Khác',
        };
    }
}
