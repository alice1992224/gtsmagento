<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Gts\FarmTest\Block;

/**
 * Onepage checkout block
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Onepage extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $formKey;

    /**
     * @var bool
     */
    protected $_isScopePrivate = false;

    /**
     * @var array
     */
    protected $jsLayout;

    /**
     * @var \Magento\Checkout\Model\CompositeConfigProvider
     */
    protected $configProvider;

    /**
     * @var array|\Magento\Checkout\Block\Checkout\LayoutProcessorInterface[]
     */
    protected $layoutProcessors;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param \Magento\Checkout\Model\CompositeConfigProvider $configProvider
     * @param array $layoutProcessors
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\CompositeConfigProvider $configProvider,
        array $layoutProcessors = [],
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
        $this->_isScopePrivate = true;
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout']) ? $data['jsLayout'] : [];
        $this->configProvider = $configProvider;
        $this->layoutProcessors = $layoutProcessors;
    }

    /**
     * @return string
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            error_log('gggggg');
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        //var_dump_log($this->jsLayout);
        return \Zend_Json::encode($this->jsLayout);
    }

    /**
     * Retrieve form key
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    /**
     * Retrieve checkout configuration
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function getCheckoutConfig()
    {
        return $this->configProvider->getConfig();
    }

    /**
     * Get base url for block.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * Get checkout config
     *
     * @return array
     * @codeCoverageIgnore
     */
    public function myFunction(){
        $checkoutConfig = $this->getCheckoutConfig();
        return $checkoutConfig['quoteItemData'];
    }
}
