<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

/**
 * Class InfoHelper.
 *
 * @method static \AlicFeng\IdentityCard\Application\IdentityCard      identityCard()
 * @method static \AlicFeng\IdentityCard\Application\Birthday          birthday()
 */
class InfoHelper
{
    /**
     * @description make application container(obj)
     * @param $name
     * @return mixed
     * @author      AlicFeng
     */
    public static function make($name)
    {
        $namespace   = ucfirst($name);
        $application = "\\AlicFeng\\IdentityCard\\Application\\{$namespace}";

        return new $application();
    }

    /**
     * @description dynamically pass methods to the application
     * @param string $name
     * @param array  $arguments
     * @return mixed
     * @author      AlicFeng
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name);
    }
}
