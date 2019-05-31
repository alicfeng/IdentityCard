<?php
/**
 * Created by AlicFeng at 2019-05-30 18:43
 */

namespace AlicFeng\IdentityCard;


use AlicFeng\IdentityCard\Exception\BirthdayException;

/**
 * 出生年月日工具类
 * @description 使用出生年月日计算年龄、星座
 * Class Birthday
 * @package AlicFeng\Birthday
 * @Author AlicFeng
 * @datetime 2019-05-31
 * @website https://www.samego.com
 * @email a@samego.com
 */
class Birthday
{
    /**
     * @functionName 通过生日获取年龄
     * @param int $birthday 生日日期时间戳
     * @param mixed $current 参考日期时间戳
     * @return mixed 年龄
     */
    public static function age($birthday, $current = false)
    {
        if (false === $current) {
            $current = time();
        }
        list($birthdayYear, $birthdayMonth, $birthdayDay) = explode('-', date('Y-m-d', $birthday));
        list($currentYear, $currentMonth, $currentDay) = explode('-', date('Y-m-d', $current));

        //开始计算年龄
        $age = $currentYear - $birthdayYear;
        if ($birthdayMonth > $currentMonth || $birthdayMonth == $currentMonth && $birthdayDay > $currentDay) {
            $age--;
        }
        return $age;
    }

    /**
     * 根据生日计算星座
     * @param int $birthday 出生年月日
     * @return bool|string
     * @throws BirthdayException
     */
    public static function star($birthday)
    {
        try {
            list($year, $month, $day) = explode('-', date('Y-m-d', $birthday));
            return Star::query($month, $day);
        } catch (\Exception $exception) {
            throw new BirthdayException('birthday value error');
        }
    }
}
