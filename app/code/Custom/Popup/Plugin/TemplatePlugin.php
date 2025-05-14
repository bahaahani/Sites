<?php
namespace Custom\Popup\Plugin;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

class TemplatePlugin
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if popup is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            'custom_popup/general/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * After get template
     *
     * @param Template $subject
     * @param string $result
     * @return string
     */
    public function afterGetTemplate(Template $subject, $result)
    {
        // Only modify the template if we need to
        if ($subject->getNameInLayout() == 'custom_popup' && !$this->isEnabled()) {
            return '';
        }
        
        return $result;
    }
} 