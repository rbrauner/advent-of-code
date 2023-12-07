<?php

declare(strict_types=1);

namespace App\Day02;

class Game
{
    protected Type $yourType;
    protected Type $elfType;

    public function __construct(
        protected string $elf,
        protected string $you,
    )
    {
        $this->elfType = Type::create($this->elf);
        $this->yourType = Type::create($this->you);
    }

    public function getYourScore(): int
    {
        $score = 0;

        $score += match ($this->yourType) {
            Type::ROCK => 1,
            Type::PAPER => 2,
            Type::SCISSORS => 3,
        };

        if ($this->hasWon()) {
            $score += 6;
        } else if ($this->isDraw()) {
            $score += 3;
        } else if ($this->hasLost()) {
            $score += 0;
        }

        return $score;
    }

    protected function hasWon() :bool
    {

        if ($this->yourType === Type::ROCK && $this->elfType === Type::SCISSORS) {
            return true;
        }

        if ($this->yourType === Type::PAPER && $this->elfType === Type::ROCK) {
            return true;
        }

        if ($this->yourType === Type::SCISSORS && $this->elfType === Type::PAPER) {
            return true;
        }

        return false;
    }

    protected function isDraw() :bool
    {
        return $this->elfType === $this->yourType;
    }

    protected function hasLost() :bool
    {
        return !$this->hasWon();
    }
}