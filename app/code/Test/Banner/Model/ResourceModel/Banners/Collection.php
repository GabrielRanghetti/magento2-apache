<?php

namespace Test\Banner\Model\ResourceModel\Banners;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init("Test\Banner\Model\Banners", "Test\Banner\Model\ResourceModel\Banners");
    }
}
