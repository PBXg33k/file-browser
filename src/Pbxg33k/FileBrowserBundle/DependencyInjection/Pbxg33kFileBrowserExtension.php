<?php

namespace Pbxg33k\FileBrowserBundle\DependencyInjection;

use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\FileBrowserBundle\Filter\FilterInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class Pbxg33kFileBrowserExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if(strpos($config['mount_manager'],'@') === 0) {
            $serviceIdentifier = substr($config['mount_manager'], 1);
            $container->setParameter('pbxg33k_file_browser_mount_manager', $serviceIdentifier);
        } else {
            throw new InvalidArgumentException('Invalid mount_manager service');
        }

        $container->setParameter('pbxg33k_file_browser_mounts', $config['filesystem']);
        $container->setParameter('pbxg33k_file_browser_filters', $config['filters']);
    }
}
