<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace Tests\Unit;

use AlicFeng\IdentityCard\Exception\BirthdayException;
use AlicFeng\IdentityCard\Information;
use Tests\TestCase;

class BirthdayTest extends TestCase
{
    public const BIRTHDAY = '1995-06-02';

    public function testAge(): void
    {
        $birthday = strtotime(self::BIRTHDAY);
        $this->assertEquals(Information::birthday()->age($birthday, strtotime('2019-06-01')), 23);
    }

    public function testStar(): void
    {
        try {
            $this->assertEquals(Information::birthday()->star(strtotime(self::BIRTHDAY)), '双子座');
        } catch (BirthdayException $e) {
        }
    }
}
