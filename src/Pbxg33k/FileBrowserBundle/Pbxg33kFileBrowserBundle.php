<?php

namespace Pbxg33k\FileBrowserBundle;

use Pbxg33k\FileBrowserBundle\DependencyInjection\CompilerPass\FileBrowserCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Pbxg33kFileBrowserBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FileBrowserCompilerPass());
    }
}
