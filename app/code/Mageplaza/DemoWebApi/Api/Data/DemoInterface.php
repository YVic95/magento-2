<?php

namespace Mageplaza\DemoWebApi\Api\Data;


/**
 * @api
 */
interface DemoInterface
{
    const BOX_ID = 'box_id';
    const TITLE = 'title';
    const CONTENT = 'content';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     */
    public function setTitle($title);

    /**
     * Set content
     *
     * @param string $content
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface
     */
    public function setContent($content);
}