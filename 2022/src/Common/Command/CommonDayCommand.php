<?php

namespace App\Common\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class CommonDayCommand extends Command
{
    protected string $inputFilename;
    protected SymfonyStyle $io;

    protected const DAY = "";

    public function __construct(string $name = null, KernelInterface $kernel = null)
    {
        parent::__construct($name);
        $this->inputFilename = $kernel->getProjectDir() . "/data/" . $this::DAY . "/input.txt";
    }

    protected function configure(): void
    {
        $this
            ->addOption('part', 'p', InputOption::VALUE_REQUIRED, 'Part of day')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);

        $part = (int) $input->getOption('part');
        if (!in_array($part, [1, 2])) {
            $this->io->note("Part of day can only be a 1 or 2.");
        }

        $partMethod = "part$part";

        $this->common();
        $this->$partMethod();

        $this->io->success('SUCCESS');

        return Command::SUCCESS;
    }

    protected function common(): void
    {
    }

    protected function part1(): void
    {
    }

    protected function part2(): void
    {
    }
}