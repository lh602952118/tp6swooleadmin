<div class="layui-card layui-form">

    <div class="layui-card-body layui-row layui-col-space10">
        <div class="layui-col-md12" style="font-size: 13px;">

            <input id="name" placeholder="菜单名称" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 220px;float: left;margin:0px;">
            <div class="layui-inline" style="margin-bottom: 10px;width:120px;float:left;margin-left:10px;">
                <select name="pid" id="pid" lay-filter="pid" >
                    <option value="">上级选择</option>
                    {volist name=":getPMenus()" id="plevel"}
                    <option value="{$plevel.id}">{$plevel.name}</option>
                    {/volist}
                </select></div>
            <input id="controller" placeholder="控制器" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 120px;float: left;margin-left:10px;">
            <input id="method" placeholder="方法名" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 150px;float: left;margin-left:10px;">

            <button class="layui-btn layui-btn-sm" style="font-size:12px;float: left;margin-left:10px;" data-type="reload"
                    onclick="serchecom(2,2)">搜索
            </button>
        </div>
        <div class="layui-col-md12">
            <div class="layui-form-item" pane="">
                <label style="float: left;line-height:40px;">状态筛选：</label>
                <div class="layui-input-block" style="margin-left: -5px;">
                    <input type="checkbox" name="level" lay-filter="level" value="999"
                           onclick="" lay-skin="primary" title="特殊">
                    <input type="checkbox" name="level" lay-filter="level" value="1"
                           onclick="" lay-skin="primary" title="一级">
                    <input type="checkbox" name="level" lay-filter="level" value="2"
                           onclick="" lay-skin="primary" title="二级">
                    <input type="checkbox" name="level" lay-filter="level" value="3"
                           onclick="" lay-skin="primary" title="三级">
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function serchecom(type, isss, page) {
        var spCodesTemp = "";
        var name = $("#name").val();
        var controller = $("#controller").val();
        var method = $("#method").val();
        var pid = $("#pid").val();
        page = page == "" ? 1 : page;
        $('input:checkbox[name=level]:checked').each(function (i) {
            if (0 == i) {
                spCodesTemp = $(this).val();
            } else {
                spCodesTemp += ("," + $(this).val());
            }
        });
        var str = {
            page: page,
            isss: isss,
            pid:pid,
            name: name,
            controller: controller,
            method:method,
            level:spCodesTemp
        };
        layer.load(1);
        $.ajax({
            url: "{:Url('manage')}",
            data: str,
            cache: false,
            async: true,
            type: "POST",
            success: function (result) {
                layer.closeAll('loading');
                switch (type) {
                    case 1:
                        $("#tbandpage").html(result);
                        break;
                    case 2:
                        $("#tbandpage").html(result);
                        break;
                    case 3:
                        $("#vpagediv").html(result);
                        break;
                    default:
                        break;
                }
            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.responseText);
            }
        });
    }
    var form = layui.form;
    form.on('checkbox(level)', function (data) {
        serchecom(2, 2)
    });
    form.render();
</script>