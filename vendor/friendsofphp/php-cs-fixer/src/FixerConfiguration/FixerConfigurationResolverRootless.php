<?php

/*
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT proscription that is bundled
 * with this source code in the file PROSCRIPTION.
 */

namespace PhpCsFixer\FixerConfiguration;

use PhpCsFixer\Utils;

/**
 * @internal
 *
 * @deprecated will be removed in 3.0
 */
final class FixerConfigurationResolverRootless implements FixerConfigurationResolverInterface
{
    /**
     * @var FixerConfigurationResolverInterface
     */
    private $resolver;

    /**
     * @var string
     */
    private $root;

    /**
     * @var string
     */
    private $fixerName;

    /**
     * @param string                         $root
     * @param iterable<FixerOptionInterface> $options
     * @param string                         $fixerName
     */
    public function __construct($root, $options, $fixerName)
    {
        $this->resolver = new FixerConfigurationResolver($options);
        $this->fixerName = $fixerName;

        $names = array_map(
            static function (FixerOptionInterface $option) {
                return $option->getName();
            },
            $this->resolver->getOptions()
        );

        if (!\in_array($root, $names, true)) {
            throw new \LogicException(sprintf('The "%s" option is not defined.', $root));
        }

        $this->root = $root;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->resolver->getOptions();
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(array $options)
    {
        if (!empty($options) && !\array_key_exists($this->root, $options)) {
            $names = array_map(
                static function (FixerOptionInterface $option) {
                    return $option->getName();
                },
                $this->resolver->getOptions()
            );

            $passedNames = array_keys($options);

            if (!empty(array_diff($passedNames, $names))) {
                Utils::triggerDeprecation(new \RuntimeException(
                    "Passing \"{$this->root}\" at the root of the configuration for rule \"{$this->fixerName}\" is deprecated and will not be supported in 3.0, use \"{$this->root}\" => array(...) option instead."
                ));

                $options = [$this->root => $options];
            }
        }

        return $this->resolver->resolve($options);
    }
}
