var ws = new WebSocket("ws://192.168.58.139:8777");
//握手监听函数
ws.onopen=function(){
    //状态为1证明握手成功，然后把client自定义的名字发送过去
    var user = "{}";
    if(ws.readyState==1){
        //握手成功后对服务器发送信息
        ws.send('type=add&ming');
    }
}
//错误返回信息函数
ws.onerror = function(){
    console.log("error");
};
//监听服务器端推送的消息
ws.onmessage = function (msg){
    layer.alert(111);
    console.log(msg);
}

//断开WebSocket连接
ws.onclose = function(){
    ws = false;
}