<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>管理后台</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="{:getPublicPath()}css/font.css">
        <link rel="stylesheet" href="{:getPublicPath()}css/xadmin.css">
        <!-- <link rel="stylesheet" href="{:getPublicPath()}css/theme5.css"> -->
        <script src="{:getPublicPath()}lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="{:getPublicPath()}js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
        <script src="{:getPublicPath()}js/html5.min.js"></script>
        <script src="{:getPublicPath()}js/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <script type="text/javascript" src="{:getPublicPath()}js/live.js?t={:getCurTime()}"></script>
            <div class="logo">
                <a href="{:getPublicPath()}index.html">Tp6+Swoole后台管理</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>

            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">{:getCurUserItem('username')}</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','{:url(edituser)}',480,640)">个人信息</a></dd>
                        <dd>
                            <a href="{:url('index/loginout')}">注销登陆</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav" style="background-color: #222222;">
            <div id="side-nav">
                <ul id="nav">
                    {volist name="menu" id="menu"}
                    <li>
                        <a href="javascript:;">
                            {if $menu.itype eq 2}<i class="layui-icon {$menu.img}"  style="color: white;width: 10px;float: left"></i>{/if}
                            {if $menu.itype eq 3}<img src="{$menu.img}" style="width: 16px;height:16px;float: left;margin-top: 1px;"> {/if}
                            <cite style="color: white;margin-left: 5px;">{$menu.name}</cite>
                            <i class="iconfont nav_right" style="color: white">&#xe697;</i></a>

                        <ul class="sub-menu">
                            {volist name="$menu.sons" id="two"}
                            <li>
                                <a {if $two.controller neq ""}onclick="xadmin.add_tab('{$two.name}','{:getMenuUrl($two)}',true)"{/if}>
                                    {if $two.itype eq 2}<i class="layui-icon {$two.img}" style="color: white"></i>{/if}
                                    {if $two.itype eq 3}<img src="{$two.img}" style="width: 14px;height:14px;float: left;">
                                    <cite style="color: white;margin-left: 11px;">{$two.name}</cite>
                                    {else}
                                    <cite style="color: white;">{$two.name}</cite>
                                    {/if}

                                    <i class="iconfont nav_right" style="color: white">&#xe697;</i></a>
                                <ul class="sub-menu">
                                    {volist name="$two.sons" id="three"}
                                    <li>
                                        <a {if $three.controller neq ""}onclick="xadmin.add_tab('{$three.name}','{:getMenuUrl($three)}',true)"{/if}>
                                            {if $three.itype eq 2}<i class="layui-icon {$three.img}" style="color: white"></i>{/if}
                                            {if $three.itype eq 3}<img src="{$three.img}" style="width: 14px;height:14px;float: left;">
                                            <cite style="color: white;margin-left: 11px;">{$three.name}</cite>
                                            {else}
                                            <cite style="color: white;">{$three.name}</cite>
                                            {/if}

                                        </a>
                                    </li>
                                    {/volist}

                                </ul>
                            </li>
                            {/volist}
                        </ul>
                    </li>
                    {/volist}
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content" style="margin: 0;padding:0;">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false" >
                <ul class="layui-tab-title" style="border-bottom-color: #39AEF5">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                    <dl>
                        <dd data-type="this">关闭当前</dd>
                        <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl>
                </div>
                <div class="layui-tab-content" style="margin: 0;padding:0;">
                    <div class="layui-tab-item layui-show" style="margin: 0;padding:0;">
                        <iframe src='{:url("index/welcome")}' frameborder="0" scrolling="yes" class="x-iframe" ></iframe>

                    </div>
                    <div style="width:100%;position: absolute;bottom:0;float:left;height:30px;line-height:30px;background-color: #ffffff;color:#000000;border-top: 1px solid #eeeeee;">
                       <span style="margin-right: 10px;float: right;">© 2019-2020 <a href="javascript:;">思瑞盛集团</a></span>
                    </div>
                </div>


            </div>

        </div>
        <div class="page-content-bg" ></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->

    </body>

</html>