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
class EasyMart_CustomerRelateOrder_Block_Adminhtml_Customer_Edit_Tabs_Relate extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerOrdersGrid');
        $this->setUseAjax(true);
        $this->setDefaultSort('increment_id', 'desc');
        $this->setSaveParametersInSession(true);
    }
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sales/order')->getCollection()
            //->addFieldToSelect('*')
			->addFieldToSelect('entity_id')
            ->addFieldToSelect('increment_id')
            ->addFieldToSelect('customer_id')
            ->addFieldToSelect('created_at')
            ->addFieldToSelect('grand_total')
            ->addFieldToSelect('order_currency_code')
            ->addFieldToSelect('store_id')
            ->addFieldToSelect('customer_firstname')
            ->addFieldToSelect('customer_lastname')
            
            
            ->addFieldToFilter('customer_email', Mage::registry('current_customer')->getEmail())
            ->addFieldToFilter('customer_id', array('null' => true))
            //->setIsCustomerMode(true)
			;
        $this->setCollection($collection);
        //echo $this->getCollection()->getSelect();
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        
        $this->addColumn('increment_id', array(
            'header'    => Mage::helper('relate_order')->__('Order #'),
            'width'     => '100',
            'index'     => 'increment_id',
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('relate_order')->__('Purchase On'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));
        $this->addColumn('customer_firstname', array(
            'header'    => Mage::helper('relate_order')->__('Customer First Name'),
            'index'     => 'customer_firstname',
        ));
        $this->addColumn('customer_lastname', array(
            'header'    => Mage::helper('relate_order')->__('Customer Last Name'),
            'index'     => 'customer_lastname',
        ));/**/
		/*
        $this->addColumn('billing_name', array(
            'header'    => Mage::helper('relate_order')->__('Bill to Name'),
            'index'     => 'billing_name',
        ));
        $this->addColumn('shipping_name', array(
            'header'    => Mage::helper('relate_order')->__('Shipped to Name'),
            'index'     => 'shipping_name',
        ));
*/
        $this->addColumn('grand_total', array(
            'header'    => Mage::helper('relate_order')->__('Order Total'),
            'index'     => 'grand_total',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
        ));
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => Mage::helper('relate_order')->__('Bought From'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view' => true
            ));
        }
        return parent::_prepareColumns();
    }
    
    
    protected function _prepareMassaction()
    {
        $customer_id = Mage::registry('current_customer')->getId();
        
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('order_relate['.$customer_id.']');
        $this->getMassactionBlock()->addItem('relate', array(
             'label'    => Mage::helper('relate_order')->__('Relate Order'),
             'url'      => $this->getUrl('*/relate/relateOrder'),
             'confirm'  => Mage::helper('relate_order')->__('Are you sure?')
        ));
        
        return $this;
    }
    public function getGridUrl()
    {
        return $this->getUrl('*/relate/grid', array('_current' => true));
    }
}