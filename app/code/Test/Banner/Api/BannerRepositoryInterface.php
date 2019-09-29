<?php

namespace Test\Banner\Api;

/**
 * Banner CRUD interface.
 * @api
 */
interface BannerRepositoryInterface
{
    /**
     * Create or update a banner.
     *
     * @param \Test\Banner\Api\Data\BannerInterface $banner
     * @return \Test\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Test\Banner\Api\Data\BannerInterface $banner);

    /**
     * Get Banner by Banner ID.
     *
     * @param int $bannerId
     * @return \Test\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If banner with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($bannerId);

    /**
     * Delete banner.
     *
     * @param \Test\Banner\Api\Data\BannerInterface $banner
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Test\Banner\Api\Data\BannerInterface $banner);

    /**
     * Delete banner by Banner ID.
     *
     * @param int $bannerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannerId);
}
