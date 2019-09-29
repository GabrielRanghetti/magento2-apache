<?php

namespace Test\Banner\Model\ResourceModel;

use Test\Banner\Api\BannerRepositoryInterface;
use Test\Banner\Model\Banners;
use Test\Banner\Model\BannersFactory;
use Test\Banner\Api\Data\BannerInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannersFactory
     */
    protected $bannersFactory;

    /**
     * @var ManagerInterface;
     */
    protected $eventManager;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * Constructor
     *
     * @param BannersFactory $bannersFactory
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        BannersFactory $bannersFactory,
        ManagerInterface $eventManager,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->bannersFactory = $bannersFactory;
        $this->eventManager = $eventManager;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    /**
     * Create or update a banner.
     *
     * @param BannerInterface $banner
     * @return BannerInterface
     * @throws \Magento\Framework\Exception\InputException If bad input is provided
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(BannerInterface $banner)
    {
        $prevBannerData = null;
        if ($banner->getId()) {
            $prevBannerData = $this->getById($banner->getId());
        }
        $bannerData = $this->dataObjectProcessor->buildOutputDataArray($banner, BannerInterface::class);
        /** @var Banners $bannerModel */
        $bannerModel = $this->bannersFactory->create(['data' => $bannerData]);
        $bannerModel->setId($banner->getId());
        $bannerModel->save();
        $savedBanner= $this->getById($bannerModel->getId());
        $this->eventManager->dispatch(
            'banner_save_after_data_object',
            [
                'banner_data_object' => $savedBanner,
                'orig_banner_data_object' => $prevBannerData
            ]
        );

        return $savedBanner;
    }

    /**
     * Get Banner by Banner ID.
     *
     * @param int $bannerId
     * @return \Test\Banner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If banner with the specified ID does not exist.
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($bannerId)
    {
        /** @var Banners $banner */
        $banner = $this->bannersFactory->create()->load($bannerId);
        if (!$banner->getId()) {
            throw NoSuchEntityException::singleField('bannerId', $bannerId);
        }
        return $banner;
    }

    /**
     * Delete banner.
     *
     * @param \Test\Banner\Api\Data\BannerInterface $banner
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Test\Banner\Api\Data\BannerInterface $banner)
    {
        return $this->deleteById($banner->getId());
    }

    /**
     * Delete banner by Banner ID.
     *
     * @param int $bannerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bannerId)
    {
        $bannerModel = $this->getById($bannerId);
        $bannerModel->delete();

        return true;
    }
}
