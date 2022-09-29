<?php

namespace Mageplaza\DemoWebApi\Model;

use Mageplaza\DemoWebApi\Api\Data\DemoInterface;
use Magento\Framework\Model\AbstractModel;

class Demo extends AbstractModel implements DemoInterface
{
    protected function _construct()
    {
        $this->_init(Demo::class);
    }

    /**
     * Get ID
     *
     * @return int|null|mixed
     */
    public function getId()
    {
        return $this->getData(self::BOX_ID);
    }

    /**
     * Get title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Get content
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set ID
     *
     * @param int|mixed $id
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface|Demo|\Magento\Framework\Model\AbstractModel
     */
    public function setId($id)
    {
        return $this->setData(self::BOX_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface|Demo
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title); 
    }

    /**
     * Set content
     *
     * @param string $content
     * @return \Mageplaza\DemoWebApi\Api\Data\DemoInterface|Demo
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }
}