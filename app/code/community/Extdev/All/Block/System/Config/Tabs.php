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

class Extdev_All_Block_System_Config_Tabs extends Mage_Adminhtml_Block_System_Config_Tabs
{
    protected function _ed_sort($a, $b)
    {
        return strcmp($a->label, $b->label);
    }

    public function initTabs()
    {
        $sections = Mage::getSingleton('adminhtml/config')->getSections();
        $ednSections = array();
        foreach($sections->children() as $sectionId => $section) {
            if(isset($section->tab) && $section->tab == 'ednall') {
                $ednSections[] = $section;
            }
        }
        usort($ednSections, array($this, '_ed_sort'));
        foreach($ednSections as $index => $section) {
            $section->sort_order = $index;
        }
        return parent::initTabs();
    }
}
