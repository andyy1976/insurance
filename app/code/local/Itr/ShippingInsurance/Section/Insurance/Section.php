<?php

class Itr_ShippingInsurance_Section_Insurance_Section extends Mage_Adminhtml_Block_System_Config_Form
{
    /**
     * Replaces config class used to build form
     *
     * @return Mage_Adminhtml_Block_System_Config_Form
     */
    protected function _initObjects()
    {
        parent::_initObjects();

        //Use own class to alter default behaviour
        $this->_configFields = Mage::getSingleton('Itr_ShippingInsurance_Helper_Config');

        return $this;
    }
}
