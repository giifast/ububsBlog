<?php
namespace App\Service;

class ApiService extends BaseService
{

    public static function getAddressByIP($ip)
    {
        $url    = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
        $ipinfo = json_decode(file_get_contents($url));
        if (empty($ipinfo)) {
            return '';
        }
        if ($ipinfo->code == '1') {
            return '';
        }
        $city = $ipinfo->data->region . '-' . $ipinfo->data->city;
        return $city;
    }

}
