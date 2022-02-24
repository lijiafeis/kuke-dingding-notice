## [Hyperf-dingding-notice](https://github.com/lijiafeis/kuke-dingding-notice)
Hyperf 框架的钉钉推送组件

## 使用
`composer require kukewang/hyperf_xxl_job`

### text
```
DingDingNotice::text('这是内容');
```
### mark
```
DingDingNotice::markdown("这是标题", "这是内容");
```


当前组件还未对发送限制做优化
```
由于消息发送太频繁会严重影响群成员的使用体验，因此钉钉开放平台对自定义机器人发送消息的频率作出以下限制：

每个机器人每分钟最多发送20条消息到群里，如果超过20条，会限流10分钟。
```