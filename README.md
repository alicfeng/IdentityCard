<h1 align="center">
  <a href="https://github.com/alicfeng/identity-card">
    IdentityCard
  </a>
</h1>
<p align="center">
  中国（大陆）公民身份证类
</p>
<p align="center">
  <a href="https://packagist.org/packages/alicfeng/identity-card">
    <img src="https://poser.pugx.org/alicfeng/identity-card/v/stable.svg" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/alicfeng/IdentityCard">
    <img src="https://poser.pugx.org/alicfeng/identity-card/d/total.svg" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/alicfeng/identity-card">
    <img src="https://poser.pugx.org/alicfeng/identity-card/license.svg" alt="License">
  </a>
  <a href="https://github.com/alicfeng/IdentityCard">
    <img src="https://travis-ci.org/alicfeng/IdentityCard.svg?branch=master" alt="build status">
  </a>
</p>



#### 安装

在项目`composer.json`添加依赖，如下：

```json
{
"require": {
    "alicfeng/identity-card": "~3.0.1"
  }
}
```

或者直接通过`CLI`安装，如下：

```shell
composer require "alicfeng/identity-card" -vvv
```



___



#### 版本更新说明

- **V1.0**

  在版本 `1.0` 中，证件号码错误都是返回`false`。

- **V2.0**

  在版本 `2.0` 中添加异常捕获机制，证件错误将返回异常，只有`c::validate($id)`方法返回`bool`值。

- **V2.3**

  在版本 `2.3` 添加了一个新功能，可以提供身份证信息生成身份证图片。

  >  注意：图片的大小为：865 * 540 px

- **V3.0** - `2019.06.25`

  在版本 `3.0` 添加了根据省份正号码获取省、市、区行政地区中文名称。

  > 行政地区编码源于[中华人民共和国民政部](http://www.mca.gov.cn/)，更新于 `2019-06-21`。

- **V3.0.1** - `2019.11.05`

  > 行政地区编码源于[中华人民共和国民政部](http://www.mca.gov.cn/)，更新于 `2019-11-05`。
___



#### 使用

```php
use AlicFeng\IdentityCard\IdentityCard;
use AlicFeng\IdentityCard\Birthday;

$id = 'IdentityCard';

# 获取周岁 | 
$age = IdentityCard::age($id);

# 获取生日
$birthday = IdentityCard::birthday($id);

# 获取性别 | {男为M | 女为F}
$sex = IdentityCard::sex($id);

# 获取生肖
$constellation = IdentityCard::constellation($id);

# 获取星座
$star = IdentityCard::star($id);

# 获取星座
$star = Birthday::star($birthday);

# 获取年龄
$age = Birthday::age($id);

# 生成身份证正面
$front(resource) = IdentityCard::createFrontImage(...);

# 生成身份证反面
$back(resource) = IdentityCard::createBackImage(...);

# 获取省
$province = IdentityCard::privince($id, $default='');

# 获取市
$city = IdentityCard::city($id, $default='');

# 获取区
$area = IdentityCard::area($id, $default='');
```

