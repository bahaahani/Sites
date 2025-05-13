<?php
/**
 * Custom controller to forward to a product page
 */
namespace Bahaa\Shamtoot\Controller\Route;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{
    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Execute method
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        // You can change the product ID to any product from your sample data
        $productId = 1; // Example product ID
        
        // Create redirect to the product page
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('catalog/product/view', ['id' => $productId]);
        
        return $resultRedirect;
    }
} 