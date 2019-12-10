<div class="layui-card layui-form">

    <div class="layui-card-body layui-row layui-col-space10">
        <div class="layui-col-md12" style="font-size: 13px;">

            <input id="se_id" placeholder="用户id" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 220px;float: left;margin:0px;">

            <input id="se_username" placeholder="用户名" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 120px;float: left;margin-left:10px;">
            <input id="se_real_name" placeholder="姓名" class="layui-input" autocomplete="on"
                   style="font-size:12px;width: 150px;float: left;margin-left:10px;">

            <button class="layui-btn layui-btn-sm" style="font-size:12px;float: left;margin-left:10px;" data-type="reload"
                    onclick="serchecom(2,2)">搜索
            </button>
        </div>
        <div class="layui-col-md12">
            <div class="layui-form-item" pane="">
                <label style="float: left;line-height:40px;">状态筛选：</label>
                <div class="layui-input-block" style="margin-left: -5px;">
                    <input type="checkbox" name="se_is_use" lay-filter="se_is_use" value="1"
                           onclick="" lay-skin="primary" title="启用">
                    <input type="checkbox" name="se_is_use" lay-filter="se_is_use" value="2"
                           onclick="" lay-skin="primary" title="停用">
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function serchecom(type, isss, page) {
        var spCodesTemp = "";
        var username = $("#se_username").val();
        var real_name = $("#se_real_name").val();
        var id = $("#se_id").val();
        page = page == "" ? 1 : page;
        $('input:checkbox[name=se_is_use]:checked').each(function (i) {
            if (0 == i) {
                spCodesTemp = $(this).val();
            } else {
                spCodesTemp += ("," + $(this).val());
            }
        });
        var str = {
            page: page,
            isss: isss,
            username:username,
            real_name: real_name,
            id: id,
            is_use:spCodesTemp
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
    form.on('checkbox(se_is_use)', function (data) {
        serchecom(2, 2)
    });
    form.render();
</script>