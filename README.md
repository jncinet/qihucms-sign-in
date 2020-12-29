<h1 align="center">会员签到</h1>

## 安装

```shell
$ composer require jncinet/qihucms-sign-in
```

## 使用
### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\SignIn\SignInServiceProvider"
```

### 后台菜单
+ 签到记录：sign-in/logs

### 路由参数说明

#### 会员签到

```
route('api.sign.in')
请求：POST
地址：/sign/in
参数：
返回值：
{
    result: {
            code：签到提示码
            data：连续签到的天数
    },
    status: "success"
}

```

#### 签到排行榜

```
route('api.sign.ranking')
请求：GET
地址：/sign/ranking
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

## 数据库
### 签到记录表：sign_ins
| Field             | Type      | Length    | AllowNull | Default   | Comment   |
| :----             | :----     | :----     | :----     | :----     | :----     |
| user_id           | bigint    |           |           |           | 会员ID     |
| count             | int       |           |           | 0         | 次数       |
| created_at        | timestamp |           | Y         | NULL      | 创建时间    |
| updated_at        | timestamp |           | Y         | NULL      | 更新时间    |
