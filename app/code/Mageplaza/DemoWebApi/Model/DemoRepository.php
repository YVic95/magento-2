<?php

namespace Mageplaza\DemoWebApi\Model;

use Mageplaza\DemoWebApi\Api\DemoRepositoryInterface;
use Mageplaza\DemoWebApi\Api\Data\DemoInterfaceFactory;
use Mageplaza\DemoWebApi\Model\DemoResource;
use Mageplaza\DemoWebApi\Model\DemoCollectionFactory;
use Mageplaza\DemoWebApi\Api\Data\DemoSearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class DemoRepository implements DemoRepositoryInterface
{
    protected $demoFactory;
    protected $demoResourceModel;
    protected $demoCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;

    public function __construct(
        DemoInterfaceFactory $demoFactory,
        DemoResource $demoResourceModel,
        DemoCollectionFactory $demoCollectionFactory,
        DemoSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->demoFactory = $demoFactory;
        $this->demoResourceModel = $demoResourceModel;
        $this->demoCollectionFactory = $demoCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }
}