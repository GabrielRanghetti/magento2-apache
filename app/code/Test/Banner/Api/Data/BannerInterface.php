<?php

namespace Test\Banner\Api\Data;

/**
 * Banner interface.
 * @api
 */
interface BannerInterface
{
    const ID = 'banner_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const IS_ACTIVE = 'is_active';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set title.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content);

    /**
     * Get is_active.
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Set is_active.
     *
     * @param int $isActive
     * @return $this
     */
    public function setIsActive($isActive);

    /**
     * Get created_at.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created_at.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at.
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set updated_at.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}
