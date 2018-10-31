<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\DataFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BeerCallCommand extends Command
{
    protected $output;
    protected $dataFetcher;

    public function __construct(DataFetcher $dataFetcher)
    {
        parent::__construct();

        $this->dataFetcher = $dataFetcher;
    }

    protected function configure(): void
    {
        $this->setName('app:beer:import')
            ->setDescription('Runs brewery API call');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $result = $this->dataFetcher->fetch();

        if (0 === $result) {
            $this->output->writeln('Something went wrong. Data was not imported');
        } else {
            $this->output->writeln('All data was imported succesfully');
        }
    }
}
