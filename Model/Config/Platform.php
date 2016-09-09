<?php

namespace Swarming\SubscribePro\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Platform extends General
{
    /**
     * @param string|null $websiteCode
     * @return string
     */
    public function getBaseUrl($websiteCode = null)
    {
        return $this->scopeConfig->getValue('swarming_subscribepro/platform/base_url', ScopeInterface::SCOPE_WEBSITE, $websiteCode);
    }

    /**
     * @param string|null $websiteCode
     * @return string
     */
    public function getClientId($websiteCode = null)
    {
        return $this->scopeConfig->getValue('swarming_subscribepro/platform/client_id', ScopeInterface::SCOPE_WEBSITE, $websiteCode);
    }

    /**
     * @param string|null|bool $websiteCode
     * @return string
     */
    public function getClientSecret($websiteCode = null)
    {
        $scopeType = $websiteCode === false ? ScopeConfigInterface::SCOPE_TYPE_DEFAULT : ScopeInterface::SCOPE_WEBSITE;
        return $this->scopeConfig->getValue('swarming_subscribepro/platform/client_secret', $scopeType, $websiteCode);
    }

    /**
     * @param string|null $websiteCode
     * @return bool
     */
    public function isLogEnabled($websiteCode = null)
    {
        return $this->scopeConfig->isSetFlag('swarming_subscribepro/platform/log_enabled', ScopeInterface::SCOPE_WEBSITE, $websiteCode);
    }

    /**
     * @param string|null $websiteCode
     * @return string
     */
    public function getLogFilename($websiteCode = null)
    {
        return $this->scopeConfig->getValue('swarming_subscribepro/platform/log_filename', ScopeInterface::SCOPE_WEBSITE, $websiteCode);
    }
}
