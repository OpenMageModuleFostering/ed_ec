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

class Extdev_All_Model_Source_Abstract
{
    protected $_extension = 'ednall';

    public function toOptionArray()
    {
        return array();
    }

    /**
     * Returns array(value => ..., label => ...) for option with given value
     * @param string $value
     * @return array
     */
    public function getOption($value)
    {
        $_options = $this->toOptionArray();

        foreach ($_options as $_option)
            if ($_option['value'] == $value)
                return $_option;

        return false;
    }

    /**
     * Get label for option with given value
     * @param string $value
     * @return string
     */
    public function getOptionLabel($value)
    {
        $_option = $this->getOption($value);
        if (!$_option) return false;
        return $_option['label'];
    }

    /**
     * Returns associative array $value => $label
     * @return array
     */
    public function toShortOptionArray()
    {
        $_options = array();
        foreach ($this->toOptionArray() as $option)
            $_options[$option['value']] = $option['label'];
        return $_options;
    }

    protected function _getHelper($ext = '')
    {
        return Mage::helper($this->_extension . ($ext ? '/' . $ext : ''));
    }
}
