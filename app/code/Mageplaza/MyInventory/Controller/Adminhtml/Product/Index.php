<?php

namespace Mageplaza\MyInventory\Controller\Adminhtml\Product;

use Mageplaza\MyInventory\Controller\Adminhtml\Product;
use Magento\Framework\Controller\ResultFactory;

//if it won`t work see Mageplaza\Demo\Controller\Adminhtml\Create\Index
class Index extends Product
{
    /**
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend((__('Primitive Inventory')));
        return $resultPage;
    }
}