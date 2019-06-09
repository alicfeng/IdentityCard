<?php
/**
 * Created by AlicFeng at 2019/1/26 上午12:06
 */


namespace Tests\Unit;


use AlicFeng\IdentityCard\Exception\CertificateException;
use AlicFeng\IdentityCard\IdentityCard;

use PHPUnit\Framework\TestCase;

class IdentityCardTest extends TestCase
{
    const ID = '441701199506020016';

    public function testGetBirthday()
    {
        $expect = '1995-06-02';
        try {
            $this->assertEquals($expect, IdentityCard::birthday(self::ID));
        } catch (CertificateException $e) {

        }
    }

    public function testGetSex()
    {
        $expect = 'M';
        try {
            $this->assertEquals($expect, IdentityCard::sex(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetAge()
    {
        $expect = 24;
        try {
            $this->assertEquals($expect, IdentityCard::age(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetConstellation()
    {
        $expect = '猪';
        try {
            $this->assertEquals($expect, IdentityCard::constellation(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetStar()
    {
        $expect = '双子座';
        try {
            $this->assertEquals($expect, IdentityCard::star(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testCreateIdCardImage()
    {
        $frontImage = IdentityCard::createFrontImage('冯大叔', '男', '汉', 1560089097, '广东省阳江市海陵镇试验区某某村委会某某村888号', '441701199506028888');
        imagepng($frontImage, 'front.png');
        imagedestroy($frontImage);

        $backImage = IdentityCard::createBackImage('2016.06.02', '2026.12.08');
        imagepng($backImage, 'back.png');
        imagedestroy($backImage);

        $this->assertFileExists('front.png');
        $this->assertFileExists('back.png');
    }
}
