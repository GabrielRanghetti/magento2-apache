<?php

namespace Test\Banner\Controller\Adminhtml\Manage;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\App\Action\Context;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
    }
}
