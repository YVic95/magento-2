<?php

namespace Mageplaza\MyInventory\Ui\DataProvider\Product\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;

class ProductDataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $productRepository;
    protected $stockRegistry;
    protected $request;
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        ProductRepositoryInterface $productRepository,
        StockRegistryInterface $stockRegistry,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->productRepository = $productRepository;
        $this->stockRegistry = $stockRegistry;
        $this->request = $request;
    }

    public function getData()
    {
        if(isset($this->loadedData)) {
            return $this->loadedData;
        }

        $id = $this->request->getParam('id');
        $product = $this->productRepository->getById($id);
        $stockItem = $this->stockRegistry->getStockItemBySku($product->getSku());
        $this->loadedData[$product->getId()]['myinventory_product'] = [
            'stock' => __('%1 | %2', $product->getSku(), $stockItem->getQty()),
            'qty' => 10
        ];

        return $this->loadedData;
        //return [];
    }
}