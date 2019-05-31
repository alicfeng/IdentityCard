<?php
/**
 * Created by AlicFeng at 2019-05-30 18:46
 */

namespace AlicFeng\IdentityCard;


class Star
{
    /**
     * @functionName 根据月份以及日计算星座
     * @param int $month 月
     * @param int $day 日
     * @return bool|string
     */
    public static function query($month, $day)
    {
        if (($month == 1 && $day <= 20) || ($month == 2 && $day <= 18)) {
            return '水瓶座';
        } else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
            return '双鱼座';
        } else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
            return '白羊座';
        } else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
            return '金牛座';
        } else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
            return '双子座';
        } else if (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
            return '巨蟹座';
        } else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
            return '狮子座';
        } else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
            return '处女座';
        } else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
            return '天秤座';
        } else if (($month == 10 && $day >= 24) || ($month == 11 && $day <= 22)) {
            return '天蝎座';
        } else if (($month == 11 && $day >= 23) || ($month == 12 && $day <= 21)) {
            return '射手座';
        } else if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
            return '魔羯座';
        }
        return false;
    }
}
