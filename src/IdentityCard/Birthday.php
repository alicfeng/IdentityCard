<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

use AlicFeng\IdentityCard\Exception\BirthdayException;
use Exception;

/**
 * 出生年月日工具类.
 *
 * @description 使用出生年月日计算年龄、星座
 * Class Birthday
 * @deprecated
 * @Author      AlicFeng
 * @datetime    2019-05-31
 * @website https://www.samego.com
 * @github  https://github.com/alicfeng
 * @email   a@samego.com
 */
class Birthday
{
    /**
     * @funtction  通过生日获取年龄
     * @param int   $birthday 生日日期时间戳
     * @param mixed $current  参考日期时间戳
     * @return mixed 年龄
     * @deprecated please use InfoHelper::birthday()->age instead
     */
    public static function age($birthday, $current = false)
    {
        if (false === $current) {
            $current = time();
        }
        list($birthdayYear, $birthdayMonth, $birthdayDay) = explode('-', date('Y-m-d', $birthday));
        list($currentYear, $currentMonth, $currentDay)    = explode('-', date('Y-m-d', $current));

        //开始计算年龄
        $age = $currentYear - $birthdayYear;
        if ($birthdayMonth > $currentMonth || $birthdayMonth == $currentMonth && $birthdayDay > $currentDay) {
            --$age;
        }

        return $age;
    }

    /**
     * @function   根据生日计算星座.
     * @param int $birthday 出生年月日
     * @return bool|string
     * @throws BirthdayException
     * @deprecated please use InfoHelper::birthday()->star instead
     */
    public static function star($birthday)
    {
        try {
            list(, $month, $day) = explode('-', date('Y-m-d', $birthday));

            return Star::query($month, $day);
        } catch (Exception $exception) {
            throw new BirthdayException('birthday value error');
        }
    }
}
