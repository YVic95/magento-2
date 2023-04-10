<?php

namespace Mageplaza\OrderNote\Model\Cache\Type;

use Magento\Framework\Cache\Frontend\Decorator\TagScope;

/**
 * System / Cache Management / Cache type "Customer Note"
 */
class Note extends TagScope
{
    const TYPE_IDENTIFIER = 'customer_note';

    const CACHE_TAG = 'CUSTOMER_NOTE';

    public function __construct(\Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}