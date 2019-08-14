<?php
class EasyMart_CustomerRelateOrder_Model_Observer
{
    public function checkoutCartProductAddAfter($observer) {
        $item = $observer->getEvent()->getQuoteItem();
        if ($item->getParentItem()) {
           $item = $item->getParentItem();
        }
        $walletAmount = '10';//Mage::app()->getRequest()->getPost('card_wallet_amount');

        $productPrice = Mage::getModel('catalog/product')->load($item->getProductId())->getFinalPrice();
        $finalPrice = (int)$walletAmount + (int)$productPrice;
        
        if($finalPrice > 0){
            $item->setCustomPrice($finalPrice);
            $item->setOriginalCustomPrice($finalPrice);
            $item->setCardWalletAmount($finalPrice);
            $item->getProduct()->setIsSuperMode(true);
        }
            Mage::getSingleton('core/session')->addSuccess($finalPrice); 
        
    }
    
 
    public function addCostAndShipping($observer)
    {
       $product = $observer->getProduct();

       $store_id = 0; //hard coded store id
       //or try $store_id = $product->getStoreId();

       $cost_price = $product->getCostPrice();//AttributeText('cost_price');
       $shipping_cost = $product->getShippingCost();//AttributeText('shipping_cost');

       $total_cost = $cost_price + $shipping_cost;

       //save to total cost
       $product->setTotalCost($total_cost);

        
        //Mage::log($product->getId() . " - $total_cost -".$product->getTotalCost(), null, 'total_cost.log');
    }
}