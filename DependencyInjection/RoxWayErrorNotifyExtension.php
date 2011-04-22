<?php

namespace RoxWay\Bundle\ErrorNotifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class RoxWayErrorNotifyExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $processor = new Processor();
        $configuration = new Configuration();
        
        $config = $processor->process($configuration->getConfigTree(), $configs);
        $container->setParameter('roxway.error_notify.is_enable', $config['is_enable']);
        $container->setParameter('roxway.error_notify.to_mail', $config['to_mail']);
        $container->setParameter('roxway.error_notify.from_mail', $config['from_mail']);
        
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('error_notify.xml');
    }

}
