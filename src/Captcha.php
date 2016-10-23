<?php
/**
 *  图片验证码
 */
namespace Wanshi\Captcha;
class Captcha{
    public function __construct(){
    }

    public function create($num=4, $size=20){

        $width  = $size*$num + 20;
        $height = $size + 20;
        $image  = imagecreatetruecolor($width, $height);
        $bgcolor= imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgcolor);//区域填充
        //code
        $code   = '';
        $chars  = 'abcdefghjkmnopqrstuvwxyABCDEFGHJKMNPQRSTUVWXYZ';
        $x      = 10;
        $y      = $size + 10;//y坐标
        for($i=0; $i<$num; $i++){
            //字体
            $font           = $this->font();
            $color          = imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));//0,120是代表随机的深色颜色
            $content        = substr($chars, rand(0, strlen($chars)-1), 1);//随机英文内容
            $code           .= $content;
            $anger          = rand(-20, 20);
            ImageTTFText($image, $size, $anger, $x, $y, $color, $font, $content);
            $x              += $size;//x坐标
        }

        //点
        for($i=0; $i<$width*$height/20; $i++){
            $color = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));//50,200是代表随机的浅色颜色
            imagesetpixel($image, rand(1, $width), rand(1, $height), $color);
        }

        //线
        for($i=0; $i<4; $i++){
            $color  = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));//80,220是代表随机的更浅色颜色
            imageline($image, rand(1, $width), rand(1, $height), rand(1, $width), rand(1, $height), $color);
        }
        $file = tempnam(sys_get_temp_dir(), 'captcha');;
        imagepng($image, $file);//输出图片

        imagedestroy($image);//释放资源
        $file = file_get_contents($file);
        return [$code, $file];
    }

    private function font(){
        $dir        = __DIR__ . '/../asset/font/';
        $handler    = opendir($dir);
        $files      = [];
        while (($filename = readdir($handler)) !== false) {
            if ($filename != "." && $filename != "..") {
                  $files[] = $filename ;
            }
        }
        closedir($handler);
        return $dir . $files[rand(0, count($files) - 1)];
    }
}
