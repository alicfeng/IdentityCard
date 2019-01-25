<?php
/**
 * Created by AlicFeng at 2019/1/26 上午12:06
 */


namespace Tests\Unit;


use AlicFeng\IdentityCard\IdentityCard;

use PHPUnit\Framework\TestCase;

class IdentityCardTest extends TestCase
{
    const ID = '441701199506020016';
    public function testGetBirthday()
    {
        $expect = '1995-06-02';
        $this->assertEquals($expect, IdentityCard::birthday(self::ID));
    }

    public function testGetSex()
    {
        $expect = 'M';
        $this->assertEquals($expect, IdentityCard::sex(self::ID));
    }

    public function testGetAge()
    {
        $expect = 23;
        $this->assertEquals($expect, IdentityCard::age(self::ID));
    }

    public function testGetConstellation()
    {
        $expect = '猪';
        $this->assertEquals($expect, IdentityCard::constellation(self::ID));
    }

    public function testGetStar()
    {
        $expect = '双子座';
        $this->assertEquals($expect, IdentityCard::star(self::ID));
    }
}