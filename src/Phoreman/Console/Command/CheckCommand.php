<?php
namespace Phoreman\Console\Command;

use Phoreman\Procfile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Run
 */
class CheckCommand extends Command
{

    protected function configure()
    {
        $this->setName('check')
             ->setDescription('check command NOT IMPLEMENTED')
              ->setHelp('Validate your application\'s Procfile');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $output->writeln('NOT IMPLEMENTED YET');
    }
}
