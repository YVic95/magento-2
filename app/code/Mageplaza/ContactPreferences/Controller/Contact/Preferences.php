<?php

namespace Mageplaza\ContactPreferences\Controller\Contact;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Psr\Log\LoggerInterface;
use phpDocumentor\Reflection\Types\Boolean;

class Preferences extends AbstractAccount
{
    protected $customerSession;
    protected $customerRepository;
    protected $logger;
    protected $resultFactory;
    
    public function __construct(
        Context $context,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        LoggerInterface $logger
    )
    {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        if($this->getRequest()->isPost()) {
            $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
            if($this->getRequest()->getParam('load')) {
                // This POST request triggers "contact_preferences" section load
            } else {
                try {
                    $requestParams = $this->getRequest()->getParams();
                    $preferences = implode(',',
                        array_keys(
                            array_filter(
                                $requestParams,
                                function($_cheked, $_preference) {
                                    return filter_var($_cheked, FILTER_VALIDATE_BOOLEAN);
                                },
                                ARRAY_FILTER_USE_BOTH
                            )
                        )
                    );
                    $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
                    $customer->setCustomAttribute('contact_preferences', $preferences);
                    $this->customerRepository->save($customer);
                    $this->messageManager->addSuccessMessage(__('Contact preferences successfully saved!'));
                } catch(\Exception $e) {
                    $this->logger->critical($e);
                    $this->messageManager->addErrorMessage(__('Error occured during contact preferences saving!'));
                }
            }
            return $resultJson;
        } else {
            $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
            $resultPage->getConfig()->getTitle()->set(__('My Contact Preferences'));
            return $resultPage;
        }
    }
}