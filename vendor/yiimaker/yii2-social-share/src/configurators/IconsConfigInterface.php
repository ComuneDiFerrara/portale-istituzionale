<?php
/**
 */

namespace ymaker\social\share\configurators;

/**
 * Icons configuration interface.
 *
 *
 * @since 2.3
 */
interface IconsConfigInterface
{
    /**
     * Checks whether icons is enabled.
     *
     * @return bool
     */
    public function isIconsEnabled();

    /**
     * Checks whether default icons asset is enabled.
     *
     * @return bool
     */
    public function isDefaultAssetEnabled();

    /**
     * Returns icon selector for social network.
     *
     * @param string $socialNetwork
     *
     * @return string
     */
    public function getIconSelector($socialNetwork);
}
