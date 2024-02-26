<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace Tests\Unit;

use AlicFeng\IdentityCard\Exception\CertificateException;
use AlicFeng\IdentityCard\Information;
use Tests\TestCase;

class IdentityCardTest extends TestCase
{
    public function testGetBirthday(): void
    {
        $expect = '1995-06-02';

        try {
            $this->assertEquals($expect, Information::identityCard()->birthday(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetSex(): void
    {
        $expect = 'M';

        try {
            $this->assertEquals($expect, Information::identityCard()->sex(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetAge(): void
    {
        $expect = 28;

        try {
            $this->assertEquals($expect, Information::identityCard()->age(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetConstellation(): void
    {
        $expect = '猪';

        try {
            $this->assertEquals($expect, Information::identityCard()->constellation(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testGetStar(): void
    {
        $expect = '双子座';

        try {
            $this->assertEquals($expect, Information::identityCard()->star(self::ID));
        } catch (CertificateException $e) {
        }
    }

    public function testCreateIdCardImage(): void
    {
        $frontImage = Information::identityCard()->createFrontImage(
            '冯大叔',
            '男',
            '汉',
            1560089097,
            '广东省阳江市海陵镇试验区某某村委会某某村888号',
            '441701199506028888'
        );
        imagepng($frontImage, 'front.png');
        imagedestroy($frontImage);

        $backImage = Information::identityCard()->createBackImage(
            '2016.06.02',
            '2026.12.08'
        );
        imagepng($backImage, 'back.png');
        imagedestroy($backImage);

        $this->assertFileExists(__DIR__ . '/../../' . 'front.png');
        $this->assertFileExists(__DIR__ . '/../../' . 'back.png');
    }
}
