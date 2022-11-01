<?php

namespace Mageplaza\MyInventory\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory; 
use Magento\CatalogInventory\Api\StockRegistryInterface;

class Resupply
{
    protected $productRepository;
    protected $collectionFactory;
    protected $stockRegistry;
    
    //probably comment collectionFactory
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CollectionFactory $collectionFactory,
        StockRegistryInterface $stockRegistry
    )
    {
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
        $this->stockRegistry = $stockRegistry;
    }

    public function resupply($productId, $qty)
    {
        $product = $this->productRepository->getById($productId);
        $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());
        $stockItem->setQty($stockItem->getQty() + $qty);
        $stockItem->setIsInStock((bool)$stockItem->getQty());
        $this->stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);
    }
}