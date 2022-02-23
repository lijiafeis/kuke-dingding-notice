<?php

declare(strict_types=1);

namespace DingdingNotice;

class Config
{
    private bool $enable;
    private string $noticeUrl;
    private string $secret;
    private array $atMobile;

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable(bool $enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @return string
     */
    public function getNoticeUrl(): string
    {
        return $this->noticeUrl;
    }

    /**
     * @param string $noticeUrl
     */
    public function setNoticeUrl(string $noticeUrl): void
    {
        $this->noticeUrl = $noticeUrl;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }

    /**
     * @return array
     */
    public function getAtMobile(): array
    {
        return $this->atMobile;
    }

    /**
     * @param array $atMobile
     */
    public function setAtMobile(array $atMobile): void
    {
        $this->atMobile = $atMobile;
    }

    public function isAtAll(): bool
    {
        return !(bool)$this->atMobile;
    }

}