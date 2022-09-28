<?php

namespace Mageplaza\DemoWebApi\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        /**
         * Prepares database before install/upgrade
         *
         * @return $this
         */
        $installer->startSetup();
        /**
         * Gets connection object
         *
         * @return \Magento\Framework\DB\Adapter\AdapterInterface
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('mageplaza_webapi'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                32,
                ['nullable' => false],
                'Title'
            )
            ->addColumn(
                'content',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Content'
            )
            ->setComment('RestApi table');
            
        $setup->getConnection()->createTable($table);
        /**
         * Prepares database after install/upgrade
         *
         * @return $this
         */
        $installer->endSetup();
    }
}