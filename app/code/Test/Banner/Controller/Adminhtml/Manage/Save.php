<?php

namespace Test\Banner\Controller\Adminhtml\Manage;

use Test\Banner\Api\BannerRepositoryInterface;
use Test\Banner\Api\Data\BannerInterface;
use Test\Banner\Api\Data\BannerInterfaceFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Registry;
use Magento\Framework\Message\Error;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var BannerRepositoryInterface
     */
    protected $bannerRepository;

    /**
     * @var BannerInterfaceFactory
     */
    protected $bannerDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var Registry
     */
    protected $coreRegistry;

    public function __construct(
        Context $context,
        DataObjectHelper $dataObjectHelper,
        BannerRepositoryInterface $bannerRepository,
        BannerInterfaceFactory $bannerDataFactory,
        Registry $coreRegistry
    ) {
        parent::__construct($context);
        $this->dataObjectHelper = $dataObjectHelper;
        $this->bannerRepository = $bannerRepository;
        $this->bannerDataFactory = $bannerDataFactory;
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * Save banner action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $returnToEdit = false;
        $bannerId = $this->getCurrentBannerId();

        if ($this->getRequest()->getPostValue()) {
            try {
                $bannerData = $this->getRequest()->getPost('banners');

                if ($bannerId) {
                    $currentBanner = $this->bannerRepository->getById($bannerId);
                    $bannerData = array_merge(
                        $currentBanner->getData(),
                        $bannerData
                    );
                    $bannerData['id'] = $bannerId;
                }

                /** @var BannerInterface $banner */
                $banner = $this->bannerDataFactory->create();
                $this->dataObjectHelper->populateWithArray(
                    $banner,
                    $bannerData,
                    BannerInterface::class
                );

                $this->_eventManager->dispatch(
                    'adminhtml_banner_prepare_save',
                    ['banner' => $banner, 'request' => $this->getRequest()]
                );

                $banner = $this->bannerRepository->save($banner);
                $bannerId = $banner->getId();

                $this->_eventManager->dispatch(
                    'adminhtml_banner_save_after',
                    ['banner' => $banner, 'request' => $this->getRequest()]
                );
                $this->coreRegistry->register('banner', $bannerId);
                $this->messageManager->addSuccess(__('You saved the banner.'));
                $returnToEdit = (bool) $this->getRequest()->getParam('back', false);
            } catch (\Magento\Framework\Validator\Exception $exception) {
                $messages = $exception->getMessages();
                if (empty($messages)) {
                    $messages = $exception->getMessage();
                }
                $this->_addSessionErrorMessages($messages);
                $returnToEdit = true;
            } catch (\Magento\Framework\Exception\AbstractAggregateException $exception) {
                $errors = $exception->getErrors();
                $messages = [];
                foreach ($errors as $error) {
                    $messages[] = $error->getMessage();
                }
                $this->_addSessionErrorMessages($messages);
                $returnToEdit = true;
            } catch (LocalizedException $exception) {
                $this->_addSessionErrorMessages($exception->getMessage());
                $returnToEdit = true;
            } catch (\Exception $exception) {
                $this->messageManager->addException($exception, __('Something went wrong while saving the banner.'));
                $returnToEdit = true;
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($returnToEdit) {
            if ($bannerId) {
                $resultRedirect->setPath(
                    '*/*/edit',
                    ['id' => $bannerId, '_current' => true]
                );
            } else {
                $resultRedirect->setPath(
                    '*/*/new',
                    ['_current' => true]
                );
            }
        } else {
            $resultRedirect->setPath('*/*');
        }
        return $resultRedirect;
    }

    /**
     * Retrieve current banner ID
     *
     * @return int
     */
    private function getCurrentBannerId()
    {
        $originalRequestData = $this->getRequest()->getPostValue('banners');

        $bannerId = isset($originalRequestData['banner_id'])
            ? $originalRequestData['banner_id']
            : null;

        return $bannerId;
    }

    /**
     * Add errors messages to session.
     *
     * @param array|string $messages
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function _addSessionErrorMessages($messages)
    {
        $messages = (array)$messages;
        $session = $this->_getSession();

        $callback = function ($error) use ($session) {
            if (!$error instanceof Error) {
                $error = new Error($error);
            }
            $this->messageManager->addMessage($error);
        };
        array_walk_recursive($messages, $callback);
    }
}
