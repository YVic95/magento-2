<?php

namespace Mageplaza\DemoWebApi\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface DemoSearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @api
     * @param \Mageplaza\DemoWebApi\Api\Data\DemoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}