<?php

namespace Mrzxkt\Captcha;

class Captcha
{
    public $letters = '23456789ABCDEGHKMNPQSUVXYZabcdeghkmnpqsuvxyz';

    public $fonts = [
        0 => [
            'name' => '0.ttf',
            'size' => 40,
            'y' => 50,
        ],
        1 => [
            'name' => '1.ttf',
            'size' => 60,
            'y' => 70,
        ],
    ];

    public function generateCode($len = 6)
    {
        return substr(str_shuffle(str_repeat($this->letters, 3)), 0, $len);
    }

    public function generateImage($string)
    {
        $image = imagecreatetruecolor(strlen($string) * 50 + 20, 80);
        imagesavealpha($image, true);
        imagefill($image, 0, 0, imagecolorallocatealpha($image, rand(0, 255), rand(0, 255), rand(0, 255), rand(100, 120)));
        $color = imagecolorallocate($image, 0, 0, 0);
        $font = $this->fonts[array_rand($this->fonts, 1)];
        imagettftext($image, $font['size'], rand(-3, 3), 15, $font['y'], $color, dirname(__DIR__).DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.$font['name'], $string);
        header('Content-Type: image/jpeg');
        imagepng($image);
        imagedestroy($image);
    }
}
