<?php

/**
 * ExtDev
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://extdev.net/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension
 * to newer versions in the future
 *
 * @category ExtDev
 * @package Extdev_All
 * @copyright 2012 ExtDev Co. (http://extdev.net)
 * @license http://extdev.net/LICENSE.txt
 */

class Extdev_All_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Check is extension installed, active and not
     * disabled in the Advanced > Disable Output tab
     * @param $name - extension name
     * @return bool - results of check
     */
    public function isExtensionInstalled($name)
    {
        $modules = (array)Mage::getConfig()->getNode('modules')->children();
        return array_key_exists($name, $modules)
            && 'true' == (string)$modules[$name]->active
            && !(bool)Mage::getStoreConfig('advanced/modules_disable_output/' . $name);
    }

    /**
     * Check extension version
     * @param $extensionName
     * @param $extVersion
     * @param string $operator
     * @return bool
     */
    public function checkExtensionVersion($extensionName, $extVersion, $operator = '>=')
    {
        if ($this->isExtensionInstalled($extensionName) && ($version = Mage::getConfig()->getModuleConfig($extensionName)->version)) {
            return version_compare($version, $extVersion, $operator);
        }
        return false;
    }
}
