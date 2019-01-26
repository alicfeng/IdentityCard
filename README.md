# IdentityCard
**中国（大陆）公民身份证类**

#### 安装

在项目`composer.json`添加依赖，如下：

```
"require": {
        "alicfeng/identity-card": "~1.0"
}
```

或者直接通过`CLI`安装，如下：

```shell
composer require "alicfeng/identity-card"
```



___



#### 使用

> 注意：如下的所有调用API中，证件号码错误都是返回`false`

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

