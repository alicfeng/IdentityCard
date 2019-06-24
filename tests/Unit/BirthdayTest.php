<?php
/**
 * Created by AlicFeng at 2019-05-30 18:53
 */

namespace Tests\Unit;


use AlicFeng\IdentityCard\Birthday;
use AlicFeng\IdentityCard\Exception\BirthdayException;
use Tests\BaseTestCase;

class BirthdayTest extends BaseTestCase
{
    const BIRTHDAY = '1995-06-02';

    public function testAge()
    {
        $birthday = strtotime(self::BIRTHDAY);
        $this->assertEquals(Birthday::age($birthday, strtotime('2019-06-01')), 23);
    }

    public function testStar()
    {
        try {
            $this->assertEquals(Birthday::star(strtotime(self::BIRTHDAY)), '双子座');
        } catch (BirthdayException $e) {
        }
    }
}
