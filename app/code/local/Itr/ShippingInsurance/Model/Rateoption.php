<?php

class Itr_ShippingInsurance_Model_Rateoption
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('% of total cost')),
            array('value' => 0, 'label'=>Mage::helper('adminhtml')->__('Fixed price')),
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => Mage::helper('adminhtml')->__('Fixed price'),
            1 => Mage::helper('adminhtml')->__('% of total cost'),
        );
    }
}
