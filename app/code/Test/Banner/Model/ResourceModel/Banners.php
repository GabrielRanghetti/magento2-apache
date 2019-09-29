<?php

namespace Test\Banner\Model\ResourceModel;

class Banners extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("banners", "banner_id");
    }
}
