<?php

declare(strict_types=1);

namespace Mageplaza\HelloWorld\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class AttributesCollection extends AbstractCollection
{
    protected function __construct()
    {
        $this->_init(Attributes::class, AttributesResource::class);
    }
}