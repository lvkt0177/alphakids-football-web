<?php

namespace App\Enums;

enum RegistrationStatus: int
{
    case PENDING = 0;
    case REGISTERED = 1;
    case NOT_REGISTERED = 2;
    case NOT_EXPERIENCED = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Truy cứu',
            self::REGISTERED => 'Đã đăng ký',
            self::NOT_REGISTERED => 'Không đăng ký',
            self::NOT_EXPERIENCED => 'Chưa trải nghiệm',
        };
    }

    public function getBadge(): string
    {
        return match ($this) {
            self::PENDING => 'purple',
            self::REGISTERED => 'green',
            self::NOT_REGISTERED => 'red',
            self::NOT_EXPERIENCED => 'gray',
        };
    }
}