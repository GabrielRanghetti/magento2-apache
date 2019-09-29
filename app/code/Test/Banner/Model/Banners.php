<?php

namespace Test\Banner\Model;

class Banners extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Test\Banner\Model\ResourceModel\Banners::class);
    }
}
