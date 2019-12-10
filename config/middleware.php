<?php
// 中间件配置
return [
    // 别名或分组
    'alias'    => [""],
    // 优先级设置，此数组中的中间件会按照数组中的顺序优先执行
    'priority' => [
//        think\middleware\SessionInit::class,//Session初始化
//        think\middleware\AllowCrossDomain::class,//跨域请求支持
//        think\middleware\CheckRequestCache::class,//请求缓存
//        think\middleware\LoadLangPack::class,//多语言加载
//        think\middleware\FormTokenCheck::class//表单令牌
    ],
];
