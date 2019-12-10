<!doctype html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台登陆</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="{:getPublicPath()}css/font.css">
    <link rel="stylesheet" href="{:getPublicPath()}css/login.css">
    <link rel="stylesheet" href="{:getPublicPath()}css/xadmin.css">
    <script type="text/javascript" src="{:getPublicPath()}js/jquery.min.js"></script>
    <script src="{:getPublicPath()}lib/layui/layui.js" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <script src="{:getPublicPath()}js/html5.min.js"></script>
    <script src="{:getPublicPath()}js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">
    <div class="message">管理登录
    </div>
    <div id="darkbannerwrap"></div>

    <form method="post" name="form" id="form" class="layui-form">
        <input name="username" placeholder="用户名" type="text" class="layui-input">
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码" type="password" class="layui-input">
        <hr class="hr15">
        <input name="verify" lay-verify="required" placeholder="验证码" type="text" class="layui-input"
               style="width: 170px;float: left">
        <!--            <div style="150px;float: left;cursor: pointer">{:captcha_img()}</div>-->
        <img id="yzm"  src="{:captcha_src()}" onclick="getYzm()"
             style="float:left;width:170px;height:50px;cursor:pointer;" alt="captcha"/>

        <hr class="hr15">
        <hr class="hr15">
        <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20">
    </form>
</div>

<script>
    function getYzm(){
        $("#yzm").attr("src",'{:captcha_src()}?'+Math.random());
    }

    $(function () {
        layui.use('form', function () {
            var form = layui.form;
            // layer.msg('玩命卖萌中', function(){
            //   //关闭后的操作
            //   });
            //监听提交
            form.on('submit(login)', function (data) {
                var form = $("#form").serialize();
                $.ajax({
                    url: "{:url('login')}",
                    data: form,
                    cache: false,
                    async: true,
                    type: "POST",
                    success: function (result) {
                        var r = JSON.parse(result);
                        if (r["status"] == 0) {
                            getYzm();
                            layer.msg(r["message"], {icon: 2})
                        }
                        if (r["status"] == 1) {
                            window.location.href = '{:url("index/index")}';
                        }

                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $("body").html(XMLHttpRequest.responseText);
                    }

                });
                return false;
            });
            var login_info = '{:session("login_info")}';
            if (login_info != "") {
                layer.msg(login_info+' <i class="iconfont">&#xe6af;</i>');
            }
        });
    })
</script>

<!-- 底部结束 -->

</body>
{:session("login_info",null)}
</html>