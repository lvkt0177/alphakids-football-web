<?php

namespace App\Enums;

enum ScheduleLevel: string
{
    case MAM_NON = 'mam_non';
    case TIEU_HOC = 'tieu_hoc';

    public function getLabel(): string
    {
        return match ($this) {
            self::MAM_NON => 'Mầm non',
            self::TIEU_HOC => 'Tiểu học',
        };
    }
}
