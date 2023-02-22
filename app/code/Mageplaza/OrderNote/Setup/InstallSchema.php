<?php

namespace Mageplaza\OrderNote\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $connection = $setup->getConnection();

        $connection->addColumn(
            $setup->getTable('quote'),
            'order_notes',
            [
                'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable'  => true,
                'comment'   => 'Order Notes'
            ]
        );

        $connection->addColumn(
            $setup->getTable('sales_order'),
            'order_notes',
            [
                'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable'  => true,
                'comment'   => 'Order Notes'
            ]
        );
    }
}