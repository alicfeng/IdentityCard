<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard\Traits;

trait Star
{
    /**
     * @function 根据月份以及日计算星座
     * @param int $month 月
     * @param int $day   日
     * @return bool|string
     */
    public function query($month, $day)
    {
        if ((1 == $month && $day >= 20) || (2 == $month && $day <= 18)) {
            return '水瓶座';
        } elseif ((2 == $month && $day >= 19) || (3 == $month && $day <= 20)) {
            return '双鱼座';
        } elseif ((3 == $month && $day >= 21) || (4 == $month && $day <= 19)) {
            return '白羊座';
        } elseif ((4 == $month && $day >= 20) || (5 == $month && $day <= 20)) {
            return '金牛座';
        } elseif ((5 == $month && $day >= 21) || (6 == $month && $day <= 21)) {
            return '双子座';
        } elseif ((6 == $month && $day >= 22) || (7 == $month && $day <= 22)) {
            return '巨蟹座';
        } elseif ((7 == $month && $day >= 23) || (8 == $month && $day <= 22)) {
            return '狮子座';
        } elseif ((8 == $month && $day >= 23) || (9 == $month && $day <= 22)) {
            return '处女座';
        } elseif ((9 == $month && $day >= 23) || (10 == $month && $day <= 23)) {
            return '天秤座';
        } elseif ((10 == $month && $day >= 24) || (11 == $month && $day <= 22)) {
            return '天蝎座';
        } elseif ((11 == $month && $day >= 23) || (12 == $month && $day <= 21)) {
            return '射手座';
        } elseif ((12 == $month && $day >= 22) || (1 == $month && $day <= 19)) {
            return '魔羯座';
        }

        return false;
    }
}
