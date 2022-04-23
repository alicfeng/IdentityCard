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

class AreaTest extends TestCase
{
    public function testProvince(): void
    {
        try {
            $expect   = '广东省';
            $province = Information::identityCard()->province(self::ID);
            $this->assertEquals($expect, $province);
        } catch (CertificateException $e) {
        }
    }

    public function testCity(): void
    {
        try {
            $expect = '阳江市';
            $city   = Information::identityCard()->city(self::ID);
            $this->assertEquals($expect, $city);
        } catch (CertificateException $e) {
        }
    }

    public function testArea(): void
    {
        try {
            $expect = '海陵岛';
            $area   = Information::identityCard()->area(self::ID, $expect);
            $this->assertEquals($expect, $area);
        } catch (CertificateException $e) {
        }
    }
}
