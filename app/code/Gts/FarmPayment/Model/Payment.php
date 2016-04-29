<?php

namespace Gts\FarmPayment\Model;

class Payment extends \Magento\Payment\Model\Method\Cc
{
    const CODE = 'gts_farm_payment';

    protected $_code = self::CODE;

    protected $_isGateway = true;
    protected $_canCapture = true;
    protected $_canCapturePartial = true;          // ?
    protected $_canRefund = false;
    protected $_canRefundInvoicePartial = false;    // ?
    protected $_debugReplacePrivateDataKeys = ['number', 'exp_month', 'exp_year', 'cvc'];


    // for strip
    protected $_stripeApi = false;
    protected $_countryFactory;
    protected $_minAmount = null;
    protected $_maxAmount = null;
    protected $_supportedCurrencyCodes = array('CNY', 'CNX');


    public function __construct(

        // the following is used for parent construct
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\Module\ModuleListInterface $moduleList,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Directory\Model\CountryFactory $countryFactory,    // use for self check
        //\Stripe\Stripe $stripe,
        array $data = array()
    ){
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $moduleList,
            $localeDate,
            null,
            null,
            $data
        );

        // used for self check
        $this->_countryFactory = $countryFactory;

        // used for strip
        /*
        $this->_stripeApi = $stripe;
        $this->_stripeApi->setApiKey(
            $this->getConfigData('api_key')
        );

        $this->_minAmount = $this->getConfigData('min_order_total');
        $this->_maxAmount = $this->getConfigData('max_order_total');
        */
    }


    /**
     * Payment capturing
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     * @throws \Magento\Framework\Validator\Exception
     */
    public function capture(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        error_log('in Farm Payment capture');
        $reqData = [
            'amount'    =>  $amount,
            'cc_number' =>  $payment->getCcNumber(),
            'exp_month' =>  sprintf('%02d',$payment->getCcExpMonth()),
            'exp_year'  =>  $payment->getCcExpYear(),
            'cvc'       =>  $payment->getCcCid(),
        ];
        error_log('=== Farm Payment Request Data ===');
        var_dump_log($reqData);
        $transactionId = "card_184OaN2eZvKYlo2CIqJV7laA";
        $payment
            ->setTransactionId($transactionId)
            ->setIsTransactionClosed(0);
    }

    /**
     * Payment refund
     *
     * @param \Magento\Payment\Model\InfoInterface $payment
     * @param float $amount
     * @return $this
     * @throws \Magento\Framework\Validator\Exception

    public function refund(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
    }
     */

    /**
     * Determine method availability based on quote amount and config data
     *
     * @param \Magento\Quote\Api\Data\CartInterface|null $quote
     * @return bool
     */
    public function isAvailable(\Magento\Quote\Api\Data\CartInterface $quote = null)
    {
        return parent::isAvailable($quote);
    }

    /**
     * Availability for currency
     *
     * @param string $currencyCode
     * @return bool
     */
    public function canUseForCurrency($currencyCode)
    {
        if (!in_array($currencyCode, $this->_supportedCurrencyCodes)) {
            error_log('[ERROR] canUseForCurrency: not support this currencyCode '.$currencyCode);
            return false;
        }
        return true;
    }
}