<?php


namespace Rusinov\Ex2\CP;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class cp1  implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        //$container->register('t2', (new Reference( 't1' )))->setPublic(true);
        $container->setAlias('t2', 't1')->setPublic(true);
    }
}