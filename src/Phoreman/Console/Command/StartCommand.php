<?php
namespace Phoreman\Console\Command;

use Phoreman\Procfile;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Start process(es)
 */
class StartCommand extends Command
{

    protected function configure()
    {
        $this->setName('start')
             ->setDescription('Start processes')
             ->setDefinition(array(
              new InputOption('concurrency', 'c', InputOption::VALUE_NONE, 'Specify the number of each process type to run. The value passed in should be in the format process=num,process=num'),
              new InputOption('env', 'e', InputOption::VALUE_NONE, 'Specify one or more .env files to load'),
              new InputOption('procfile', 'f', InputOption::VALUE_NONE, 'Specify an alternate Procfile to load, implies -d at the Procfile root.'),
              new InputOption('port', 'p', InputOption::VALUE_NONE, 'Specify which port to use as the base for this application. Should be a multiple of 1000.'),
              new InputOption('root', 'd', InputOption::VALUE_NONE, '    Specify an alternate application root. This defaults to the directory containing the Procfile.'),
              new InputArgument('processes', InputArgument::IS_ARRAY, 'Space-separated process to start', null),
        ))
               
              ->setHelp('Phoreman start is used to run your application directly from the command line.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $procfile = new Procfile();
        $procfile->set_concurrency($input->getOption('concurrency'));
//        $procfile->set_env($input->getOption('env')); //not implemented yet
//        $procfile->set_port($input->getOption('port')); //not implemented yet
        $procfile->set_procfile($input->getOption('procfile'));
        $procfile->set_root($input->getOption('root'));
        $procfile->start($input->getArgument('processes'));
    }
}
