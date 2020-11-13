## 安装

```shell
$ composer require jncinet/qihucms-sign-in
```

## 使用

### 路由参数说明

#### 会员签到

```php
route('api.sign-in.sign')
请求：POST
地址：/sign-in/sign
参数：
返回值：
{
    result: {
            code：签到提示码
            data：连续签到的天数
    },
    message: "成功",
    status: "success"
}

```

#### 签到排行榜

```php
route('api.sign-in.ranking')
请求：GET
地址：/sign-in/ranking
参数：
int $limit （选填）每页显示的条数
返回值：
{
    status: 'SUCCESS',
    data: {
        1: {
            user: 会员信息
            count：连续签到天数
            created_at：首次签到时间
            updated_at：最后签到时间
        }
        ...
    }
}
```

### 事件调用

```php
// 签到事件绑定
Qihucms\SignIn\Events\Signed
```