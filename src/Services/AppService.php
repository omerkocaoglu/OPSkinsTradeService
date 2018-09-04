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
        $response = $this->getClient()->get(OPSkinsTradeInterfaces::GET_ALL_SUPPORTED_APPS);
        $content = $response->getBody()->getContents();
        $http_status_code = $response->getStatusCode();
        /** @var SupportedAppModel $supported_apps */
        $supported_apps = $this->getJSONSerializer()->deserialize($content, new Type(SupportedAppModel::class));
        $supported_apps->response_content = $content;
        $supported_apps->http_status_code = $http_status_code;

        return $supported_apps;
    }
}
