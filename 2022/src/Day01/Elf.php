<?php

declare(strict_types=1);

namespace App\Day01;

class Elf
{
    public function __construct(
        private int $calories = 0
    )
    {
    }

    public function append(int $calorie): void
    {
        $this->calories += $calorie;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }
}