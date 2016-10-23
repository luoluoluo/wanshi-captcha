## 简单的php图片验证码

### 安装

1.composer.json 增加：

```
"repositories": [
    {
        "type": "git",
        "url": "https://github.com/luoluoluo/wanshi-captcha.git"
    }
],

"require": {
    "wanshi-captcha": "dev-master"
}
```

2.config/app.php 增加（laravel）：

```
Wanshi\Captcha\CaptchaServiceProvider::class,
```

3.使用

```
list($code, $file) = app('captcha')->create();

```
