<?php

namespace Swarming\SubscribePro\Helper;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Quote\Api\Data\ProductOptionInterface;
use Magento\Quote\Api\Data\CartItemInterface;
use Swarming\SubscribePro\Model\Quote\SubscriptionOption\OptionProcessor;

class ProductOption
{
    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    protected $reflectionObjectProcessor;

    /**
     * @var \Magento\Framework\Webapi\ServiceInputProcessor
     */
    protected $inputProcessor;

    /**
     * @param \Magento\Framework\Reflection\DataObjectProcessor $reflectionObjectProcessor
     * @param \Magento\Framework\Webapi\ServiceInputProcessor $inputProcessor
     */
    public function __construct(
        \Magento\Framework\Reflection\DataObjectProcessor $reflectionObjectProcessor,
        \Magento\Framework\Webapi\ServiceInputProcessor $inputProcessor
    ) {
        $this->reflectionObjectProcessor = $reflectionObjectProcessor;
        $this->inputProcessor = $inputProcessor;
    }

    /**
     * @param \Swarming\SubscribePro\Api\Data\SubscriptionInterface $subscription
     * @return \Magento\Quote\Api\Data\CartItemInterface
     */
    public function getCartItem($subscription)
    {
        $cartItemData = [
            CartItemInterface::KEY_SKU => $subscription->getProductSku(),
            CartItemInterface::KEY_QTY => $subscription->getQty(),
            CartItemInterface::KEY_PRODUCT_OPTION => $subscription->getProductOption()
        ];

        /** @var \Magento\Quote\Api\Data\CartItemInterface $cartItem */
        $cartItem = $this->inputProcessor->convertValue($cartItemData, CartItemInterface::class);
        return $cartItem;
    }

    /**
     * @param \Magento\Quote\Api\Data\CartItemInterface $quoteItem
     * @return array
     */
    public function getProductOption($quoteItem)
    {
        $productOptions = $quoteItem->getProductOption();
        if ($productOptions) {
            $productOptions = $this->reflectionObjectProcessor->buildOutputDataArray($productOptions, ProductOptionInterface::class);
            $productOptions = $this->cleanSubscriptionOption($productOptions);
        } else {
            $productOptions = [];
        }
        return $productOptions;
    }

    /**
     * @param array $productOptions
     * @return array
     */
    protected function cleanSubscriptionOption($productOptions)
    {
        if (isset($productOptions[ExtensibleDataInterface::EXTENSION_ATTRIBUTES_KEY][OptionProcessor::KEY_SUBSCRIPTION_OPTION])) {
            unset($productOptions[ExtensibleDataInterface::EXTENSION_ATTRIBUTES_KEY][OptionProcessor::KEY_SUBSCRIPTION_OPTION]);
        }

        if (empty($productOptions[ExtensibleDataInterface::EXTENSION_ATTRIBUTES_KEY])) {
            unset($productOptions[ExtensibleDataInterface::EXTENSION_ATTRIBUTES_KEY]);
        }
        return $productOptions;
    }
}
