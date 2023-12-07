<?php

declare(strict_types=1);

namespace App\Day02;

enum Type
{
    case ROCK;
    case PAPER;
    case SCISSORS;

    public static function create(string $c): Type
    {
        return match ($c) {
            "A", "X" => self::ROCK,
            "B", "Y" => self::PAPER,
            "C", "Z" => self::SCISSORS,
        };
    }
}