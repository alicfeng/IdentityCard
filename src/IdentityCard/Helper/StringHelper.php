<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard\Helper;

class StringHelper
{
    /**
     * @function    字符串分割
     * @description mb_str_split
     * @param string $pattern
     * @author      AlicFeng
     */
    public static function mb_str_split(string $content, $pattern = '/(?<!^)(?!$)/u'): array
    {
        if (is_string($content)) {
            return preg_split($pattern, $content);
        }

        return [];
    }
}
