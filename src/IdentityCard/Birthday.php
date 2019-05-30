<?php
/**
 * Created by AlicFeng at 2019-05-30 18:43
 */

namespace AlicFeng\IdentityCard;


class Birthday
{
    /**
     * @functionName 通过生日获取年龄
     * @param int $birthday 生日日期时间戳
     * @param bool $current 参考日期时间戳
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
     * @param string $birthday 生日 | 默认的格式yyy-mm-dd
     * @param string $delimiter 生日字符串分隔符 | 默认为-
     * @return bool|string
     */
    public static function star($birthday, $delimiter = '-')
    {
        list($year, $month, $day) = explode($delimiter, $birthday);
        return Star::query($month, $day);
    }
}
