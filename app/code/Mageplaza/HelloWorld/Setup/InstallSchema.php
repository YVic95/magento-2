<?php

namespace Mageplaza\HelloWorld\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
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
            ->newTable($setup->getTable('magelicious_core_log'))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entity ID'
            )
            ->addColumn(
                'severity_level',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                24,
                ['nullable' => false],
                'Severity Level'
            )
            ->addColumn(
                'note',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Note'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'Created At'
            )
            ->setComment('Magelicious Core Log Table');
        $setup->getConnection()->createTable($table);
        /**
         * Prepares database after install/upgrade
         *
         * @return $this
         */
        $installer->endSetup();
	}
}
