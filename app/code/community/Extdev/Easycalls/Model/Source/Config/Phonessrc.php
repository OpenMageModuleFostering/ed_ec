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

class Extdev_Easycalls_Model_Source_Config_Phonessrc extends Extdev_Easycalls_Model_Source_Abstract
{
    const FIRST_SHIPPING = '1';
    const FIRST_BILLING = '2';

    const FIRST_SHIPPING_LABEL = 'First from shipping and then from billing';
    const FIRST_BILLING_LABEL = 'First from billing and then from shipping';

    public function toOptionArray()
    {
        return array(
            array('value' => self::FIRST_SHIPPING, 'label' => self::FIRST_SHIPPING_LABEL),
            array('value' => self::FIRST_BILLING, 'label' => self::FIRST_BILLING_LABEL)
        );
    }
}
