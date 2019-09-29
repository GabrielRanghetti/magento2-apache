<?php

namespace Test\Banner\Controller\Adminhtml\Manage;

use Test\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        BannerRepositoryInterface $bannerRepository,
        Registry $coreRegistry
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->bannerRepository = $bannerRepository;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * Banner edit action
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $bannerId = (int) $this->getRequest()->getParam('id');
        if ($bannerId) {
            $this->coreRegistry->register('banner', $bannerId);
        }

        $bannerData = [];
        $banner = null;
        $isExistingBanner = (bool) $bannerId;
        if ($isExistingBanner) {
            try {
                $banner = $this->bannerRepository->getById($bannerId);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addException($e, __('Something went wrong while editing the banner.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('test_banner/*/index');
                return $resultRedirect;
            }
        }
        $bannerData['banner_id'] = $bannerId;
        $this->_getSession()->setBannerData($bannerData);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Test_Banner::manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Banners'));
        $resultPage->setActiveMenu('Test_Banner::banners');
        if ($isExistingBanner) {
            $resultPage->getConfig()->getTitle()->prepend($banner->getTitle());
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Banner'));
        }
        return $resultPage;
    }
}
