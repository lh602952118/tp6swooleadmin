<div id="vpagediv">

    {include file="users/tablepage"}
</div>
<div class="layui-col-md12" style="text-align: right">
    <div class="layui-card">
        <div class="layui-card-body">
            <div id="laypage"></div>
        </div>
    </div>
</div>
<script>
    layui.use('laypage', function () {
        var laypage = layui.laypage;
        laypage.render({
            elem: 'laypage'
            , count: parseInt('{$count}')
            , layout: ['count', 'prev', 'page', 'next', 'skip']
            , limit: parseInt('{:getPageLimite()}')
            , jump: function (obj, first) {
                if (!first) {
                    serchecom(3,1,obj.curr);
                }
            }
        });
    });
</script>