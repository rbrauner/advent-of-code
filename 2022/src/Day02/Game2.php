<?php

declare(strict_types=1);

namespace App\Day02;

class Game2 extends Game
{
    public function __construct(
        protected string $elf,
        protected string $you,
    )
    {
        parent::__construct($elf, $you);

        $this->changeYourType();
    }

    protected function changeYourType(): void
    {
        if ($this->yourType === Type::ROCK) {
            $this->needToLose();
        } else if ($this->yourType === Type::PAPER) {
            $this->needToDraw();
        } else if ($this->yourType === Type::SCISSORS) {
            $this->needToWin();
        }
    }

    protected function needToLose(): void
    {
        $this->yourType = match ($this->elfType) {
            Type::SCISSORS => Type::PAPER,
            Type::PAPER => Type::ROCK,
            Type::ROCK => Type::SCISSORS,
        };
    }

    protected function needToDraw(): void
    {
        $this->yourType = $this->elfType;
    }

    protected function needToWin(): void
    {
        $this->yourType = match ($this->elfType) {
            Type::SCISSORS => Type::ROCK,
            Type::PAPER => Type::SCISSORS,
            Type::ROCK => Type::PAPER,
        };
    }
}