## [Hyperf-dingding-notice](https://github.com/lijiafeis/kuke-dingding-notice)
Hyperf 框架的钉钉推送组件

## 安装配置
1. 安装
`composer require kukewang/dingding-notice`
2. 发布配置文件
   `php bin/hyperf.php vendor:publish kukewang/dingding-notice`

### 使用
组件封装了三种类型
1. dingding-notice\src\Bean\Markdown
2. dingding-notice\src\Bean\Text
3. dingding-notice\src\Bean\Link

```
   $markdown = new Markdown("这是标题", "这是内容");
   DingDingNotice::notice($markdown);
```

如果需要发送异常通知，可直接调用 `exceptionNotice(Throwable $e)` 方法
`DingDingNotice::exceptionNotice($e);`


当前组件还未对发送限制做优化
```
由于消息发送太频繁会严重影响群成员的使用体验，因此钉钉开放平台对自定义机器人发送消息的频率作出以下限制：

每个机器人每分钟最多发送20条消息到群里，如果超过20条，会限流10分钟。
```