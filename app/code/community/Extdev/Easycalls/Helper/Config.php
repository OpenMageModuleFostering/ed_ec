<?php

/**
 * ExtDev
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension
 * to newer versions in the future
 *
 * @category ExtDev
 * @package Extdev_Easycalls
 * @copyright 2012 ExtDev Co. (http://extdev.net)
 * @license OSL v3.0
 */

class Extdev_Easycalls_Helper_Config extends Mage_Core_Helper_Abstract
{
    const EXTENSION_KEY = 'edneasycalls';

    const GENERAL_ENABLED = 'general/enabled';
    const GENERAL_LINK_TEMPLATE = 'general/linktemplate';
    const GENERAL_PHONES_SRC = 'general/phonesrcpriority';

    /**
     * Returns module config value by a param.
     * Example: Mage::helper('edneasycalls/config')->getConfig(Extdev_Easycalls_Helper_Config::GENERAL_ENABLED)
     * @param $key
     * @param null $store
     * @return mixed
     */
    public function getConfig($key, $store = null)
    {
        return Mage::getStoreConfig(self::EXTENSION_KEY . '/' . $key, $store);
    }

    /**
     * getGeneral_DisableNotifications - calls getConfig('general/disable_notifications')
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        //TODO add stores support
        if (strpos($name, 'get') === 0 && strpos($name, '_') !== false) {
            $name = substr($name, 3);
            list($fieldset, $option) = explode('_', $name);
            $fieldset = strtolower($fieldset);
            $option = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $option));
            return $this->getConfig($fieldset . '/' . $option);
        }
    }

    public function getGeneralEnabled($store = null)
    {
        return $this->getConfig(self::GENERAL_ENABLED, $store);
    }

    public function getGeneralLinkTemplate($store = null)
    {
        return $this->getConfig(self::GENERAL_LINK_TEMPLATE, $store);
    }

    public function getGeneralPhonesSourcePriority($store = null)
    {
        return $this->getConfig(self::GENERAL_PHONES_SRC, $store);
    }
}
