<?php

namespace App\Enums;

enum Faculty: int
{
    case FaCET = 1;
    case FHuSoCom = 2;
    case FALS = 3;
    case FCJE  = 4;
    case FBM   = 5;
    case FNAHS  = 6;
    case FTED  = 7;
    case OTHERS  = 8;
    

    public function label(): string
    {
        return match ($this) {
            self::FaCET => 'FaCET',
            self::FHuSoCom => 'FHuSoCom',
            self::FALS => 'FALS',
            self::FCJE => 'FCJE',
            self::FBM => 'FBM',
            self::FNAHS => 'FNAHS',
            self::FTED => 'FTED',
            self::OTHERS => 'OTHERS',
        };
    }
}
