<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use OmerKocaoglu\OPSkinsTradeService\Model\Config\ConfigModel;

class ConfigService extends ServiceBase
{
    /**
     * @return ConfigModel
     */
    public function getConfig()
    {
        return $this->getServiceConfig();
    }
}
