<?php

namespace Mageplaza\StarTrack\Model\Carrier;

use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Psr\Log\LoggerInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\OfflineShipping\Model\Carrier\Flatrate\ItemPriceCalculator;

class StarTrack extends AbstractCarrier implements CarrierInterface
{
    const CARRIER_CODE = 'startrack';
    const STAR_TRACK_STANDARD = 'startrackstandard';
    const STAR_TRACK_48h = 'startrack48h';

    protected $_code = self::CARRIER_CODE;
    protected $_isFixed = true;
    protected $_rateResultFactory;
    protected $_rateMethodFactory;
    private $itemPriceCalculator;

    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig 
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param ItemPriceCalculator $itemPriceCalculator
     * @param array $data 
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        ItemPriceCalculator $itemPriceCalculator,
        array $data = []
    )
    {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->itemPriceCalculator = $itemPriceCalculator;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);  
    }

    /**
     * {@inheritdoc}
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** 
         * Init result object
         * @var Result $result 
         */
        $result = $this->_rateResultFactory->create();

        $shippingPrice = $this->getShippingPrice($request);

        //if ($shippingPrice !== false) {
            $method = $this->createResultMethodStandard($shippingPrice);//$shippingPrice;
            $result->append($method);
        //}

        return $result;
    }

    /**
     * Returns shipping price
     *
     * @param RateRequest $request
     * 
     * @return bool|float
     */
    private function getShippingPrice(RateRequest $request)
    {
        $shippingPrice = false;
        $configPrice = $this->getConfigData('startrackstandard/shippingcost');
        $shippingPrice = $this->itemPriceCalculator->getShippingPricePerItem($request, $configPrice, 0);
        $weight = $request->getPackageWeight();

        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                if ($item->getProduct()->isVirtual() || $item->getParentItem()) {
                    continue;
                }
                if($weight > 50) $shippingPrice *= 2;
            }
        }

        return $shippingPrice;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return [
            self::STAR_TRACK_STANDARD => $this->getConfigData(self::STAR_TRACK_STANDARD . '/title'),
            //self::ROYAL_TREK_48HR => $this->getConfigData(self::ROYAL_TREK_48HR . '/title'),
        ];
    }

    /**
     * Creates result method
     *
     * @param int|float $shippingPrice
     * @return \Magento\Quote\Model\Quote\Address\RateResult\Method
     */
    private function createResultMethodStandard($shippingPrice)
    {
        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod(self::STAR_TRACK_STANDARD);
        $method->setMethodTitle($this->getMethodTitle($method->getMethod()));

        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);
        return $method;
    }

    /**
     * @param $method
     * @return false|string
     */
    private function getMethodTitle($method)
    {
        return $this->getConfigData($method . '/title');
    }
}