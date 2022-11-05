<?php

namespace Rusinov\Ex2\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FirstCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output)
    {
       $output->write("Hello world!");
    }

    public static function getDefaultName(): ?string
    {
        return "HW";
    }

    public static function getDefaultDescription(): ?string
    {
        return "This command just print 'Hello World'";
    }
}