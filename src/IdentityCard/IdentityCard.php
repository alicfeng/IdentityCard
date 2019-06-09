<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

use AlicFeng\IdentityCard\Common\Str;
use AlicFeng\IdentityCard\Data\Constellation;
use AlicFeng\IdentityCard\Exception\CertificateException;

/**
 * 中国（大陆）公民身份证工具类.
 *
 * @description 使用身份证计算年龄、生日、星座、性别、生肖
 * Class IdentityCard
 *
 * @version     2.x 添加了异常捕获机制，针对证件ID捕获证件异常
 * @version     2.3 增加身份证正反面图片生成
 * @Author      AlicFeng
 * @datetime    2019-03-15
 * @website https://www.samego.com
 * @email a@samego.com
 */
class IdentityCard
{
    /*男:M 女:F*/
    const SIGN_MALE   = 'M';
    const SIGN_FEMALE = 'F';

    /**
     * @functionName   获取性别
     * @description    男为M | 女为F case 15 最后一位奇男偶女 case 18 倒数第二位奇男偶女
     *
     * @param string $id 身份证号码
     *
     * @return string
     *
     * @throws CertificateException
     */
    public static function sex($id)
    {
        if (false === self::validate($id)) {
            throw new CertificateException('certificate format error');
        }
        $signPick = intval(substr($id, (15 === strlen($id) ? -1 : -2), 1));

        return 0 === ($signPick & 1) ? self::SIGN_FEMALE : self::SIGN_MALE;
    }

    /**
     * @functionName   获取出生年月日
     * @description    格式为 yyyy-mm-dd
     *
     * @param string $id 身份证号码
     *
     * @return string
     *
     * @throws CertificateException
     */
    public static function birthday($id)
    {
        if (false === self::validate($id)) {
            throw new CertificateException('certificate format error');
        }
        $bir   = substr($id, 6, 8);
        $year  = substr($bir, 0, 4);
        $month = substr($bir, 4, 2);
        $day   = substr($bir, 6, 2);

        return $year.'-'.$month.'-'.$day;
    }

    /**
     * @functionName   根据身份证号码计算年龄
     * @description    根据身份证号码计算年龄
     *
     * @param string $id 身份证号码
     *
     * @return int
     *
     * @throws CertificateException
     */
    public static function age($id)
    {
        if (false === self::validate($id)) {
            throw new CertificateException('certificate format error');
        }
        $ageTime = strtotime(substr($id, 6, 8));
        if (false === $ageTime) {
            throw new CertificateException('certificate format error');
        }
        list($aYear, $aMonth, $aDay) = explode('-', date('Y-m-d', $ageTime));

        $currentTime                 = time();
        list($cYear, $cMonth, $cDay) = explode('-', date('Y-m-d', $currentTime));
        $age                         = $cYear - $aYear;
        if ((int) ($cMonth.$cDay) < (int) ($aMonth.$aDay)) {
            --$age;
        }

        unset($aYear, $aMonth, $aDay, $cYear, $cMonth, $cDay, $ageTime, $currentTime);

        return $age;
    }

    /**
     * @functionName   获取生肖
     * @description    返回生肖的中文名称
     *
     * @param string $id 身份证号码
     *
     * @return string
     *
     * @throws CertificateException
     */
    public static function constellation($id)
    {
        if (false === self::validate($id)) {
            throw new CertificateException('certificate format error');
        }
        $year = substr($id, 6, 4);

        return Constellation::DATA[($year - 4) % 12];
    }

    /**
     * @functionName   获取星座
     * @description    返回星座的中文名称
     *
     * @param string $id 身份证号码
     *
     * @return bool|string
     *
     * @throws CertificateException
     */
    public static function star($id)
    {
        if (false === self::validate($id)) {
            throw new CertificateException('certificate format error');
        }
        $month = (int) substr($id, 10, 2);
        $day   = (int) substr($id, 12, 2);

        return Star::query($month, $day);
    }

    /**
     * @functionName   校验身份证证件的正确性
     * @description    校验身份证证件的正确性
     *
     * @param string $id 身份证号码
     *
     * @return bool
     */
    public static function validate($id)
    {
        if (18 == strlen($id)) {
            return self::check18IDCard($id);
        } elseif (15 == strlen($id)) {
            $id = self::convert15to18($id);

            return self::check18IDCard($id);
        }

        return false;
    }

    /**
     * @functionName 计算身份证的最后一位验证码
     * @description  根据国家标准GB 11643-1999，前提必须是18位的证件号
     *
     * @param string $idBody 证件号码的前17位数字
     *
     * @return bool|mixed
     */
    public static function calculateCode($idBody)
    {
        if (17 != strlen($idBody)) {
            return false;
        }

        //加权因子
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        //校验码对应值
        $code     = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $checksum = 0;

        foreach (range(0, strlen($idBody) - 1) as $index => $item) {
            $checksum += substr($idBody, $index, 1) * $factor[$index];
        }

        return $code[$checksum % 11];
    }

    /**
     * @functionName  将15位身份证升级到18位
     *
     * @param string $id 身份证号码
     *
     * @return bool|string
     */
    public static function convert15to18($id)
    {
        if (15 != strlen($id)) {
            return false;
        }
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (false !== array_search(substr($id, 12, 3), ['996', '997', '998', '999'])) {
            $idBody = substr($id, 0, 6).'18'.substr($id, 6, 9);
        } else {
            $idBody = substr($id, 0, 6).'19'.substr($id, 6, 9);
        }

        return $idBody.self::calculateCode($idBody);
    }

    /**
     * @functionName 校验18位身份证的有效性
     *
     * @param string $id 身份证号码
     *
     * @return bool
     */
    private static function check18IDCard($id)
    {
        if (18 != strlen($id)) {
            return false;
        }

        $idBody = substr($id, 0, 17);
        $code   = strtoupper(substr($id, 17, 1));

        if (self::calculateCode($idBody) == $code) {
            return true;
        }

        return false;
    }

    /**
     * @functionName 生成身份证正面图片
     *
     * @param string $name        姓名
     * @param string $gender      性别
     * @param string $nation      名族
     * @param int    $birthday    生日 | 时间戳
     * @param string $address     地址
     * @param string $idCard      证件号
     * @param string $bgImagePath 背景图片 | 865 * 540px
     *
     * @return resource 图片资源句柄
     */
    public static function createFrontImage($name, $gender, $nation, $birthday, $address, $idCard, $bgImagePath = __DIR__.DIRECTORY_SEPARATOR.'Source'.DIRECTORY_SEPARATOR.'front_pure.jpg')
    {
        list($fontSize, $angle)   = [22, 0];
        list($year, $month, $day) = explode('-', date('Y-m-d'), $birthday);
        $fontFile                 = __DIR__.DIRECTORY_SEPARATOR.'Source'.DIRECTORY_SEPARATOR.'font'.DIRECTORY_SEPARATOR.'Hiragino Sans GB.ttc';

        $image      = imagecreatefromjpeg($bgImagePath);
        $blackColor = imagecolorallocate($image, 43, 43, 43);

        imagettftext($image, $fontSize, $angle, 170, 120, $blackColor, $fontFile, $name);
        imagettftext($image, $fontSize, $angle, 157, 183, $blackColor, $fontFile, $gender);
        imagettftext($image, $fontSize, $angle, 340, 183, $blackColor, $fontFile, $nation);
        imagettftext($image, $fontSize, $angle, 165, 245, $blackColor, $fontFile, $year);
        imagettftext($image, $fontSize, $angle, 300, 245, $blackColor, $fontFile, $month);
        imagettftext($image, $fontSize, $angle, 390, 245, $blackColor, $fontFile, $day);
        imagettftext($image, $fontSize, $angle, 320, 475, $blackColor, $fontFile, $idCard);
        $addressData    = Str::mb_str_split($address);
        $addressLength  = count($addressData);
        $addressOneLine = implode('', array_slice($addressData, 0, $addressLength > 13 ? 13 : $addressLength));
        imagettftext($image, $fontSize, $angle, 160, 310, $blackColor, $fontFile, $addressOneLine);
        if ($addressLength > 13) {
            $addressTwoLine = implode('', array_slice($addressData, 13, $addressLength - 13));
            imagettftext($image, $fontSize, $angle, 160, 347, $blackColor, $fontFile, $addressTwoLine);
        }

        return $image;
    }

    /**
     * @functionName 生成图片反面图片
     *
     * @param string $startDate   有效起期 | yyyy.mm.dd
     * @param string $endDate     有效止期 | yyyy.mm.dd
     * @param string $sign        签发机关
     * @param string $bgImagePath 背景图片 | 865 * 540px
     *
     * @return resource 图片资源句柄
     */
    public static function createBackImage($startDate, $endDate = '长期', $sign = 'Samego Team Created', $bgImagePath = __DIR__.DIRECTORY_SEPARATOR.'Source'.DIRECTORY_SEPARATOR.'back_pure.jpg')
    {
        list($fontSize, $angle) = [18, 0];

        $fontFile = __DIR__.DIRECTORY_SEPARATOR.'Source'.DIRECTORY_SEPARATOR.'font'.DIRECTORY_SEPARATOR.'Hiragino Sans GB.ttc';

        $image      = imagecreatefromjpeg($bgImagePath);
        $blackColor = imagecolorallocate($image, 43, 43, 43);

        $dateInfo = $startDate.'-'.$endDate;

        imagettftext($image, $fontSize, $angle, 350, 410, $blackColor, $fontFile, $sign);
        imagettftext($image, $fontSize, $angle, 350, 475, $blackColor, $fontFile, $dateInfo);

        return $image;
    }
}
