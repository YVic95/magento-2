<?php

namespace Mageplaza\OrderNote\Controller\Index;

use Mageplaza\OrderNote\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Checkout\Model\Session;
use Psr\Log\LoggerInterface;
use Magento\Framework\Controller\ResultFactory;

class Process extends Index
{
    protected $checkoutSession;
    protected $logger;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        LoggerInterface $logger
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            if($notes = $this->getRequest()->getParam('order_notes', null)) {
                $quote = $this->checkoutSession->getQuote();
                //or setOrderNotes ?
                $quote->setOrderNotes($notes);
                $quote->save();
            }

            $result = [
                'time' => (new \DateTime('now'))->format('Y-m-d H:i:s')
            ];
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $result = [
                'error' => __('Something went wrong!'),
                'errorcode' => $e->getCode()
            ];
        }

        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $resultJson->setData($result);
        return $resultJson;
    }
}