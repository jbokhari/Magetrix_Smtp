<?php
/**
 * Mail Transport
 */
namespace Magetrix\Smtp\Model;
 
class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;
    /**
     * @var \Magetrix\Smtp\Helper\SmtpConfig
     */
    protected $_helper;
 
    /**
     * @param MessageInterface $message
     * @param \Magetrix\Smtp\Help`er\SmtpConfig $helper
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(
        \Magento\Framework\Mail\MessageInterface $message,
        \Magetrix\Smtp\Helper\SmtpConfig $helper,
        $parameters = null
    )
    {
        
        $this->_helper = $helper;

        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }

        $this->_message = $message;

        $smtpHost= $this->_helper->getHost(); //your smtp host  ';

        $smtpConf = [
            'auth' => $this->_helper->getAuth(),//auth type
            'ssl' => $this->_helper->getSsl(), 
            'port' => $this->_helper->getPort(),
            'username' => $this->_helper->getUsername(),//smtm user name
            'password' => $this->_helper->getPassword()//smtppassword 
        ];

        parent::__construct($smtpHost, $smtpConf);
        
    }
 
    /**
     * Send a mail using this transport
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->_message);
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }
}