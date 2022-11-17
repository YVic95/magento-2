<?php

namespace Mageplaza\MyInventory\Controller\Adminhtml\Product;

use Mageplaza\MyInventory\Controller\Adminhtml\Product;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Mageplaza\MyInventory\Model\Resupply;

class Form extends Product
{
    protected $stockRegistry;
    protected $productRepository;
    protected $resupply;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        StockRegistryInterface $stockRegistry,
        Resupply $resupply
    )
    {
        parent::__construct($context);
        $this->stockRegistry = $stockRegistry;
        $this->productRepository = $productRepository;
        $this->resupply = $resupply;
    }

    /**
     * @return void
     */
    public function execute()
    {
        if($this->getRequest()->isPost()) {
            $this->resupply->resupply(
                $this->getRequest()->getParam('id'),
                $_POST['myinventory_product']['qty']
            );
            $this->messageManager->addSuccessMessage(__('Successfully resuplied'));
            $redirectResult = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $redirectResult->setPath('myinventory/product/index');
        } else {
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->prepend((__('Stock Resupply')));
            return $resultPage;
        }
    }
}