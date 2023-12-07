<?php

declare(strict_types=1);

namespace App\Day01\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(name: 'app:day-01')]
final class Day01Command extends Command
{
    private string $inputFilename;
    private ?SymfonyStyle $io = null;
    private array $data = [];

    public function __construct(KernelInterface $kernel)
    {
        parent::__construct();
        $this->inputFilename = $kernel->getProjectDir() . "/data/01/input.txt";
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->io = new SymfonyStyle($input, $output);

            $this->loadData();
            $this->part1();
            $this->part2();

            return Command::SUCCESS;
        } catch (\Throwable $th) {
            dump($th);
            return Command::FAILURE;
        }
    }

    private function loadData(): void
    {
        $this->io->writeln('Loading data...');
        $file = new \SplFileObject($this->inputFilename);

        while ($file->valid()) {
            $line = $file->current();
            if ($line === '') {
                continue;
            }
            $line = trim($line);
            $lineArray = str_split($line);
            $this->data[] = $lineArray;
            $file->next();
        }
    }

    private function part1(): void
    {
        $this->io->writeln('Part 1');

        $sum = 0;
        foreach ($this->data as $line) {
            foreach ($line as $k => $v) {
                if (is_numeric($v)) {
                    continue;
                }

                unset($line[$k]);
            }

            if (count($line) === 0) {
                continue;
            }

            $number = (int) reset($line) * 10 + (int) end($line);
            $sum += $number;
        }

        $this->io->writeln("Result for part 1: {$sum}");
    }

    private function part2(): void
    {
        $this->io->writeln('Part 2');
    }
}