<?php

use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use Zenstruck\ControllerUtilBundle\ZenstruckControllerUtilBundle;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class TestKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return array(
            new FrameworkBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new JMSSerializerBundle(),
            new ZenstruckControllerUtilBundle(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/ZenstruckControllerUtilBundle/'.Kernel::VERSION.'/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return sys_get_temp_dir().'/ZenstruckControllerUtilBundle/'.Kernel::VERSION.'/logs';
    }
}
