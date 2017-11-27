<?php
/**
 * @author      Andrey Makienko <makyshplat@gmail.com>
 */

/**
 * Class Test_DecimalFactor_Model_Resource_Factor_Collection
 */
class Test_DecimalFactor_Model_Resource_Factor_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define resource model
     *
     */
    protected function _construct()
    {
        $this->_init('test_decimalfactor/factor');
    }

    /**
     * @return array
     */
    public function getAllItems()
    {
        $select = $this->getConnection()->select()->from(['main_table' => $this->getMainTable()], [
            'entity_id',
            'total',
            'order_id'
        ]);
        $select->group('order_id');

        $connection = $this->getResource()->getReadConnection();
        $itemsData = $connection->fetchAll($select);

        return $itemsData;
    }

    /**
     * @return array
     */
    public function getAllOrderIds()
    {
        $select = $this->getConnection()->select()->from($this->getMainTable());

        $select->reset(Zend_Db_Select::COLUMNS);
        $select->columns('order_id');
        $select->group('order_id');
        $connection = $this->getResource()->getReadConnection();

        $itemsData = $connection->fetchCol($select);

        return $itemsData;
    }
}