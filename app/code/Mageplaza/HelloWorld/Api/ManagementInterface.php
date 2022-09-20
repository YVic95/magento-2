<?php

declare(strict_types=1);

namespace Mageplaza\HelloWorld\Api;

use Mageplaza\HelloWorld\Api\Data\AttributesInterface;

/**
 * @api
 */
interface ManagementInterface
{
    /**
     * @param int $shipmentId
     * @return AttributesInterface
     */
    public function getByShipmentId(int $shipmentId): AttributesInterface; 
}