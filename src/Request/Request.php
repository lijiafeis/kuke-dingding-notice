<?php

declare(strict_types=1);


namespace DingdingNotice\Request;


use DingdingNotice\Config;
use DingdingNotice\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Request
{
    /**
     * @param Config $config
     * @param array $body
     * @return bool
     * @throws RequestException
     * @throws GuzzleException|\JsonException
     */
    public static function requestDingDing(Config $config, array $body): bool
    {

        $url = $config->getNoticeUrl();
        //加签
        $time = floor(microtime(true) * 1000);
        $sign = self::sign($time, $config->getSecret());
        $url .= '&timestamp=' . $time . '&sign=' . $sign;
        $options = [
            'headers' => ['Content-Type' => 'application/json;charset=utf-8'],
            'json' => $body,
            'verify' => false
        ];
        $guzzleClient = new Client();
        $response = $guzzleClient->request('POST', $url, $options);
        return self::processingResult($response);

    }

    /**
     * 解析校验api返回的数据
     * @param ResponseInterface $response
     * @return bool
     * @throws RequestException|\JsonException
     */
    private static function processingResult(ResponseInterface $response): bool
    {
        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        if ($data['errcode'] !== 0) {
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