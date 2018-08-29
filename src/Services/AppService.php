<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeInterfaces;
use OmerKocaoglu\OPSkinsTradeService\Model\App\SupportedAppModel;

class AppService extends ServiceBase
{
    /**
     * @return SupportedAppModel
     */
    public function getSupportedApps()
    {
        $content = $this->getClient()->get(OPSkinsTradeInterfaces::GET_ALL_SUPPORTED_APPS)->getBody()->getContents();
        /** @var SupportedAppModel $supported_apps */
        $supported_apps = $this->serializer->deserialize($content, new Type(SupportedAppModel::class));
        return $supported_apps;
    }
}
