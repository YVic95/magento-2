<?php

namespace Mageplaza\Catalog\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterfaceFactory;

class InstallData implements InstallDataInterface
{
    protected $searchCriteriaBuilder;
    protected $blockRepository;
    protected $blockFactory;

    public function __construct(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        BlockRepositoryInterface $blockRepository,
        BlockInterfaceFactory $blockFactory
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->blockRepository = $blockRepository;
        $this->blockFactory = $blockFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('identifier', 'size-guide', 'eq')
            ->create();

        $blocks = $this->blockRepository->getList($searchCriteria)->getItems();

        if(empty($blocks)) {
            /* @var \Magento\Cms\Api\Data\BlockInterface $block */
            $block = $this->blockFactory->create();
            $block->setIdentifier('size-guide');
            $block->setTitle('Size guide');
            $block->setContent('Here will be shown the Size guide!');
            $this->blockRepository->save($block);
        }

        $setup->endSetup();
    }
}