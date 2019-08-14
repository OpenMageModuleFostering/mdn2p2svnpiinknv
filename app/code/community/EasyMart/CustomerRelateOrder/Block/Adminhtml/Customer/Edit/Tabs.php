<?php
/**
 * Easy Mart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to me.adarshkhatri@gmail.com so we can send you a copy immediately.
 *
 * @category    Easy Mart
 * @package     Customer Relate with Order
 * @copyright   Copyright (c) 2015 Easy Mart (http://www.easymart.com.au)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * EasyMart CustomerRelateOrder Adminhtml customer orders relate block
 * @category   Easy Mart
 * @package    CustomerRelateOrder
 * @author     Adarsh Khatri (me.adarshkhatri@gmail.com)
 */
class EasyMart_CustomerRelateOrder_Block_Adminhtml_Customer_Edit_Tabs extends Mage_Adminhtml_Block_Customer_Edit_Tabs
{
    
    private $parent;
 
    protected function _prepareLayout()
    {
        //get all existing tabs
        $this->parent = parent::_prepareLayout();
        //add new tab
        $this->addTab('relate_order', array(
            'label'     => Mage::helper('relate_order')->__('Relate Order'),
            'content'   => $this->getLayout()
             ->createBlock('relate_order/adminhtml_customer_edit_tabs_relate', 'relate.order')->toHtml(),
            'after'     => 'orders'
            //'active'    => false
        ));
        return $this->parent;
    }
    
}