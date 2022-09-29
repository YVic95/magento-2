<?php 

namespace Mageplaza\DemoWebApi\Model;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DemoResource extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('mageplaza_webapi', 'entity_id');
    }
}