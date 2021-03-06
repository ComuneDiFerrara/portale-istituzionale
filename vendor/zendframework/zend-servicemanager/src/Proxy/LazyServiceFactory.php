<?php
/**
 */

namespace Zend\ServiceManager\Proxy;

use Interop\Container\ContainerInterface;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\LazyLoadingInterface;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Delegator factory responsible of instantiating lazy loading value holder proxies of
 * given services at runtime
 *
 */
final class LazyServiceFactory implements DelegatorFactoryInterface
{
    /**
     * @var \ProxyManager\Factory\LazyLoadingValueHolderFactory
     */
    private $proxyFactory;

    /**
     * @var string[] map of service names to class names
     */
    private $servicesMap;

    /**
     * @param LazyLoadingValueHolderFactory $proxyFactory
     * @param string[]                      $servicesMap  a map of service names to class names of their
     *                                                    respective classes
     */
    public function __construct(LazyLoadingValueHolderFactory $proxyFactory, array $servicesMap)
    {
        $this->proxyFactory = $proxyFactory;
        $this->servicesMap  = $servicesMap;
    }

    /**
     * {@inheritDoc}
     *
     * @return \ProxyManager\Proxy\VirtualProxyInterface
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        if (isset($this->servicesMap[$name])) {
            $initializer = function (&$wrappedInstance, LazyLoadingInterface $proxy) use ($callback) {
                $proxy->setProxyInitializer(null);
                $wrappedInstance = $callback();

                return true;
            };

            return $this->proxyFactory->createProxy($this->servicesMap[$name], $initializer);
        }

        throw new Exception\ServiceNotFoundException(
            sprintf('The requested service "%s" was not found in the provided services map', $name)
        );
    }
}
