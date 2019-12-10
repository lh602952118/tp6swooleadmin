
<script>

    function delques(id) {
        layer.confirm('确定要删除吗？', {
            btn: ['是的','取消'] //按钮
        }, function(){
            $.ajax({
                url: "{:url('delItem')}",
                data: {id:id},
                cache: false,
                async: true,
                type: "POST",
                success: function (result) {
                    switch (parseInt(result)) {
                        case 1:
                            layer.msg("删除成功",{icon:1});
                            $("#message"+id).slideUp();
                            break;
                        case 2:
                            layer.msg("删除失败",{icon:2});
                            break;
                        default:
                            break;
                    }
                }
            });

        }, function(){
            return;
        });


    }
    // function edititem(id) {
    //     var url = "{:Url('edititem')}";
    //     layer.load(2);
    //     $.ajax({
    //         url: url,
    //         data: {id:id},
    //         cache: false,
    //         async: true,
    //         type: "POST",
    //         success: function (result) {
    //             layer.closeAll('loading');
    //             mainhtml(result);
    //         }
    //     });
    // }
    function edititem(id) {
        var url = "{:url('editorg')}?id="+id;
        layer.open({
            type: 2,
            title: '修改',
            shadeClose: true,
            shade: 0.8,
            area: ['70%', '80%'],
            content: url,
        });
    }
    function lookitem(id) {
        var url = "{:url('lookitem')}?id="+id;
        layer.open({
            type: 2,
            title: '查看机构详情',
            shadeClose: true,
            shade: 0.8,
            area: ['70%', '70%'],
            content: url,
        });
    }
</script>
<table class="layui-table">
    <thead>
    <tr style="background-color:#eee;">
        <th style="width:135px;">权限编号</th>
        <th style="width:130px;text-align:center;">权限名称</th>
        <th style="text-align:center;">添加时间</th>
        <th style="text-align:center;width:120px">操作</th>
    </tr>
    </thead>
    <tbody>
    {volist name="items" id="items"}
    <tr id="message{$items.id}">
        <td>{$items.id}</td>
        <td style="text-align:center;">{$items.name}</td>
        <td style="text-align:center;">{$items.add_time|date="Y年m月d日 H:i"}</td>
        <td style="text-align:center;">
            <button class="layui-btn layui-btn-warm layui-btn-xs" onclick="edititem('{$items.id}')">修改</button>
            <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delques('{$items.id}')">删除</button>
        </td>
    </tr>
    {/volist}
    </tbody>
</table>