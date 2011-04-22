<?php

namespace RoxWay\Bundle\ErrorNotifyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This class contains the configuration information for the bundle
 *
 * @author Szymon Szewczyk <s.szewczyk@roxway.pl>
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\DependencyInjection\Configuration\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rox_way_error_notify');

        $rootNode
            ->children()
                ->booleanNode('is_enable')->isRequired()->end()
                ->scalarNode('to_mail')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('from_mail')->isRequired()->cannotBeEmpty()->end();

        return $treeBuilder->buildTree();
    }

}
