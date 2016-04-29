<?php

/**
 * Copyright 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Gts\FarmRest\Model;

use Gts\FarmRest\Api\FarmWishlistInterface;

/**
 * Defines the implementaiton class of the calculator service contract.
 */
class FarmWishlist extends \Magento\Wishlist\Model\Wishlist  implements FarmWishlistInterface
{
    /**
     * {@inheritdoc}
     */
    public function getFarmWishlist($customerId) {

        $this->loadByCustomerId($customerId);

        $collection = $this->getItemCollection();
        $wishlist = $collection->toArray();
        return [$wishlist];
    }

    /**
     * {@inheritdoc}
     */
    public function addFarmNewItem($customerId, $productId) {
        $this->loadByCustomerId($customerId);
        $item = $this->addNewItem($productId);
        $this->save();
        return [$item->toArray()];
    }

    /**
     * {@inheritdoc}
     */
    public function deleteFarmItem($customerId, $wishlistItemId){
        $this->loadByCustomerId($customerId);
        $this->getItem($wishlistItemId)->delete();
        $this->save();
        return [array("message"=>"success")];
    }
}