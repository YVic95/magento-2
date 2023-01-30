<?php

namespace Mageplaza\Catalog\Plugin;

use Magento\Catalog\Helper\Product\View as ProductViewHelper;
use Magento\Framework\View\Result\Page;

class AddBodyClass
{
    public function beforeInitProductLayout(
        ProductViewHelper $subject,
        Page $resultPage, 
        $product, 
        $params
    )
    {
        $pageConfig = $resultPage->getConfig();

        if($pageConfig) {
            $pageConfig->addBodyClass('brand-new-class');
        }

        return [$resultPage, $product, $params];
    }
}