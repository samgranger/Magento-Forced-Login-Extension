<?php 

class Serve2_Forcedlogin_Model_Observer{        

    public function __construct() {
    
    }
        
    public function checkLogin($observer) {
    
        if ($this->_isApiRequest()) {
            return;
        }

        if (Mage::getStoreConfigFlag('serve2_forcedlogin/general/enabled')) {
            if(!$this->_isLoggedIn() && !$this->isCustomerModule()) {
                Mage::app()->getResponse()->setRedirect(Mage::getUrl('customer/account/login'));
            }
            return $this;
        }
    }

    protected function _isLoggedIn() {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    protected function _isApiRequest() {
        return Mage::app()->getRequest()->getModuleName() === 'api';
    }
    
    protected function _isCustomerModule() {
        return Mage::app()->getRequest()->getModuleName() === 'customer';
    }
}    
