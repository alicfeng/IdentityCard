<?php
/**
 * Created by AlicFeng at 2019-06-25 00:37
 */

namespace Tests\Unit;


use AlicFeng\IdentityCard\Area;
use AlicFeng\IdentityCard\Exception\CertificateException;
use AlicFeng\IdentityCard\IdentityCard;
use Tests\BaseTestCase;

class AreaTest extends BaseTestCase
{
    public function testProvince()
    {
        try {
            $expect   = '广东省';
            $province = IdentityCard::province(self::ID);
            $this->assertEquals($expect, $province);
        } catch (CertificateException $e) {

        }
    }

    public function testCity()
    {
        try {
            $expect = '阳江市';
            $city   = IdentityCard::city(self::ID);
            $this->assertEquals($expect, $city);
        } catch (CertificateException $e) {

        }
    }

    public function testArea()
    {
        try {
            $expect = '海陵岛';
            $area   = IdentityCard::area(self::ID, $expect);
            $this->assertEquals($expect, $area);
        } catch (CertificateException $e) {

        }
    }
}
