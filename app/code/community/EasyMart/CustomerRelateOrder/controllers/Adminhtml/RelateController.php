<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer orders grid block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class EasyMart_CustomerRelateOrder_Adminhtml_RelateController extends 
    Mage_Adminhtml_Controller_Action
{
    public function indexAction(){
        $this->loadLayout();
        $this->renderlayout();
    }
    
    public function relateOrderAction(){
        $ids =  $this->getRequest()->getParam('order_relate');
        $ids_array = array();
        if ($ids) {
            foreach($ids as $k => $id){
                //converting comma separated string to array
                $ids_array = explode(',',$id);
                $customer_id = $k;
            }
            
            try{
                foreach($ids_array as $id){
                    Mage::getModel('relate_order/relate')->relateOrder($id, $customer_id);
                }
                $this->_getSession()->addSuccess($this->__('The order(s) has been related.'));
             }
            catch (Mage_Core_Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
               $this->_getSession()->addError($this->__('Failed to relate order(s).'));
                Mage::logException($e);
            }
            
            
        }
        //$this->_redirectReferer();
        $this->_redirect('*/customer/edit/id/'.$customer_id);
    }
    
    public function gridAction()
    {
        $this->_initCustomer();
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('relate_order/adminhtml_customer_edit_tabs_relate')->toHtml()
        );
    }
    
    protected function _initCustomer($idFieldName = 'id')
    {
        $this->_title($this->__('Customers'))->_title($this->__('Manage Customers'));

        $customerId = (int) $this->getRequest()->getParam($idFieldName);
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);
        return $this;
    }
    
}