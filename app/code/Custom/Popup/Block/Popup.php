<?php
namespace Custom\Popup\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Popup extends Template
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config paths
     */
    const XML_PATH_ENABLED = 'custom_popup/general/enabled';
    const XML_PATH_POPUP_DELAY = 'custom_popup/general/popup_delay';
    const XML_PATH_COOKIE_LIFETIME = 'custom_popup/general/cookie_lifetime';

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Check if the popup is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) $this->scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get popup delay in seconds
     *
     * @return int
     */
    public function getPopupDelay()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_POPUP_DELAY,
            ScopeInterface::SCOPE_STORE
        ) * 1000; // Convert to milliseconds
    }

    /**
     * Get cookie lifetime in days
     *
     * @return int
     */
    public function getCookieLifetime()
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_COOKIE_LIFETIME,
            ScopeInterface::SCOPE_STORE
        );
    }
} 