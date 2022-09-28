<?php

namespace Mageplaza\DemoWebApi\Api;

use Mageplaza\DemoWebApi\Api\Data\DemoInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Demo repository interface for item boxes.
 * @api
 */
interface DemoRepositoryInterface
{
    /**
     * Save box.
     *
     * @param \Mageplaza\DemoWebApi\Api\Data\DemoInterface $box
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(DemoInterface $box);
    
    /**
     * Retrieve items box.
     *
     * @param int $boxId
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($boxId);

    /**
     * Retrieve item boxes matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete box.
     *
     * @param \Mageplaza\DemoWebApi\Api\Data\DemoInterface $box
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(DemoInterface $box);

    /**
     * Delete box by ID.
     *
     * @param int $boxId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($boxId);
}