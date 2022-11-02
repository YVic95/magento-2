<?php
/**
 * Adminhtml Product controller
 */

namespace Mageplaza\MyInventory\Controller\Adminhtml;

// or Action? 

abstract class Product extends \Magento\Backend\App\AbstractAction
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Mageplaza_MyInventory::myinventory';
}