<?php

namespace Mageplaza\ContactPreferences\Model\Entity\Attribute\Source\Contact;

class Preferences extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    const VALUE_EMAIL = 'email';
    const VALUE_SMS = 'sms';
    const VALUE_PHONE = 'phone';
    const VALUE_POST = 'post';

    public function getAllOptions()
    {
        return [
            ['label' => __('Email'), 'value' => self::VALUE_EMAIL],
            ['label' => __('Sms'), 'value' => self::VALUE_SMS],
            ['label' => __('Phone'), 'value' => self::VALUE_PHONE],
            ['label' => __('Post'), 'value' => self::VALUE_POST]
        ];
    }
}