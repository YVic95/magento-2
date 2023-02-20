<?php

namespace Mageplaza\Catalog\Plugin; 

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class NewProductFlag
{
    protected $request;
    protected $localeDate;

    public function __construct(
        RequestInterface $request,
        TimezoneInterface $localeDate
    )
    {
        $this->request = $request;
        $this->localeDate = $localeDate;
    }

    public function afterGetName(\Magento\Catalog\Api\Data\ProductInterface $subject, $result)
    {
        $pages = ['catalog_product_view', 'catalog_category_view'];

        if(in_array($this->request->getFullActionName(), $pages)) {
            $timezone = new \DateTimeZone($this->localeDate->getConfigTimezone());
            $now = new \DateTime('now', $timezone);
            $createdAt = \DateTime::createFromFormat(
                'Y-m-d H:i:s',
                $subject->getCreatedAt(),
                $timezone
            );

            if($now->diff($createdAt)->days < 10) {
                return __('!NEW! ') . $result;
            }
        }

        return $result;
    }
}