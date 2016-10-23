<?php
namespace Wanshi\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->singleton('captcha', function () {
            return new Captcha();
        });
    }
}
