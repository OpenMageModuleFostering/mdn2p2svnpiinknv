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
 * Adminhtml customer orders relate model
 * @category   Easy Mart
 * @package    CustomerRelateOrder
 * @author     Adarsh Khatri (me.adarshkhatri@gmail.com)
 */
class EasyMart_CustomerRelateOrder_Model_Relate extends Varien_Object
{
    public function getCurrentCustomer($customer)
    {
        return $customer->getId();
    }   
    
    public function relateOrder($id, $customer_id)
    {
        $customer = $this->_getCustomer($customer_id);
        $order = Mage::getModel('sales/order')->load($id);
        if($order->getId() == $id && $order->getCustomerIsGuest()){
            $order->setCustomerId($customer_id);
            $order->setCustomerIsGuest(0);
            $order->setCustomerGroupId($customer->getGroupId());
            $order->save();
        }
    }
    
    
    private function _getCustomer($customer_id)
    {
        return $customer = Mage::getModel('customer/customer')->load($customer_id);
    }
}
