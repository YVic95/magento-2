<?php

namespace Mageplaza\DemoWebApi\Model;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class AttributesCollection extends AbstractCollection
{
    protected function __construct()
    {
        $this->_init(Demo::class, DemoResource::class);
    }
}