<?php

namespace Mageplaza\DemoWebApi\Model;

use Mageplaza\DemoWebApi\Api\DemoRepositoryInterface;
use Mageplaza\DemoWebApi\Api\Data\DemoInterfaceFactory;
use Mageplaza\DemoWebApi\Model\DemoResource;
use Mageplaza\DemoWebApi\Model\DemoCollectionFactory;
use Mageplaza\DemoWebApi\Api\Data\DemoSearchResultsInterfaceFactory;
use Mageplaza\DemoWebApi\Api\Data\DemoInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
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

    /**
     * Save box.
     *
     * @param \Mageplaza\DemoWebApi\Api\Data\DemoInterface $box
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(DemoInterface $box)
    {
        try {
            $this->demoResourceModel->save($box);
        } catch(\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $box;
    }

    /**
     * Retrieve items box.
     *
     * @param int $boxId
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($boxId)
    {
        $box = $this->demoFactory->create();
        $this->demoResourceModel->load($box, $boxId);
        if(!$box->getId()) {
            throw new NoSuchEntityException(__('Box with id "%1" does not exist'));
        }
        return $box;
    }
}