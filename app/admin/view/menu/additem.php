<div class="layui-form" lay-filter="">

    <input type="hidden" name="id" value="{$item.id}">


        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称{:getImportant()}</label>
            <div class="layui-input-block" style="width: 650px;">
                <input type="text" name="name" lay-verify="required" placeholder="请输入名称" value="{$item.name}"
                       class="layui-input" style="">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">级别选择{:getImportant()}</label>
            <div class="layui-input-inline">
                <select name="pid" id="pwid" lay-filter="pwid">
                <option value="1" {if $item.level eq 1 or $item.level eq ""}selected{/if}>顶级</option>
                <option value="999" {if $item.level eq '999'}selected{/if}>特殊权限</option>
                {volist name=":getPMenus()" id="menus"}
                    <option value="{$menus.id}"  {if $menus.id eq $item.pid}selected{/if}><b>{$menus.name}</b></option>
                    {volist name="$menus.sons" id="two"}
                    <option value="{$two.id}"  {if $two.id eq $item.pid}selected{/if}>----{$two.name}</option>
                    {/volist}
                {/volist}
                </select>
            </div>
        </div>
        <div class="layui-form-item" id="tspid" style="display: none">
            <label class="layui-form-label">所属模块</label>
            <div class="layui-input-inline">
                <select name="tsid" id="tsid" lay-filter="tsid">
                    {volist name=":getPMenus()" id="menus1"}
                    <option value="{$menus1.id}"  {if $menus1.tsid eq $item.tsid}selected{/if}><b>{$menus1.name}</b></option>
                    {volist name="$menus1.sons" id="two1"}
                    <option value="{$two1.id}"  {if $two1.id eq $item.tsid}selected{/if}>----{$two1.name}</option>
                    {/volist}
                    {/volist}
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">控制器</label>
            <div class="layui-input-block" style="width: 200px;">
                <input type="text" name="controller" placeholder="如：index" value="{$item.controller}"
                       class="layui-input" style="">
            </div>
<!--            <div class="layui-form-mid layui-word-aux">默认index</div>-->
        </div>



        <div class="layui-form-item">
            <label class="layui-form-label">方法名</label>
            <div class="layui-input-block" style="width: 200px;">
                <input type="text" name="method" placeholder="如：index" value="{$item.method}"
                       class="layui-input" style="">
            </div>
<!--            <div class="layui-form-mid layui-word-aux">默认index</div>-->
        </div>



        <div class="layui-form-item">
            <label class="layui-form-label">参数</label>
            <div class="layui-input-block" style="width: 200px;">
                <input type="text" name="parameter" placeholder="如：id/1" value="{$item.parameter}"
                       class="layui-input" style="">
            </div>
<!--            <div class="layui-form-mid layui-word-aux"></div>-->
        </div>

    <div class="layui-form-item">
        <label class="layui-form-label">图标类型</label>
        <div class="layui-input-block">
            <input type="radio" name="itype" style="font-size: 12px;" value="1" {if $item.itype eq 1 or $item.itype eq ''}checked{/if} title="无图标" lay-filter="itype">
            <input type="radio" name="itype" style="font-size: 12px;" value="2" {if $item.itype eq 2}checked{/if} title="layui样式" lay-filter="itype">
            <input type="radio" name="itype" style="font-size: 12px;" value="3" {if $item.itype eq 3}checked{/if} title="手动上传" lay-filter="itype">
        </div>
    </div>

    <div style="display: none" id="tbsc">
        <div class="layui-form-item" style="position: relative;">
            <label class="layui-form-label">图标上传</label>
            <div class="layui-input-inline">
                <input name="simg" id="simg" placeholder="图片地址" value="{$item.img}" class="layui-input">
            </div>
            <button type="button" class="layui-btn layui-btn-sm" id="imgbtn" style="float: left">
                <i class="layui-icon">&#xe67c;</i>选择图片
            </button>
            <div class="layui-form-mid layui-word-aux" id="tbsctb" style="margin-left: 10px"></div>
        </div>
    </div>
    <div style="display: none" id="laytb">
        <div class="layui-form-item" style="position: relative;">
            <label class="layui-form-label">图标样式</label>
            <div class="layui-input-inline">
                <input name="img" id="img" placeholder="如：layui-icon-rate-solid" value="{$item.img}" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux" id="tbsctb" style="margin-left: 10px"><a href="https://www.layui.com/doc/element/icon.html" style="color: #00FFFF" target="_blank">图标对照</a></div>

        </div>
        </div>
<!--    <div id="kgdiv" style="display: none">-->
<!--        <div class="layui-form-item">-->
<!--            <label class="layui-form-label">图标高</label>-->
<!--            <div class="layui-input-block" style="width: 200px;">-->
<!--                <input type="number" name="iheight" placeholder="图标的高度（px）" value="{$item.iheight}"-->
<!--                       class="layui-input" style="">-->
<!--            </div>-->
<!--            <!--            <div class="layui-form-mid layui-word-aux">默认为1</div>-->
<!--        </div>-->
<!--        <div class="layui-form-item">-->
<!--            <label class="layui-form-label">图标宽</label>-->
<!--            <div class="layui-input-block" style="width: 200px;">-->
<!--                <input type="number" name="iwidth" placeholder="图标的宽度（px）" value="{$item.iwidth}"-->
<!--                       class="layui-input" style="">-->
<!--            </div>-->
<!--            <!--            <div class="layui-form-mid layui-word-aux">默认为1</div>-->
<!--        </div>-->
<!--    </div>-->
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block" style="width: 200px;">
                <input type="number" name="sort" placeholder="数字越小越靠前" value="{$item.sort}"
                       class="layui-input" style="">
            </div>
<!--            <div class="layui-form-mid layui-word-aux">默认为1</div>-->
        </div>


    <div class="layui-form-item">
        <label class="layui-form-label">是否显示{:getImportant()}</label>
        <div class="layui-input-block">
            <input type="radio" style="font-size: 12px" name="is_show" value="1" {if $item.is_show eq 1 or $item.is_show eq ''}checked{/if} title="是" lay-filter="is_show">
            <input type="radio" style="font-size: 12px" name="is_show" value="2" {if $item.is_show eq 2}checked{/if} title="否" lay-filter="is_show">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="additemform">提交</button>
        </div>
    </div>
</div>

<script>
    function setZkd(){
        var pwid = $('#pwid option:selected').val();
        if(pwid == 999){
            $("#tspid").slideDown();
        }
    }
    form.on('select(pwid)', function(data){
        setZkd();
    });
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
    setZkd();
    setitype();
</script>
{/if}