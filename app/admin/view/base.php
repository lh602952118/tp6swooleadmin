<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    {block name="title"}<title>网站标题</title>{/block}
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="{:getPublicPath()}css/xadmin.css?t={:getCurTime()}">
    <link rel="stylesheet" href="{:getPublicPath()}css/font.css?t={:getCurTime()}">
    <link rel="stylesheet" href="{:getPublicPath()}lib/layui/css/layui.css?t={:getCurTime()}">
    {block name="css"}{/block}
    <script type="text/javascript" src="{:getPublicPath()}lib/layui/layui.all.js?t={:getCurTime()}"></script>
    <script type="text/javascript" src="{:getPublicPath()}js/jq2.1.4.js?t={:getCurTime()}"></script>
    {block name="head_script"}{/block}
</head>
<body style="background-color: white">
<script>
    var form = layui.form;
</script>
{block name="body"}{/block}
</body>
{block name="foot_script"}{/block}
</html>