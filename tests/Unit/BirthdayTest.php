<?php
/**
 * Created by AlicFeng at 2019-05-30 18:53
 */

namespace Tests\Unit;


use AlicFeng\IdentityCard\Birthday;
use PHPUnit\Framework\TestCase;

class BirthdayTest extends TestCase
{
    const BIRTHDAY = '1995-06-02';

    public function testAge()
    {
        $birthday = strtotime(self::BIRTHDAY);
        $this->assertEquals(Birthday::age($birthday, strtotime('2019-06-01')), 23);
    }

    public function testStar()
    {
        $this->assertEquals(Birthday::star(self::BIRTHDAY), '双子座');
    }
}
