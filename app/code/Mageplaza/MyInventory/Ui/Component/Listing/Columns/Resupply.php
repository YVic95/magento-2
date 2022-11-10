<?php 

namespace Mageplaza\MyInventory\Ui\Component\Listing\Columns;

use Magento\Ui\Component\Listing\Columns\Column;

class Resupply extends Column
{
    protected $urlBuilder;

    public function __construct()
    {

    }

    public function prepareDataSource(array $dataSource)
    {
        return $dataSource;
    }
}