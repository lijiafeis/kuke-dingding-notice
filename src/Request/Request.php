<?php

declare(strict_types=1);


namespace DingdingNotice\Request;


use DingdingNotice\Config;
use DingdingNotice\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Request
{
    /**
     * @param Config $config
     * @param array $body
     * @return bool
     * @throws RequestException
     * @throws GuzzleException
     */
    public static function requestDingDing(Config $config, array $body): bool
    {
        //判断开关是否打开
        if ($config->isEnable() === false) {
            return false;
        }

        $url = $config->getNoticeUrl();
        //加签
        $time = floor(microtime(true) * 1000);
        $sign = self::sign($time, $config->getSecret());
        $url = $url . '&timestamp=' . $time . '&sign=' . $sign;

        $options['headers'] = ['Content-Type' => 'application/json;charset=utf-8'];
        $options['json'] = $body;
        $options['verify'] = false;
        $guzzleClient = new Client();
        $response = $guzzleClient->request('POST', $url, $options);
        $data = json_decode($response->getBody()->getContents(), true);
        if ($data['errcode'] != 0) {
            throw new RequestException($data['errmsg']);
        }

        return true;
    }

    private static function sign($time, $secret): string
    {
        $stringToSign = hash_hmac('sha256', $time . "\n" . $secret, $secret, true);
        $stringToSign = base64_encode($stringToSign);
        return urlencode($stringToSign);
    }
}