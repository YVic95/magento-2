<?php

namespace Mageplaza\OrderNote\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveOrderNoteToOrder implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {   
        $event = $observer->getEvent();

        if($notes = $event->getQuote()->getOrderNotes()) {
            $event->getOrder()
                ->setOrderNotes($notes)
                ->addStatusHistoryComment('Customer note: ' . $notes);
        }
        return $this;
    }
}