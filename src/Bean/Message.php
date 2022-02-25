<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;

use DingdingNotice\Config;
use DingdingNotice\Exception\RequestException;
use DingdingNotice\Request\Request;
use GuzzleHttp\Exception\GuzzleException;

abstract class Message implements RequestInterface
{
    protected Config $config;

    public function __construct()
    {
        $container = \Hyperf\Utils\ApplicationContext::getContainer();
        $this->config = $container->get(Config::class);
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }



    /**
     * 组装请求钉钉的数据结构
     * @return array
     */
    abstract protected function assembleRequestParams(): array;

    /**
     * 请求钉钉
     * @return bool
     * @throws RequestException
     * @throws GuzzleException
     */
    public function requestDingDing(): bool
    {
        return Request::requestDingDing($this->config, $this->assembleRequestParams());
    }
}