<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
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
     * @param string $content 源内容
     * @param string $pattern 分隔符
     * @author      AlicFeng
     */
    public static function mb_str_split(string $content, string $pattern = '/(?<!^)(?!$)/u'): array
    {
        if (is_string($content)) {
            return preg_split($pattern, $content);
        }

        return [];
    }
}
