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

```
"require": {
    "alicfeng/identity-card": "~3.1.0"
  }
```

或者直接通过`CLI`安装，如下：

```shell
composer require "alicfeng/identity-card" -vvv
```



___


#### 使用

```php
use AlicFeng\IdentityCard\InfoHelper;

$id = 'IdentityCard';

# 获取周岁 | 
$age = InfoHelper::identityCard()->age($id);

# 获取生日
$birthday = InfoHelper::identityCard()->birthday($id);

# 获取性别 | {男为M | 女为F}
$sex = InfoHelper::identityCard()->sex($id);

# 获取生肖
$constellation = InfoHelper::identityCard()->constellation($id);

# 获取星座
$star = InfoHelper::identityCard()->star($id);

# 获取星座
$star = InfoHelper::birthday()->star($birthday);

# 获取年龄
$age = InfoHelper::birthday()->age($id);

# 生成身份证正面
$front = InfoHelper::identityCard()->createFrontImage(...);

# 生成身份证反面
$back = InfoHelper::identityCard()->createBackImage(...);

# 获取省
$province = InfoHelper::identityCard()->province($id, $default='');

# 获取市
$city = InfoHelper::identityCard()->city($id, $default='');

# 获取区
$area = InfoHelper::identityCard()->area($id, $default='');
```
___

#### 版本更新说明

- **V1.0**

  在版本 `1.0` 中，证件号码错误都是返回`false`。

- **V2.0**

  在版本 `2.0` 中添加异常捕获机制，证件错误将返回异常，只有`c::validate($id)`方法返回`bool`值。

- **V2.3**

  在版本 `2.3` 添加了一个新功能，可以提供身份证信息生成身份证图片。

  注意：图片的大小为：865 * 540 px

- **V3.0** - `2019.06.25`

  在版本 `3.0` 添加了根据省份正号码获取省、市、区行政地区中文名称。
  
  行政地区编码源于[中华人民共和国民政部](http://www.mca.gov.cn/)，更新于 `2019-06-21`。

- **V3.0.1** - `2019.11.05`

  行政地区编码源于[中华人民共和国民政部](http://www.mca.gov.cn/)，更新于 `2019-11-05`。
  
- **V3.1.0** - `2020.02.23`

  行政地区编码源于[中华人民共和国民政部](http://www.mca.gov.cn/)，更新于 `2020-02-19`。
  
  同时更新了内部实现的机制，调用的方法已经改变了，但是兼容低版本，建议更新旧的调用方法，将于2020.08.01不再支持旧的sdk

