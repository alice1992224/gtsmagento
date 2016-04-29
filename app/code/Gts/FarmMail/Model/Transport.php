<?php
/**
 * Mail Transport
 */
namespace Gts\FarmMail\Model;


class Transport extends \Zend_Mail_Transport_Smtp implements \Magento\Framework\Mail\TransportInterface
{
    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $_message;

    /**
     * @param MessageInterface $message
     * @param null $parameters
     * @throws \InvalidArgumentException
     */
    public function __construct(\Magento\Framework\Mail\MessageInterface $message)
    {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException('The message should be an instance of \Zend_Mail');
        }
        $smtpHost= 'smtp.gmail.com';
        $smtpConf = [
            'auth' => 'login',
            'port' => '465',
            'ssl' => 'ssl', /* the value of 'ssl' field can be 'tls' or 'ssl' */
            'username' => 'gtsfarmowner@gmail.com',
            'password' => 'magento2016'
        ];

        parent::__construct($smtpHost, $smtpConf);
        $this->_message = $message;
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
            error_log('ccccccccc');
            error_log($e->getMessage());
            throw new \Magento\Framework\Exception\MailException(new \Magento\Framework\Phrase($e->getMessage()), $e);
        }
    }
}