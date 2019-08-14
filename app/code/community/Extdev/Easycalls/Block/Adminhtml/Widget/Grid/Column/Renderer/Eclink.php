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

class Extdev_Easycalls_Block_Adminhtml_Widget_Grid_Column_Renderer_Eclink extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /** @var $_order Mage_Sales_Model_Order */
    protected $_order = null;

    protected function _initOrder(Varien_Object $row)
    {
        if ($row instanceof Mage_Sales_Model_Order) {
            $this->_order = $row;
        }
        return $this;
    }

    /**
     * @return Mage_Sales_Model_Order
     */
    protected function _getOrder()
    {
        return $this->_order;
    }

    protected function _getShippingPhone()
    {
        if ($this->_getOrder() && $this->_getOrder()->getShippingAddress()) {
            return $this->_getOrder()->getShippingAddress()->getTelephone();
        }
        return false;
    }

    protected function _getBillingPhone()
    {
        if ($this->_getOrder() && $this->_getOrder()->getBillingAddress()) {
            return $this->_getOrder()->getBillingAddress()->getTelephone();
        }
        return false;
    }

    public function _getValue(Varien_Object $row)
    {
        $hrefFormat = Mage::helper('edneasycalls/config')->getGeneralLinkTemplate();
        $format = <<<AH
<a href="{$hrefFormat}">%s</a>
AH;

        $phoneNumber = null;
        $phoneSrcPriority = Mage::helper('edneasycalls/config')->getGeneralPhonesSourcePriority();
        $this->_initOrder($row);
        if ($phoneSrcPriority === Extdev_Easycalls_Model_Source_Config_Phonessrc::FIRST_BILLING) {
            $phoneNumber = $this->_getBillingPhone();
        } else {
            $phoneNumber = $this->_getShippingPhone();
        }
        if ($phoneNumber === null) {
            if ($phoneSrcPriority === Extdev_Easycalls_Model_Source_Config_Phonessrc::FIRST_BILLING) {
                $phoneNumber = $this->_getShippingPhone();
            } else {
                $phoneNumber = $this->_getBillingPhone();
            }
        }
        return $phoneNumber ? sprintf($format, $phoneNumber, $phoneNumber) : $this->__('N/A');
    }
}
