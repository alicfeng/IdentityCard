<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

use AlicFeng\IdentityCard\Data\Area as Data;
use AlicFeng\IdentityCard\Exception\CertificateException;

/**
 * 中国行政地区码表.
 *
 * @description 使用身份证获取省、市、区行政地区中文名称
 * Class Area
 * @deprecated
 * @Author      AlicFeng
 * @datetime    2019-06-25
 * @website https://www.samego.com
 * @github  https://github.com/alicfeng
 * @email   a@samego.com
 */
trait Area
{
    /**
     * @function 根据身份证号码获取省份中文名称
     * @description  根据身份证号码获取省份中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 省中文名称认值
     * @return string 省中文名称
     * @throws CertificateException
     * @deprecated   please use InfoHelper::identity()->province instead
     */
    public static function province(string $id, $default = '')
    {
        return self::common(2, $id, $default);
    }

    /**
     * @function 根据身份证号码获取市份中文名称
     * @description  根据身份证号码获取市份中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 市中文名称认值
     * @return string 市中文名称
     * @throws CertificateException
     * @deprecated   please use InfoHelper::identity()->city instead
     */
    public static function city(string $id, $default = '')
    {
        return self::common(4, $id, $default);
    }

    /**
     * @function 根据身份证号码获取区中文名称
     * @description  根据身份证号码获取区中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 区中文名称认值
     * @return string 区中文名称
     * @throws CertificateException
     * @deprecated   please use InfoHelper::identity()->area instead
     */
    public static function area(string $id, $default = '')
    {
        return self::common(6, $id, $default);
    }

    /**
     * @function 根据身份证号码获取行政地区中文名称
     * @description  根据身份证号码获取行政地区中文名称，支持给定默认值
     * @param int    $intelligence 截取身份证号码位数
     * @param string $id           身份证
     * @param string $default      编码对应行政地区中文名称
     * @return string 行政地区中文名称
     * @throws CertificateException
     * @deprecated
     */
    private static function common(int $intelligence, string $id, $default = '')
    {
        if (false === IdentityCard::validate($id)) {
            throw new CertificateException();
        }

        $code = substr(substr($id, 0, $intelligence) . '0000', 0, 6);

        return Data::DATA[$code] ?? $default;
    }

    /**
     * @function 获取中国所有行政地区中码表集合
     * @description  获取中国所有行政地区中码表集合
     * @return array
     * @deprecated   please use InfoHelper::identity()->all instead
     */
    public static function all()
    {
        return Data::DATA;
    }
}
