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
class MyBreadcrumbs extends \Magento\Catalog\Block\Product\View\Attributes
{
    public function getFarmType(){

        $farm_type_map = array('leaves'=>'葉菜', 'fruit'=>'瓜果', 'dry'=>'乾貨');
        $attributes = $this->getAdditionalData();
        return $farm_type_map[$attributes['farm_type']['value']];
    }
}
