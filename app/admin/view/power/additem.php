<div class="layui-form" lay-filter="" >

    <input type="hidden" name="id" value="{$item.id}">


        <div class="layui-form-item">
            <label class="layui-form-label">权限名称{:getImportant()}</label>
            <div class="layui-input-block" style="width: 650px;">
                <input type="text" name="name" lay-verify="required" placeholder="请输入名称" value="{$item.name}"
                       class="layui-input" style="">
            </div>
        </div>
    <div class="layui-form-item">
        <label class="layui-form-label">权限级别{:getImportant()}</label>
        <div class="layui-input-inline">
            <select name="level" id="level" lay-filter="level">

                <option value="1"  {if $item.level == 1}selected{/if}>1</option>
                <option value="2"  {if $item.level == 2}selected{/if}>2</option>
                <option value="3"  {if $item.level == 3}selected{/if}>3</option>
                <option value="4"  {if $item.level == 4}selected{/if}>4</option>
                <option value="5"  {if $item.level == 5}selected{/if}>5</option>
                <option value="6"  {if $item.level == 6}selected{/if}>6</option>
                <option value="7"  {if $item.level == 7}selected{/if}>7</option>
                <option value="8"  {if $item.level == 8}selected{/if}>8</option>
                <option value="9"  {if $item.level == 9}selected{/if}>9</option>
                <option value="10"  {if $item.level == 10}selected{/if}>10</option>
                <option value="11"  {if $item.level == 11}selected{/if}>11</option>
                <option value="12"  {if $item.level == 12}selected{/if}>12</option>
                <option value="13"  {if $item.level == 13}selected{/if}>13</option>
                <option value="14"  {if $item.level == 14}selected{/if}>14</option>
                <option value="15"  {if $item.level == 15}selected{/if}>15</option>

            </select>
            <div class="layui-form-mid layui-word-aux">建议：权限越大数字越大</div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">权限选择</label>
        <div class="layui-input-inline" style="width: 80%;">
            <table class="layui-table">
                <thead>

                <th style="width: 150px;text-align: left">顶层权限</th>
                <th>下属权限</th>
                </thead>
                <tbody>
                {volist name=":getPowerMenus()" id="sub"}

                <tr>
                    <td style="width: 120px;text-align: left">
                        <input type="checkbox" style="float: left;" name="mids[]" {volist name="$item.mids" id="em"}  {if $em.mid eq $sub.id}checked{/if} {/volist} value="{$sub.id}" title="{$sub.name}" lay-skin="primary">
                    </td>
                    <td>
                        {volist name="$sub.sons" id="son"}
                        <input type="checkbox" style="float: left;" name="mids[]" {volist name="$item.mids" id="em"}  {if $em.mid eq $son.id}checked{/if} {/volist} value="{$son.id}" title="{$son.name}" lay-skin="primary">
                        {volist name="$son.sons" id="son1"}
                        <input type="checkbox" style="float: left;" name="mids[]" {volist name="$item.mids" id="em"}  {if $em.mid eq $son1.id}checked{/if} {/volist} value="{$son1.id}" title="{$son1.name}" lay-skin="primary">
                        {/volist}
                        {/volist}
                    </td>
                </tr>
                {/volist}
                </tbody>
            </table>


        </div>
    </div>


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="additemform">提交</button>
        </div>
    </div>
</div>

<script>

    function setitype(){
        var itype = $("input[name='itype']:checked").val();
        if(itype == 1){
            $("#tbsc").slideUp();
            $("#laytb").slideUp();
            // $("#kgdiv").slideUp();
        }
        if(itype == 2){
            $("#laytb").slideDown();
            $("#tbsc").slideUp();
            // $("#kgdiv").slideDown();
        }
        if(itype == 3){
            $("#tbsc").slideDown();
            $("#laytb").slideUp();
            // $("#kgdiv").slideDown();
        }
    }
    form.on('radio(itype)', function (data) {
        setitype();
    });
    layui.use('upload', function () {
        var upload = layui.upload;
        //执行实例
        var uploadInst = upload.render({
            elem: '#imgbtn' //
            ,before: function (obj) {
                layer.msg('图片上传中，请稍候……', {
                    icon: 16,
                    time: 12000000
                    ,shade: 0.01
                });
            }
            , url: "{:url('upimgs')}" //上传接口
            , done: function (res) {
                var img = res["data"]["src"];
                $("#simg").val(img);
                $("#tbsctb").html('<img src="'+img+'" style="width:20px;">');
                layer.closeAll();
            }
            , error: function () {
            }
        });
    });
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
                // $("body").html(result);
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
{if $item.id neq ""}
<script>
    setitype();
</script>
{/if}