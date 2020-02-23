<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace Tests\Unit;

use AlicFeng\IdentityCard\Exception\CertificateException;
use AlicFeng\IdentityCard\InfoHelper as Helper;
use Tests\TestCase;

class IdentityCardTest extends TestCase
{
    public function testGetBirthday()
    {
        $expect = '1995-06-02';

        try {
            $this->assertEquals($expect, Helper::identityCard()->birthday(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetSex()
    {
        $expect = 'M';

        try {
            $this->assertEquals($expect, Helper::identityCard()->sex(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetAge()
    {
        $expect = 24;

        try {
            $this->assertEquals($expect, Helper::identityCard()->age(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetConstellation()
    {
        $expect = '猪';

        try {
            $this->assertEquals($expect, Helper::identityCard()->constellation(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function ttestGetStar()
    {
        $expect = '双子座';

        try {
            $this->assertEquals($expect, Helper::identityCard()->star(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testCreateIdCardImage()
    {
        $frontImage = Helper::identityCard()->createFrontImage(
            '冯大叔',
            '男',
            '汉',
            1560089097,
            '广东省阳江市海陵镇试验区某某村委会某某村888号',
            '441701199506028888'
        );
        imagepng($frontImage, 'front.png');
        imagedestroy($frontImage);

        $backImage = Helper::identityCard()->createBackImage(
            '2016.06.02',
            '2026.12.08'
        );
        imagepng($backImage, 'back.png');
        imagedestroy($backImage);

        $this->assertFileExists(__DIR__ . '/../../' . 'front.png');
        $this->assertFileExists(__DIR__ . '/../../' . 'back.png');
    }
}
