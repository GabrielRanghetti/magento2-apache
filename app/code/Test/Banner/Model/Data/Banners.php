<?php

namespace Test\Banner\Model\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Test\Banner\Api\Data\BannerInterface;

class Banners extends AbstractSimpleObject implements BannerInterface
{
    /**
     * Get ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set title.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->_get(self::CONTENT);
    }

    /**
     * Set content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get is_active.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->_get(self::IS_ACTIVE);
    }

    /**
     * Set is_active.
     *
     * @param int $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get created_at.
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at.
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
