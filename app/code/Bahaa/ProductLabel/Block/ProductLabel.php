<?php
namespace Bahaa\ProductLabel\Block;

use Bahaa\ProductLabel\Model\Config\Source\Config;
use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ProductLabel extends Template
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * @param Context $context
     * @param Config $config
     * @param PriceCurrencyInterface $priceCurrency
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->config = $config;
        $this->priceCurrency = $priceCurrency;
        parent::__construct($context, $data);
    }

    /**
     * Check if module is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->config->isEnabled();
    }

    /**
     * Check if product is on sale
     *
     * @param Product $product
     * @return bool
     */
    public function isOnSale(Product $product)
    {
        $finalPrice = $product->getPriceInfo()->getPrice('final_price')->getValue();
        $regularPrice = $product->getPriceInfo()->getPrice('regular_price')->getValue();
        
        return $finalPrice < $regularPrice;
    }

    /**
     * Check if product is new
     *
     * @param Product $product
     * @return bool
     */
    public function isNew(Product $product)
    {
        $createdAt = strtotime($product->getCreatedAt());
        $now = time();
        $daysAsNew = $this->config->getDaysAsNew();
        
        if (!$daysAsNew) {
            $daysAsNew = 30; // Default value
        }
        
        // Check if the product was created within the configured number of days
        return (($now - $createdAt) / 86400) <= $daysAsNew;
    }

    /**
     * Get on sale label text
     *
     * @return string
     */
    public function getOnSaleLabelText()
    {
        return $this->config->getOnSaleLabelText();
    }

    /**
     * Get on sale label color
     *
     * @return string
     */
    public function getOnSaleLabelColor()
    {
        return $this->config->getOnSaleLabelColor();
    }

    /**
     * Get new product label text
     *
     * @return string
     */
    public function getNewLabelText()
    {
        return $this->config->getNewLabelText();
    }

    /**
     * Get new product label color
     *
     * @return string
     */
    public function getNewLabelColor()
    {
        return $this->config->getNewLabelColor();
    }

    /**
     * Calculate discount percentage
     *
     * @param Product $product
     * @return int
     */
    public function getDiscountPercentage(Product $product)
    {
        $finalPrice = $product->getPriceInfo()->getPrice('final_price')->getValue();
        $regularPrice = $product->getPriceInfo()->getPrice('regular_price')->getValue();
        
        if ($regularPrice == 0) {
            return 0;
        }
        
        return round(100 - ($finalPrice / $regularPrice * 100));
    }
} 