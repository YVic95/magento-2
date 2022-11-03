<?php

namespace Mageplaza\MyInventory\Controller\Adminhtml\Product;

use Mageplaza\MyInventory\Controller\Adminhtml\Product;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Mageplaza\MyInventory\Model\Resupply;

class MassResupply extends Product
{
    protected $filter;
    protected $collectionFactory;
    protected $resupply;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Resupply $resupply
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resupply = $resupply; 
    }

    public function execute()
    {
        $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $qty = $this->getRequest()->getParam('qty');
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $productResupplied = 0;
        foreach($collection->getItems() as $product) {
            $this->resupply->resupply($product->getId(), $qty);
            $productResupplied++;
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been resupplied.', $productResupplied));

        return $redirectResult->setPath('myinventory/product/index');
    }
}