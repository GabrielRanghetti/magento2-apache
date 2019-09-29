<?php

namespace Test\Banner\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('banners');
        if ($conn->isTableExists($tableName) != true) {
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'banner_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Banner ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'Banner Title'
                )
                ->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => false, 'default' => ''],
                    'Banner HTML'
                )
                ->addColumn(
                    'is_active',
                    Table::TYPE_BOOLEAN,
                    null,
                    ['nullable' => false, 'default' => 1],
                    'Banner Status'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )
                ->setOption('charset', 'utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
