<?php

namespace Swarming\SubscribePro\Model\Quote;

use Magento\Framework\Api\AbstractSimpleObject;
use Swarming\SubscribePro\Api\Data\SubscriptionOptionInterface;

/**
 * @codeCoverageIgnore
 */
class SubscriptionOption extends AbstractSimpleObject implements SubscriptionOptionInterface
{
    /**
     * @return string|null
     */
    public function getOption()
    {
        return $this->_get(self::OPTION);
    }

    /**
     * @param string $option
     * @return $this
     */
    public function setOption($option)
    {
        return $this->setData(self::OPTION, $option);
    }

    /**
     * @return string|null
     */
    public function getInterval()
    {
        return $this->_get(self::INTERVAL);
    }

    /**
     * @param string $interval
     * @return $this
     */
    public function setInterval($interval)
    {
        return $this->setData(self::INTERVAL, $interval);
    }

    /**
     * @return bool
     */
    public function getIsFulfilling()
    {
        return (bool)$this->_get(self::IS_FULFILLING);
    }

    /**
     * @param bool $isFulfilling
     * @return $this
     */
    public function setIsFulfilling($isFulfilling)
    {
        $this->setData(self::IS_FULFILLING, $isFulfilling);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubscriptionId()
    {
        return $this->_get(self::SUBSCRIPTION_ID);
    }

    /**
     * @param int $subscriptionId
     * @return $this
     */
    public function setSubscriptionId($subscriptionId)
    {
        return $this->setData(self::SUBSCRIPTION_ID, $subscriptionId);
    }

    /**
     * @return string|null
     */
    public function getReorderOrdinal()
    {
        $string = "\n\n --------------- \n" . json_encode(['data' => $this->_data]) . "\n";
        file_put_contents('/var/www/magento2/var/log/debugger.log', $string , FILE_APPEND | LOCK_EX);
        return $this->_get(self::REORDER_ORDINAL);
    }

    /**
     * @param string $reorderOrdinal
     * @return $this
     */
    public function setReorderOrdinal($reorderOrdinal)
    {
        return $this->setData(self::REORDER_ORDINAL, $reorderOrdinal);
    }

    /**
     * This determines if a subscription was ordered from the frontend
     *
     * @return bool
     */
    public function getCreatesNewSubscription()
    {
        return (bool)($this->getOption() === 'subscription');
    }
}
