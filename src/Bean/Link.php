<?php

declare(strict_types=1);


namespace DingdingNotice\Bean;


class Link extends Message
{
    private string $msgType = Type::LINK;
    private string $text;
    private string $title;
    private string $picUrl;
    private string $messageUrl;

    public function __construct(string $subject, string $content, string $picUrl, string $messageUrl)
    {
        parent::__construct();
        $this->title = $subject;
        $this->text = $content;
        $this->picUrl = $picUrl;
        $this->messageUrl = $messageUrl;
    }

    protected function assembleRequestParams(): array
    {
        return [
            "msgtype" => $this->msgType,
            "link" => [
                "text" => $this->text,
                "title" => $this->title,
                "picUrl" => $this->picUrl,
                "messageUrl" => $this->messageUrl,
            ]
        ];
    }
}