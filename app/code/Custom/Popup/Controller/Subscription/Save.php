<?php
namespace Custom\Popup\Controller\Subscription;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Validator\EmailAddress;

class Save extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var FormKeyValidator
     */
    protected $formKeyValidator;

    /**
     * @var SubscriberFactory
     */
    protected $subscriberFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var EmailAddress
     */
    protected $emailValidator;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param FormKeyValidator $formKeyValidator
     * @param SubscriberFactory $subscriberFactory
     * @param StoreManagerInterface $storeManager
     * @param EmailAddress $emailValidator
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        FormKeyValidator $formKeyValidator,
        SubscriberFactory $subscriberFactory,
        StoreManagerInterface $storeManager,
        EmailAddress $emailValidator
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->subscriberFactory = $subscriberFactory;
        $this->storeManager = $storeManager;
        $this->emailValidator = $emailValidator;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $result = ['success' => false];

        try {
            if (!$this->formKeyValidator->validate($this->getRequest())) {
                $result['message'] = __('Invalid form key. Please refresh the page and try again.');
                return $resultJson->setData($result);
            }

            $email = $this->getRequest()->getParam('email');
            if (!$email || !$this->emailValidator->isValid($email)) {
                $result['message'] = __('Please enter a valid email address.');
                return $resultJson->setData($result);
            }

            $storeId = $this->storeManager->getStore()->getId();
            $subscriber = $this->subscriberFactory->create();
            $subscriber->setStoreId($storeId);
            
            // Check if already subscribed
            $status = $subscriber->loadByEmail($email)->getStatus();
            if ($subscriber->getId() && $status == \Magento\Newsletter\Model\Subscriber::STATUS_SUBSCRIBED) {
                $result['message'] = __('This email address is already subscribed.');
                $result['success'] = true;
                return $resultJson->setData($result);
            }

            // Subscribe
            $subscriber->subscribe($email);
            $result = [
                'success' => true,
                'message' => __('Thank you for your subscription.')
            ];
        } catch (\Exception $e) {
            $result = [
                'success' => false,
                'message' => __('Something went wrong with the subscription: %1', $e->getMessage())
            ];
        }

        return $resultJson->setData($result);
    }
} 