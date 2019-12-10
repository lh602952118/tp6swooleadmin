{extend name="base"}
{block name="body"}

<table class="layui-table" style="text-align: left">
    <tbody>
    <tr>
        <td style="font-weight: bold;width: 100px;" colspan="1">机构名称</td>
        <td colspan="5" style="text-align: left;">{$orginfo.orgname}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;width: 100px;" colspan="1">创建日期</td>
        <td colspan="1" style="text-align: left;">{$orginfo.add_time|date="Y年m月d日 H:i",###}</td>
        <td style="font-weight: bold;width: 100px;" colspan="1">更新时间</td>
        <td colspan="3" style="text-align: left;">{$orginfo.last_time|date="Y年m月d日 H:i",###}</td>
    </tr>
    <tr>
        <td style="font-weight: bold;width: 100px;" colspan="1">负责人</td>
        <td colspan="1" style="text-align: left;">{$orginfo.real_name}</td>
        <td style="font-weight: bold;width: 100px;" colspan="1">联系电话</td>
        <td colspan="3" style="text-align: left;">{$orginfo.linkphone}</td>
    </tr>
    <tr>
        <td style="font-weight: bold">机构总教师人数</td>
        <td colspan="5">{$orginfo.tcnum}</td>
    </tr>
    {volist name="$orginfo.tcstes" id="tcst"}
    <tr>
        <td style="font-weight: bold">教师姓名</td>
        <td colspan="1">{$tcst.tcname}</td>
        <td style="font-weight: bold">学生人数</td>
        <td colspan="3">{$tcst.stnmu}</td>
    </tr>
    {/volist}
    <tr>
        <td style="font-weight: bold">机构总学生人数</td>
        <td colspan="5">{$orginfo.snum}</td>
    </tr>

    </tbody>
</table>

<div style="width: 100%;height:70px;float: left;clear: both;"></div>
{/block}
