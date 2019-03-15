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
    const ID = '44170119906020016';
    public function testGetBirthday()
    {
        $expect = '199-06-02';
        try {
            $this->assertEquals($expect, IdentityCard::birthday(self::ID));
        }
        catch (CertificateException $e) {

        }
    }

    public function testGetSex()
    {
        $expect = 'M';
        try {
            $this->assertEquals($expect, IdentityCard::sex(self::ID));
        }
        catch (CertificateException $e) {
        }
    }

    public function testGetAge()
    {
        $expect = 23;
        try {
            $this->assertEquals($expect, IdentityCard::age(self::ID));
        }
        catch (CertificateException $e) {
        }
    }

    public function testGetConstellation()
    {
        $expect = '猪';
        try {
            $this->assertEquals($expect, IdentityCard::constellation(self::ID));
        }
        catch (CertificateException $e) {
        }
    }

    public function testGetStar()
    {
        $expect = '双子座';
        try {
            $this->assertEquals($expect, IdentityCard::star(self::ID));
        }
        catch (CertificateException $e) {
        }
    }
}