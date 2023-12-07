<?php

namespace App\Day02\Command;

use App\Common\Command\CommonDayCommand;
use App\Day02\Game;
use App\Day02\Game2;
use SplFileObject;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
name: 'app:day02',
description: 'Day 02',
)]
class Day02Command extends CommonDayCommand
{
    protected const DAY = "02";

    private array $data = [];

    protected function common(): void
    {
        $file = new SplFileObject($this->inputFilename, "r");
        while (!$file->eof()) {
            $line = $file->current();
            preg_match("/(?<elf>\w) (?<you>\w)/", $line, $matches);

            $this->data[] = [
                'elf' => $matches['elf'],
                'you' => $matches['you'],
            ];

            $file->next();
        }

    }

    protected function part1(): void
    {
        $yourScore = 0;

        foreach ($this->data as $value) {
            $game = new Game($value['elf'], $value['you']);
            $yourScore += $game->getYourScore();
        }

        $this->io->success($yourScore);
    }

    protected function part2(): void
    {
        $yourScore = 0;

        foreach ($this->data as $value) {
            $game = new Game2($value['elf'], $value['you']);
            $yourScore += $game->getYourScore();
        }

        $this->io->success($yourScore);
    }
}