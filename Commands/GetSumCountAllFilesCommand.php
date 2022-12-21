<?php

namespace Console\Commands;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GetSumCountAllFilesCommand extends Command
{

    private $sumAll = 0;
    protected function configure()
    {
        $this->setName("app:get-sum")
            ->setDescription('Get all sum count all nested directories')
            ->addArgument('dir', InputArgument::REQUIRED, 'directory ');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = $input->getArgument('dir');
        $this->getReqSumCount($dir);
        $output->writeln("сумма чисел в файлах count = {$this->sumAll}");
        return Command::SUCCESS;
    }

    private function getReqSumCount($dir)
    {
        $files = array_diff(scandir($dir), ['..', '.']);
        foreach ($files as $file) {
            $path = $dir. '/'. $file;
            if (is_dir($path)) {
                return $this->getReqSumCount($path);
            } else {
                $countFile = file($path);
                if (!empty($countFile)) {
                    $this->sumAll += array_sum(explode(' ', $countFile[0]));
                }
            }
        }
    }
}


