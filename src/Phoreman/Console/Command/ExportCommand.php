<?php
namespace Phoreman\Console\Command;

use Phoreman\Procfile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Export
 */
class ExportCommand extends Command
{

  protected function configure()
  {
      $this->setName('export')
           ->setDescription('export command NOT IMPLEMENTED And probably never will. Use foreman')
            ->setHelp('is used to export your application to another process management format.');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
      
      $output->writeln('NOT IMPLEMENTED');
  }
}
