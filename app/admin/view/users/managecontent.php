    <div class="layui-tab layui-tab-brief" style="width: 100%;margin: 0;padding:0;position: relative">       <div class="layui-tab layui-tab-brief" lay-filter="component-tabs-hash" style="float: left;background-color: white;width:100%;">            <ul class="layui-tab-title">                <li {if condition="$itms eq 1 or $itms eq ''"}class="layui-this"{/if} lay-id="11">用户管理</li>                <li {if condition="$itms eq 3"}class="layui-this"{/if} lay-id="22">添加用户</li>            </ul>            <div class="layui-tab-content">                <div class="layui-tab-item {if condition=" $itms eq 1 or $itms eq ''"}layui-show{/if}">                <div class="layui-card">                    <div class="layui-card-body" id="comtable" style="float: left;width:98%">                        {include file="users/serchpage"/}                        {include file="users/comtable"/}                    </div>                </div>            </div>            <div class="layui-tab-item {if condition="$itms eq 3"}layui-show{/if}" >            <form class="layui-form form-container" method="post" action="{$root}index.php/admin/ginsentorder/doaddyscars" name="adddycars"                  id="adddycars">                <div class="layui-form" lay-filter="">                    <div id="alycary">                        {include file="users/additem"/}                    </div>                </div>            </form>        </div>        </div>    </div>