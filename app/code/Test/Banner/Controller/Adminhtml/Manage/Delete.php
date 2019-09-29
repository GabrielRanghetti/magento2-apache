<?php

namespace Test\Banner\Controller\Adminhtml\Manage;

use Test\Banner\Api\BannerRepositoryInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    public function __construct(
        Context $context,
        BannerRepositoryInterface $bannerRepository
    )
    {
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Delete banner action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $bannerId = (int) $this->getRequest()->getParam('id');

        if (!empty($bannerId)) {
            try {
                $this->bannerRepository->deleteById($bannerId);
                $this->messageManager->addSuccess(__('You deleted the banner.'));
            } catch (\Exception $exception) {
                $this->messageManager->addError($exception->getMessage());
            }
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('test_banner/manage');
    }
}
