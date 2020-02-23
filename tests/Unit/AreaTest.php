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

class AreaTest extends TestCase
{
    public function testProvince()
    {
        try {
            $expect   = '广东省';
            $province = Helper::identityCard()->province(self::ID);
            $this->assertEquals($expect, $province);
        } catch (CertificateException $e) {
        }
    }

    public function testCity()
    {
        try {
            $expect = '阳江市';
            $city   = Helper::identityCard()->city(self::ID);
            $this->assertEquals($expect, $city);
        } catch (CertificateException $e) {
        }
    }

    public function testArea()
    {
        try {
            $expect = '海陵岛';
            $area   = Helper::identityCard()->area(self::ID, $expect);
            $this->assertEquals($expect, $area);
        } catch (CertificateException $e) {
        }
    }
}
