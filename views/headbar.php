<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>头部导航栏</title>
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    <script src="/layui/layui.js"></script>
</head>
<body>

<ul class="layui-nav" lay-filter="">
    <li class="layui-nav-item"><a href="/index.php"><i class="layui-icon" style="font-size: 30px; color: #009688;">&#xe68e;</i></a></li>
    <li id="history" class="layui-nav-item"><a href="/views/history.php">查看记录</a></li>
    <li id="dataInMap" class="layui-nav-item"><a href="/views/userMap.php">用户地图</a></li>
    <li id="content" class="layui-nav-item"><a href="/views/content.php">访问内容统计</a></li>
    <li id="userTime" class="layui-nav-item"><a href="/views/userTime.php">访问时长统计</a></li>
    <li id="about" class="layui-nav-item"><a href="/views/about.php">说明</a></li>
</ul>
<script>
    layui.use('element',function(){
        var element = layui.element;
        element.init();
    })
</script>
</body>
</html>
