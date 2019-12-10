<div class="layui-form" lay-filter="">

    <input type="hidden" name="id" value="{$item.id}">


        <div class="layui-form-item">
            <label class="layui-form-label">用户名{:getImportant()}</label>
            <div class="layui-input-block" style="width: 650px;">
                <input type="text" name="username" lay-verify="required" placeholder="请输入用户名" value="{$item.username}"
                       class="layui-input" style="">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">权限选择{:getImportant()}</label>
            <div class="layui-input-inline">
                <select name="pwid" id="pwid" lay-filter="pwid">
                    <option value=""><b>待选择</b></option>
                    {volist name=":getPowers()" id="power"}
                    <option value="{$power.id}"  {if $power.id eq $item.pwid}selected{/if}><b>{$power.name}</b></option>
                    {/volist}
                </select>
            </div>
        </div>


    <div class="layui-form-item">
        <label class="layui-form-label">是否启用{:getImportant()}</label>
        <div class="layui-input-block">
            <input type="radio" style="font-size: 12px" name="is_use" value="1" {if $item.is_use eq 1 or $item.is_use eq ''}checked{/if} title="是" lay-filter="is_use">
            <input type="radio" style="font-size: 12px" name="is_use" value="2" {if $item.is_use eq 2}checked{/if} title="否" lay-filter="is_use">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="additemform">提交</button>
        </div>
    </div>
</div>

<script>

    form.on('submit(additemform)', function (data) {
        var id = $("#id").val();
        layer.load(2);
        $.ajax({
            url: "{:Url('additems')}",
            data: data.field,
            cache: false,
            async: true,
            type: "POST",
            success: function (result) {
                layer.closeAll('loading');
                var r = JSON.parse(result);
                if (r["status"] == 0) {
                    layer.msg(r["message"], {icon: 2})
                }
                if (r["status"] == 1) {
                    parent.layer.closeAll();
                    parent.layer.msg(r["message"],{"icon":1});
                    if(id != "" && id != undefined){
                    }else{
                         setTimeout(function () {
                            window.location.href = "{:Url('manage')}";
                        },2000)
                    }
                }

            },error : function (XMLHttpRequest, textStatus, errorThrown) {
                $("body").html(XMLHttpRequest.responseText);
            }
        });
        return false;
    });
    form.render();
</script>