<?php

namespace Test\Banner\ViewModel;

use Test\Banner\Model\ResourceModel\Banners\CollectionFactory;
use Test\Banner\Model\Banners;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Banner implements ArgumentInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    public function __construct(
        CollectionFactory $collectionFactory,
        FilterProvider $filterProvider
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->filterProvider = $filterProvider;
    }

    /**
     * @return Banners
     */
    public function getSingleBanner()
    {
        $banner = $this->collectionFactory->create();
        $banner->addFieldToFilter('is_active', 1);
        return $banner->getFirstItem();
    }

    /**
     * @param Banners $banner
     * @return string
     */
    public function getBannerContent(Banners $banner)
    {
        if (!$banner->getContent()) {
            return '';
        }
        $content = $this->filterProvider->getPageFilter()->filter($banner->getContent());
        return $content;
    }
}
