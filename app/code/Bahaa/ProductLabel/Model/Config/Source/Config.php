<?php
namespace Bahaa\ProductLabel\Model\Config\Source;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Check if module is enabled
     *
     * @param mixed $storeId
     * @return bool
     */
    public function isEnabled($storeId = null)
    {
        return (bool) $this->scopeConfig->getValue(
            'productlabel/general/enabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get on sale label text
     *
     * @param mixed $storeId
     * @return string
     */
    public function getOnSaleLabelText($storeId = null)
    {
        return $this->scopeConfig->getValue(
            'productlabel/general/on_sale_label',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get on sale label color
     *
     * @param mixed $storeId
     * @return string
     */
    public function getOnSaleLabelColor($storeId = null)
    {
        return $this->scopeConfig->getValue(
            'productlabel/general/on_sale_label_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get new product label text
     *
     * @param mixed $storeId
     * @return string
     */
    public function getNewLabelText($storeId = null)
    {
        return $this->scopeConfig->getValue(
            'productlabel/general/new_label',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get new product label color
     *
     * @param mixed $storeId
     * @return string
     */
    public function getNewLabelColor($storeId = null)
    {
        return $this->scopeConfig->getValue(
            'productlabel/general/new_label_color',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get days as new
     *
     * @param mixed $storeId
     * @return int
     */
    public function getDaysAsNew($storeId = null)
    {
        return (int) $this->scopeConfig->getValue(
            'productlabel/general/days_as_new',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
} 