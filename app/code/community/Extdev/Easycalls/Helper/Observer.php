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

class Extdev_Easycalls_Helper_Observer extends Mage_Core_Helper_Abstract
{
    /** @var $_configHelper Extdev_Easycalls_Helper_Config */
    protected $_configHelper = null;

    protected function _getConfigHelper()
    {
        if ($this->_configHelper === null) {
            $this->_configHelper = Mage::helper('edneasycalls/config');
        }
        return $this->_configHelper;
    }

    public function addColumnToOrdersGrid($observer)
    {
        if ($this->_getConfigHelper()->getGeneralEnabled()) {
            $block = $observer->getBlock();
            if ($block instanceof Mage_Adminhtml_Block_Sales_Order_Grid) {
                /** @var $block Mage_Adminhtml_Block_Sales_Order_Grid */
                $block->addColumn('phone', array(
                    'header' => $this->__('Phone'),
                    'index' => 'increment_id',
                    'type' => 'options',
                    'width' => '150px',
                    'renderer' => 'Extdev_Easycalls_Block_Adminhtml_Widget_Grid_Column_Renderer_Eclink'
                ));

                /** Moving Phone column after status column */
                $block->addColumnsOrder('phone', 'status');
                $block->sortColumnsByOrder();
            }
        }
    }
}
