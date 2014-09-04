<?php
namespace Phoreman\Console\Command;

use Phoreman\Procfile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Run
 */
class RunCommand extends Command
{

    protected function configure()
    {
        $this->setName('run')
             ->setDescription('run command NOT IMPLEMENTED')
              ->setHelp('is used to run one-off commands using the same environment as your defined processes.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $output->writeln('NOT IMPLEMENTED YET');
    }
}
