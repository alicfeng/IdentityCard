<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace Tests\Unit;

use AlicFeng\IdentityCard\Exception\BirthdayException;
use AlicFeng\IdentityCard\InfoHelper as Helper;
use Tests\TestCase;

class BirthdayTest extends TestCase
{
    const BIRTHDAY = '1995-06-02';

    public function testAge()
    {
        $birthday = strtotime(self::BIRTHDAY);
        $this->assertEquals(Helper::birthday()->age($birthday, strtotime('2019-06-01')), 23);
    }

    public function testStar()
    {
        try {
            $this->assertEquals(Helper::birthday()->star(strtotime(self::BIRTHDAY)), '双子座');
        } catch (BirthdayException $e) {
        }
    }
}
