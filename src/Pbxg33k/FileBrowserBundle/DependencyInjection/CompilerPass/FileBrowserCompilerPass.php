<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 10:09 PM
 */

namespace Pbxg33k\FileBrowserBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FileBrowserCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $fileBrowser = $container->getDefinition('pbxg33k_file_browser');

        $filters = $container->getParameter('pbxg33k_file_browser_filters');
        foreach ($filters as $filter)
        {
            $fileBrowser->addMethodCall('addFilterFromConfig', [$filter]);
        }

        $mounts = $container->getParameter('pbxg33k_file_browser_mounts');

        foreach($mounts as $mount)
        {
            $fileBrowser->addMethodCall('addMountFromConfig',[$mount]);
        }
    }
}