<?php

namespace App\Day01\Command;

use App\Common\Command\CommonDayCommand;
use App\Day01\Elf;
use SplFileObject;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
name: 'app:day01',
description: 'Day 01',
)]
class Day01Command extends CommonDayCommand
{
    protected const DAY = "01";

    private array $elves = [];

    protected function common(): void
    {
        $file = new SplFileObject($this->inputFilename, "r");
        $elf = new Elf();
        while (!$file->eof()) {
            $calorie = (int) $file->current();

            if ($calorie === 0) {
                $this->elves[] = $elf;
                $elf = new Elf();
            } else {
                $elf->append($calorie);
            }

            $file->next();
        }

        usort($this->elves, function (Elf $elf1, Elf $elf2): int {
            if ($elf1->getCalories() === $elf2->getCalories()) {
                return 0;
            }

            return ($elf1->getCalories() > $elf2->getCalories()) ? -1 : 1;
        });
    }

    protected function part1(): void
    {
        $elf = reset($this->elves);
        $this->io->success($elf->getCalories());
    }

    protected function part2(): void
    {
        $first3CaloriesSum = 0;
        foreach (array_slice($this->elves, 0, 3) as $elf) {
            $first3CaloriesSum += $elf->getCalories();
        }
        $this->io->success($first3CaloriesSum);
    }
}