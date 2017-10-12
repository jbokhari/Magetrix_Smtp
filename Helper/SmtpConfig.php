<?php
namespace Magetrix\Smtp\Helper;

use \Magento\Store\Model\ScopeInterface;

class SmtpConfig
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface 
     */
    protected $_scopeConfig;

    /**
     * @var \Magento\Framework\App\Config\ConfigResource\ConfigInterface
     */
    // protected $_resourceConfig;

    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface 
     */
    protected $_encryptor;

    /**
     * 
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Encryption\EncryptorInterface $encryptor
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
        // \Magento\Framework\App\Config\ConfigResource\ConfigInterface $resourceConfig
    ){
        $this->_scopeConfig    = $scopeConfig;
        // $this->_resourceConfig = $resourceConfig;
        $this->_encryptor      = $encryptor;
    }

    // public function isActive(){
    //     // $storeId = $this->getStoreId();
    //     return $this->_scopeConfig->getValue(
    //         'magetrix/smtp/enable',
    //          ScopeInterface::SCOPE_STORE
    //     );
    // }

    // public function isDebug(){
    //   return $this->_scopeConfig->getValue(
    //      'shopperapproved/general/debug',
    //       ScopeInterface::SCOPE_STORE
    //     );
    // }

    public function getHost(){
        // $storeId = $this->getStoreId();
        return $this->_scopeConfig->getValue(
            'magetrix/smtp/host',
             ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getAuth(){
        // $storeId = $this->getStoreId();
        return $this->_scopeConfig->getValue(
         'magetrix/smtp/auth',
          ScopeInterface::SCOPE_STORE
        );
    }

    public function getSsl(){
        // $storeId = $this->getStoreId();
        return $this->_scopeConfig->getValue(
         'magetrix/smtp/ssl',
          ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getPort(){
        // $storeId = $this->getStoreId();
        $port = $this->_scopeConfig->getValue(
         'magetrix/smtp/port',
          ScopeInterface::SCOPE_STORE
        );
        return intval($port);
    }

    public function getUsername(){
        // $storeId = $this->getStoreId();
        $username = $this->_scopeConfig->getValue(
         'magetrix/smtp/username',
          ScopeInterface::SCOPE_STORE
        );
        return $username;
    }

    public function getPassword(){
        // $storeId = $this->getStoreId();
        $passwordObscured = $this->_scopeConfig->getValue(
         'magetrix/smtp/password',
          ScopeInterface::SCOPE_STORE
        );
        return $this->_encryptor->decrypt($passwordObscured);
    }
}