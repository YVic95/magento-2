<?php

declare(strict_types=1);

namespace Mageplaza\HelloWorld\Api\Data;

/**
 * @api
 */
interface AttributesInterface
{
    /**
     * @return int
     */
    public function getShipmentId(): int;

    /**
     * @return string
     */
    public function getCarrier(): string;

    /**
     * @return float
     */
    public function getCost(): float;

    /**
     * @return string
     */
    public function getDeliveryDate(): string;
    
}