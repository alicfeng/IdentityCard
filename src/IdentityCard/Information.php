<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

use AlicFeng\IdentityCard\Application\Birthday;
use AlicFeng\IdentityCard\Application\IdentityCard;

/**
 * Class InfoHelper.
 *
 * @method static IdentityCard      identityCard()
 * @method static Birthday          birthday()
 */
class Information
{
    private function __construct()
    {
    }

    /**
     * @description make application container(obj)
     * @param string $name
     * @return IdentityCard | Birthday
     * @author      AlicFeng
     */
    public static function make(string $name)
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
    public static function __callStatic(string $name, array $arguments = [])
    {
        return self::make($name);
    }
}
