
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
        <th style="width:135px;">菜单编号</th>
        <th style="width:100px;text-align:center;">名称</th>
        <th style="width:30px;text-align:center;">级别</th>
        <th style="width:40px;text-align:center;">上级菜单</th>
        <th style="width:60px;text-align:center;">控制器</th>
        <th style="width:60px;text-align:center;">方法名</th>
        <th style="width:30px;text-align:center;">是否显示</th>
        <th style="width:30px;text-align:center;">图标</th>
        <th style="text-align:center;">操作</th>
    </tr>
    </thead>
    <tbody>
    {volist name="items" id="items"}
    <tr id="message{$items.id}">
        <td>{$items.id}</td>
        <td style="text-align:center;">{$items.name}</td>
        <td style="text-align:center;">{$items.level|getLevelName}</td>
        <td style="text-align:center;">{$items.pid|getMenuName}</td>
        <td style="text-align:center;">{$items.controller}</td>
        <td style="text-align:center;">{$items.method}</td>
        <td style="text-align:center;">{$items.is_show|getMenuShow}</td>
        <td style="text-align:center;">{if $items.itype eq 2}<i class="layui-icon {$items.img}"></i> {/if}{if $items.itype eq 3}<img src="{$items.img}" style="width: 30px;">{/if}</td>
        <td style="text-align:center;"><button class="layui-btn layui-btn-warm layui-btn-xs" onclick="edititem('{$items.id}')">修改</button>
            <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="delques('{$items.id}')">删除</button></td>
    </tr>
    {/volist}
    </tbody>
</table>