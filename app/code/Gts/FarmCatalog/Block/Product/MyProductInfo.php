<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Gts\FarmCatalog\Block\Product;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Product;


/**
 * Product list
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class MyProductInfo extends \Magento\Catalog\Block\Product\AbstractProduct
{
    public function getFarmProductInfo(){

        $myProduct = $this->getProduct();
        $myOptions = $myProduct->getResource()->getAttribute('cert_mark')->getOptions();
        $certMarkMap=[];
        foreach($myOptions as $myOption){
            $certMarkMap[$myOption->getValue()]=$myOption->getLabel();
        }
        $productInfo = [];
        $productInfo['name'] = $myProduct->getName();
        $productInfo['price'] = $myProduct->getPrice();
        $productInfo['weight'] = $myProduct->getWeight();
        $productInfo['place_of_origin'] = $myProduct->getCustomAttribute('place_of_origin')->getValue();
        $certMarks = explode(",",$myProduct->getCustomAttribute('cert_mark')->getValue());
        $certMarksLabel=[];
        foreach($certMarks as $certMark){
            array_push($certMarksLabel,$certMarkMap[$certMark]);
        }
        $productInfo['cert_mark']=$certMarksLabel;
        $productInfo['delivery_area'] = $myProduct->getCustomAttribute('delivery_area')->getValue();

        return $productInfo;
    }
}
