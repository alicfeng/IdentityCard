<?php

declare(strict_types=1);

/*
 * What Samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/IdentityCard
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\IdentityCard;

use AlicFeng\IdentityCard\Data\Constellation;
use AlicFeng\IdentityCard\Exception\CertificateException;
use AlicFeng\IdentityCard\Helper\StringHelper;

/**
 * 中国（大陆）公民身份证工具类.
 *
 * @description 使用身份证计算年龄、生日、星座、性别、生肖、政区划代码，同时绘制身份证正反面
 * Class IdentityCard
 *
 * @deprecated  please use InfoHelper::identity()->function instead
 * @version     2.x 添加了异常捕获机制，针对证件ID捕获证件异常
 * @version     2.3 增加身份证正反面图片生成
 * @version     3.0.1 更新中华人民共和国行政区划代码
 * @Author      AlicFeng
 * @datetime    2019-11-27
 * @github  https://github.com/alicfeng
 * @email   a@samego.com
 */
class IdentityCard
{
    use Area;

    /*男:M 女:F*/
    public const SIGN_MALE   = 'M';
    public const SIGN_FEMALE = 'F';

    /**
     * @funtction      获取性别
     * @description    男为M | 女为F case 15 最后一位奇男偶女 case 18 倒数第二位奇男偶女
     * @param string $id 身份证号码
     * @return string
     * @throws CertificateException
     * @deprecated     please use InfoHelper::identity()->sex instead
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
     * @funtction      获取出生年月日
     * @description    格式为 yyyy-mm-dd
     * @param string $id 身份证号码
     * @return string
     * @throws CertificateException
     * @deprecated     please use InfoHelper::identity()->birthday instead
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

        return $year . '-' . $month . '-' . $day;
    }

    /**
     * @funtction      根据身份证号码计算年龄
     * @description    根据身份证号码计算年龄
     * @param string $id 身份证号码
     * @return int
     * @throws CertificateException
     * @deprecated     please use InfoHelper::identity()->age instead
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
        if ((int) ($cMonth . $cDay) < (int) ($aMonth . $aDay)) {
            --$age;
        }

        unset($aYear, $aMonth, $aDay, $cYear, $cMonth, $cDay, $ageTime, $currentTime);

        return $age;
    }

    /**
     * @funtction      获取生肖
     * @description    返回生肖的中文名称
     * @param string $id 身份证号码
     * @return string
     * @throws CertificateException
     * @deprecated     please use InfoHelper::identity()->constellation instead
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
     * @funtction      获取星座
     * @description    返回星座的中文名称
     * @param string $id 身份证号码
     * @return bool|string
     * @throws CertificateException
     * @deprecated     please use InfoHelper::identity()->star instead
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
     * @funtction      校验身份证证件的正确性
     * @description    校验身份证证件的正确性
     * @param string $id 身份证号码
     * @return bool
     * @deprecated     please use InfoHelper::identity()->validate instead
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
     * @funtction    计算身份证的最后一位验证码
     * @description  根据国家标准GB 11643-1999，前提必须是18位的证件号
     * @param string $idBody 证件号码的前17位数字
     * @return bool|mixed
     * @deprecated   please use InfoHelper::identity()->calculateCode instead
     */
    private static function calculateCode($idBody)
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
     * @funtction  将15位身份证升级到18位
     * @param string $id 身份证号码
     * @return bool|string
     * @deprecated please use InfoHelper::identity()->convert15to18 instead
     */
    public static function convert15to18($id)
    {
        if (15 != strlen($id)) {
            return false;
        }
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (false !== array_search(substr($id, 12, 3), ['996', '997', '998', '999'])) {
            $idBody = substr($id, 0, 6) . '18' . substr($id, 6, 9);
        } else {
            $idBody = substr($id, 0, 6) . '19' . substr($id, 6, 9);
        }

        return $idBody . self::calculateCode($idBody);
    }

    /**
     * @funtction  校验18位身份证的有效性
     * @param string $id 身份证号码
     * @return bool
     * @deprecated please use InfoHelper::identity()->check18IDCard instead
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
     * @function   生成身份证正面图片
     * @param string $name       姓名
     * @param string $gender     性别
     * @param string $nation     名族
     * @param int    $birthday   生日 | 时间戳
     * @param string $address    地址
     * @param string $id         证件号
     * @param string $image_path 背景图片 | 865 * 540px
     *
     * @return resource 图片资源句柄
     * @deprecated please use InfoHelper::identity()->createFrontImage instead
     */
    public function createFrontImage(
        string $name,
        string $gender,
        string $nation,
        int $birthday,
        string $address,
        string $id,
        string $image_path = __DIR__ . '/../../../source/front_pure.jpg'
    ) {
        list($font_size, $angle)  = [22, 0];
        list($year, $month, $day) = explode('-', date('Y-m-d'), $birthday);
        $font_file                = __DIR__ . '/../../../source/font' . DIRECTORY_SEPARATOR . 'Hiragino Sans GB.ttc';

        $image       = imagecreatefromjpeg($image_path);
        $black_color = imagecolorallocate($image, 43, 43, 43);

        imagettftext($image, $font_size, $angle, 170, 120, $black_color, $font_file, $name);
        imagettftext($image, $font_size, $angle, 157, 183, $black_color, $font_file, $gender);
        imagettftext($image, $font_size, $angle, 340, 183, $black_color, $font_file, $nation);
        imagettftext($image, $font_size, $angle, 165, 245, $black_color, $font_file, $year);
        imagettftext($image, $font_size, $angle, 300, 245, $black_color, $font_file, $month);
        imagettftext($image, $font_size, $angle, 390, 245, $black_color, $font_file, $day);
        imagettftext($image, $font_size, $angle, 320, 475, $black_color, $font_file, $id);

        $address_data     = StringHelper::mb_str_split($address);
        $address_length   = count($address_data);
        $address_one_line = implode('', array_slice($address_data, 0, $address_length > 13 ? 13 : $address_length));
        imagettftext($image, $font_size, $angle, 160, 310, $black_color, $font_file, $address_one_line);

        if ($address_length > 13) {
            $address_two_line = implode('', array_slice($address_data, 13, $address_length - 13));
            imagettftext($image, $font_size, $angle, 160, 347, $black_color, $font_file, $address_two_line);
        }

        return $image;
    }

    /**
     * @function   生成图片反面图片
     * @param string $start_date 有效起期 | yyyy.mm.dd
     * @param string $end_date   有效止期 | yyyy.mm.dd
     * @param string $sign       签发机关
     * @param string $image_path 背景图片 | 865 * 540px
     * @return resource 图片资源句柄
     * @deprecated please use InfoHelper::identity()->createBackImage instead
     */
    public function createBackImage(
        string $start_date,
        string $end_date = '长期',
        string $sign = 'SameGo Team Generated',
        string $image_path = __DIR__ . '/../../../source/back_pure.jpg'
    ) {
        list($font_size, $angle) = [18, 0];
        $font_file               = __DIR__ . '/../../../source/font' . DIRECTORY_SEPARATOR . 'Hiragino Sans GB.ttc';

        $image       = imagecreatefromjpeg($image_path);
        $black_color = imagecolorallocate($image, 43, 43, 43);

        $date_info = $start_date . '-' . $end_date;

        imagettftext($image, $font_size, $angle, 350, 410, $black_color, $font_file, $sign);
        imagettftext($image, $font_size, $angle, 350, 475, $black_color, $font_file, $date_info);

        return $image;
    }
}
