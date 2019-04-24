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
    <a href="https://packagist.org/packages/alicfeng/identity-card">
        <img src="https://poser.pugx.org/alicfeng/identity-card/d/total.svg" alt="Total Downloads">
    </a>
	<a href="https://packagist.org/packages/alicfeng/identity-card">
    	<img src="https://poser.pugx.org/alicfeng/identity-card/license.svg" alt="License">
    </a>
</p>



#### 安装

在项目`composer.json`添加依赖，如下：

```json
"require": {
        "alicfeng/identity-card": "~2.0"
}
```

或者直接通过`CLI`安装，如下：

```shell
composer require "alicfeng/identity-card"
```



___



#### 使用

> 注意：
>
> 在版本1.0中，证件号码错误都是返回`false`。
>
> 在版本2.0中添加异常捕获机制，证件错误将返回异常，只有`c::validate($id)`方法返回`bool`值。

```php
use AlicFeng\IdentityCard\IdentityCard;

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
```

