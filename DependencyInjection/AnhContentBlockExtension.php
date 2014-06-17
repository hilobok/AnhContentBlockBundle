<?php

namespace Anh\ContentBlockBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AnhContentBlockExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (empty($config['positions'])) {
            throw new \InvalidArgumentException(
                sprintf('You should define at least one position for content blocks.')
            );
        }

        $container->setParameter('anh_content_block.positions', $config['positions']);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $container->prependExtensionConfig('assetic', array(
            'bundles' => array(
                'AnhContentBlockBundle'
            )
        ));

        $container->prependExtensionConfig('sp_bower', array(
            'assetic' => array(
                'enabled' => false
            ),
            'bundles' => array(
                'AnhContentBlockBundle' => null
            )
        ));

        $container->prependExtensionConfig('anh_doctrine_resource', array(
            'resources' => array(
                'anh_content_block.block' => array(
                    'model' => '%anh_content_block.entity.block.class%',
                    'driver' => 'orm'
                ),
            )
        ));
    }
}
