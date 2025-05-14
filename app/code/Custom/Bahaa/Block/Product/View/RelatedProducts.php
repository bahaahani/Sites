<?php
namespace Custom\Bahaa\Block\Product\View;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Registry;

class RelatedProducts extends AbstractProduct
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Registry $registry,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->registry = $registry;
        $this->imageHelper = $context->getImageHelper();
        parent::__construct($context, $data);
    }

    /**
     * Get current product
     *
     * @return Product|null
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    /**
     * Get related products
     *
     * @return Collection
     */
    public function getRelatedProducts()
    {
        $currentProduct = $this->getCurrentProduct();
        if (!$currentProduct) {
            return [];
        }

        // Get related products from the product's relation
        $collection = $currentProduct->getRelatedProductCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status', 1)
            ->addAttributeToFilter('visibility', ['neq' => 1])
            ->setPageSize(4);  // Limit to 4 related products

        return $collection;
    }

    /**
     * Get product image URL
     *
     * @param Product $product
     * @return string
     */
    public function getProductImageUrl(Product $product)
    {
        return $this->imageHelper->init($product, 'product_page_image_small')
            ->setImageFile($product->getSmallImage())
            ->getUrl();
    }

    /**
     * Get related product URL
     *
     * @param Product $product
     * @return string
     */
    public function getRelatedProductUrl(Product $product)
    {
        return $product->getProductUrl();
    }

    /**
     * Get formatted price
     *
     * @param Product $product
     * @return string
     */
    public function getFormattedPrice(Product $product)
    {
        return $this->priceCurrency->format($product->getFinalPrice());
    }
} 