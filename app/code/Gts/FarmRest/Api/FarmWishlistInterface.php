<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Gts\FarmRest\Api;

/**
 * @api
 */
interface FarmWishlistInterface
{
    /**
     * Get Farm Wishlist
     *
     * @param int $customerId The customer ID.
     * @return array
     */
    public function getFarmWishlist($customerId);

    /**
     * Adds new product to wishlist.
     *
     * @param int $customerId
     * @param int $productId
     * @return array
     */
    public function addFarmNewItem($customerId, $productId);

    /**
     * Deletes a product to wishlist.
     *
     * @param int $customerId
     * @param int $wishlistItemId wishlist item id
     * @return array
     */
    public function deleteFarmItem($customerId, $wishlistItemId);
}
