<?php

namespace App\Command;

use App\Service\CallApiService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'call-api',
    description: 'Add a short description for your command',
)]
class CallApiCommand extends Command
{
    const API_URL_BASE = 'https://dragonball-api.com/api/';

    const API_URL_PLANETS = 'planets/';
    const API_URL_CARACTERS = 'characters/';
    private $httpClient;
    public function __construct(HttpClientInterface $client)
    {
        $this->httpClient = $client;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $callApiService = new CallApiService($this->httpClient);
        // Appel API Planet
        for ($i = 1; $i < 2; $i++) {
            $data = $callApiService->getPlanetData($i);
            echo json_encode($data, true);
        }
        // Appel API character
        for ($i = 1; $i < 58; $i++) {
            $data = $callApiService->getCharacterData($i);
            echo json_encode($data, true);
            echo "character " . $i . " \n";
        }

        // $io->success($callApiService);
        /*
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }
        */
        // Message en cas de succes
        //$io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
