<?php

namespace Mageplaza\Catalog\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $adapter = $setup->getConnection();
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.0') < 0) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            $sortOrder = 100;

            foreach ($days as $day) {
                $eavSetup->addAttribute(
                    \Magento\Catalog\Model\Product::ENTITY,
                    $day . '_cutoff_at',
                    [
                        'type' => 'varchar',
                        'label' => ucfirst($day) . ' Cutoff At',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => $sortOrder++,
                        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                        'group' => 'Cutoff'
                    ]
                );
            }
        }

        $setup->endSetup();
    }

    public static function getVersion()
    {
        return '2.0.0';
    }
}