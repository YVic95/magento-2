<?php 

namespace Mageplaza\MyInventory\Ui\Component\Listing\Columns;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\UrlInterface;

class Resupply extends Column
{
    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['resupply'] = [
                    'href' => $this->urlBuilder->getUrl(
                            'myinventory/product/resupply', 
                            ['id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label' => __('Resupply'),
                    'hidden' => false
                ];
            }
        }

        return $dataSource;
    }
}