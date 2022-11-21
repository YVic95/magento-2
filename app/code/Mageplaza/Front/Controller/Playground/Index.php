<?php

namespace Mageplaza\Front\Controller\Playground;

use Mageplaza\Front\Controller\Playground;

class Index extends Playground
{
    /**
     * @return void
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set((__('Playground')));
        return $resultPage;
    }
}

