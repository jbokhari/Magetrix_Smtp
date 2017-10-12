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
    ){
        $this->_scopeConfig    = $scopeConfig;
        $this->_encryptor      = $encryptor;
    }

    public function getHost(){
        return $this->_scopeConfig->getValue(
            'magetrix/smtp/host',
             ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getAuth(){
        return $this->_scopeConfig->getValue(
         'magetrix/smtp/auth',
          ScopeInterface::SCOPE_STORE
        );
    }

    public function getSsl(){
        return $this->_scopeConfig->getValue(
         'magetrix/smtp/ssl',
          ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getPort(){
        $port = $this->_scopeConfig->getValue(
         'magetrix/smtp/port',
          ScopeInterface::SCOPE_STORE
        );
        return intval($port);
    }

    public function getUsername(){
        $username = $this->_scopeConfig->getValue(
         'magetrix/smtp/username',
          ScopeInterface::SCOPE_STORE
        );
        return $username;
    }

    public function getPassword(){
        $passwordObscured = $this->_scopeConfig->getValue(
         'magetrix/smtp/password',
          ScopeInterface::SCOPE_STORE
        );
        return $this->_encryptor->decrypt($passwordObscured);
    }

}