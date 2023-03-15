<?php 

namespace Mageplaza\ContactPreferences\CustomerData;

use Magento\Framework\DataObject;
use Magento\Customer\CustomerData\SectionSourceInterface;

class Preferences extends DataObject implements SectionSourceInterface
{
    protected $preferences;
    protected $customerSession;

    public function __construct(
        \Mageplaza\ContactPreferences\Model\Entity\Attribute\Source\Contact\Preferences $preferences,
        \Magento\Customer\Model\Session $customerSession,
        array $data = [] 
    )
    {
        $this->preferences = $preferences;
        $this->customerSession = $customerSession;
        parent::__construct($data);
    }

    public function getSectionData()
    {
        $existingPreferences = explode(',',
            $this->customerSession->getCustomer()->getContactPreferences()
        );

        $availablePreferences = [];

        foreach ($this->preferences->getAllOptions() as $_option) {
            $availablePreferences[] = [
                'label' => $_option['label'],
                'value' => $_option['value'],
                'checked' => in_array($_option['value'], $existingPreferences)
            ];
        }

        return [
            'selectOptions' => $availablePreferences,
            'isCustomerLoggedIn' => $this->customerSession->isLoggedIn()
        ];
    }   
}