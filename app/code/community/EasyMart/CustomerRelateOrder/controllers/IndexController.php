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
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Easy Mart
 * @package     Customer Relate with Order
 * @copyright   Copyright (c) 2015 Easy Mart (http://www.easymart.com.au)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class EasyMart_CustomerRelateOrder_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
        echo "<style>
    .table   { display: table; border-collapse: collapse;}
    .tablerow  { display: table-row; border: 1px solid #000;}
    td{border:1px solid; padding:10px;}
    .tablecell { display: table-cell; }
</style>";
        //$this->loadLayout();
        
        $model=Mage::getModel('sales/order');
        $collection = $model->getCollection();
        echo "<table><thead><tr><td>Order Id</td><td>Customer Id</td><td>Customer is Guest</td><td>Customer Group Id</td></tr></thead>";
        echo "<tbody>";
        foreach($collection as $order){
            echo "<tr>";
            echo "<td>".$order->getIncrementId()."</td>";
            echo "<td>".$order->getCustomerId()."</td>";
            echo "<td>".$order->getCustomerIsGuest()."</td>";
            echo "<td>".$order->getCustomerGroupId()."</td>";
            echo "</tr>";
        }
        echo "</tr></tbody></table>";
        //$this->renderLayout();
    }
    
    public function relateOrderAction(){
        $model=Mage::getModel('sales/order');
        $order = $model->load(3);
        foreach($collection as $order){
            if($order->getId() == 3){
                $order->setCustomerId();
                $order->setCustomerIsGuest(1);
                $order->setCustomerGroupId();
                $order->save();
            }
        }
        
    }
}
