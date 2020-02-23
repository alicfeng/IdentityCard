<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard\Traits;

use AlicFeng\IdentityCard\Application\IdentityCard;
use AlicFeng\IdentityCard\Data\Area as Data;
use AlicFeng\IdentityCard\Exception\CertificateException;

/**
 * 中国行政地区码表.
 *
 * @description 使用身份证获取省、市、区行政地区中文名称
 * Class Area
 * @Author      AlicFeng
 * @datetime    2019-06-25
 * @website https://www.samego.com
 * @github  https://github.com/alicfeng
 * @email   a@samego.com
 */
trait Area
{
    /**
     * @function     根据身份证号码获取省份中文名称
     * @description  根据身份证号码获取省份中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 省中文名称认值
     * @return string 省中文名称
     * @throws CertificateException
     */
    public function province(string $id, $default = '')
    {
        return self::common(2, $id, $default);
    }

    /**
     * @function     根据身份证号码获取市份中文名称
     * @description  根据身份证号码获取市份中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 市中文名称认值
     * @return string 市中文名称
     * @throws CertificateException
     */
    public function city(string $id, $default = '')
    {
        return self::common(4, $id, $default);
    }

    /**
     * @function     根据身份证号码获取区中文名称
     * @description  根据身份证号码获取区中文名称，支持给定默认值
     * @param string $id      身份证
     * @param string $default 区中文名称认值
     * @return string 区中文名称
     * @throws CertificateException
     */
    public function area(string $id, $default = '')
    {
        return self::common(6, $id, $default);
    }

    /**
     * @function     根据身份证号码获取行政地区中文名称
     * @description  根据身份证号码获取行政地区中文名称，支持给定默认值
     * @param int    $intelligence 截取身份证号码位数
     * @param string $id           身份证
     * @param string $default      编码对应行政地区中文名称
     * @return string 行政地区中文名称
     * @throws CertificateException
     */
    private static function common(int $intelligence, string $id, $default = '')
    {
        $identityCard = new IdentityCard();
        if (false === $identityCard->validate($id)) {
            throw new CertificateException();
        }

        $code = substr(substr($id, 0, $intelligence) . '0000', 0, 6);

        return Data::DATA[$code] ?? $default;
    }
}
