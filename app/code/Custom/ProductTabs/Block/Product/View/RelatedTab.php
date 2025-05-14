<?php
namespace Custom\ProductTabs\Block\Product\View;

use Magento\Catalog\Block\Product\View\Description;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Helper\Image;
use Magento\Framework\Pricing\Helper\Data as PriceHelper;
use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Block\Product\Context as ProductContext;
use Magento\Framework\Data\Form\FormKey;

class RelatedTab extends Description
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;
    
    /**
     * @var Image
     */
    protected $imageHelper;
    
    /**
     * @var PriceHelper
     */
    protected $priceHelper;
    
    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * Constructor
     *
     * @param ProductContext $context
     * @param CollectionFactory $productCollectionFactory
     * @param Image $imageHelper
     * @param PriceHelper $priceHelper
     * @param FormKey $formKey
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        CollectionFactory $productCollectionFactory,
        Image $imageHelper,
        PriceHelper $priceHelper,
        FormKey $formKey,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        $this->priceHelper = $priceHelper;
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }
    
    /**
     * Get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    
    /**
     * Get product image url
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param string $imageId
     * @return string
     */
    public function getProductImageUrl($product, $imageId = 'product_small_image')
    {
        return $this->imageHelper->init($product, $imageId)->getUrl();
    }
    
    /**
     * Get formatted product price
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getFormattedProductPrice($product)
    {
        return $this->priceHelper->currency($product->getFinalPrice(), true, false);
    }
    
    /**
     * Get add to cart url
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return string
     */
    public function getAddToCartUrl($product)
    {
        return $this->getUrl('checkout/cart/add');
    }
} 