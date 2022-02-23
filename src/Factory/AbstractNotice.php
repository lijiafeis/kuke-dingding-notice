<?php

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Message;
use DingdingNotice\Config;
use GuzzleHttp\Client;

abstract class AbstractNotice
{
    protected Config $config;

    public function __construct()
    {
        $container = \Hyperf\Utils\ApplicationContext::getContainer();
        $this->config = $container->get(Config::class);
    }

    abstract public function notice(Message $message);

    public function requestDingDing($body)
    {
        $options['headers'] = ['Content-Type' => 'application/json;charset=utf-8'];
        $options['json'] = $body;
        $options['verify'] = false;
        $guzzleClient = new Client();
        $response = $guzzleClient->request('POST', $this->config->getNoticeUrl(), $options);
        return json_decode($response->getBody()->getContents(), true);
    }

}