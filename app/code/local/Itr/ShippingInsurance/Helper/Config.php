<?php

class Itr_ShippingInsurance_Helper_Config extends Mage_Adminhtml_Model_Config
{
    /**
     * Clones field group. Searches for template in top-level string parameters
     * and replaces with carrier name
     *
     * @param $configElement
     * @param $carrier
     * @return mixed
     */
    protected function _groupClone($configElement, $carrier)
    {
        $newElement = clone($configElement);
        foreach (get_object_vars($newElement) as $key => &$value) {
            if (is_string($value))
                $newElement->$key = str_replace('%carriername%', $carrier->getTitle(), $value);
        }

        return $newElement;
    }

    /**
     * Dynamically builds groups for each active carrier
     *
     * @param string $sectionCode
     * @param string $websiteCode
     * @param string $storeCode
     * @return Varien_Simplexml_Element
     */
    public function getSections($sectionCode=null, $websiteCode=null, $storeCode=null)
    {
        $sections = parent::getSections($sectionCode, $websiteCode, $storeCode);
        $carriers = Mage::getSingleton('shipping/config')->getActiveCarriers();

        if (isset($sections->insurance) && isset($sections->insurance->groups->carriername)) {
            foreach ($carriers as $carrier) {
                $carrier_code = $carrier->getCarrierCode();
                $carrier->setTitle(Mage::getStoreConfig("carriers/" . $carrier_code . "/title"));
                $cg = new Mage_Core_Model_Config_Element('<node><' . $carrier_code . '/></node>');
                $cg->$carrier_code->extend($this->_groupClone($sections->insurance->groups->carriername, $carrier));
                $sections->insurance->groups->extend($cg);
            }

            unset($sections->insurance->groups->carriername); //unset template so empty group won't be shown
        }

        return $sections;
    }
}
