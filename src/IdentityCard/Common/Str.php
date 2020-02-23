<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard\Common;

/**
 * Class Str.
 * @deprecated
 * @author  AlicFeng
 */
class Str
{
    public static function mb_str_split($string): array
    {
        if (is_string($string)) {
            return preg_split('/(?<!^)(?!$)/u', $string);
        }

        return [];
    }
}
