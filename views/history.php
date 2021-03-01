<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>历史预约记录</title>
    <meta name="renderer" content="webkit">
    <script src="/layui/layui.js"></script>
    <script>
        window.onload=function(){
            document.getElementById("history").className += " layui-this";
        }
    </script>
</head>
<body>
<?php
include("headbar.php")
?>
<table id="main" lay-filter="mainTable" class="layui-table" lay-data="{url:'/ajax/historyList.php/'}">
    <thead>
    <tr>
        <th lay-data="{field:'historyid', width:80, sort: true,     fixed: true}">编号</th>
        <th lay-data="{field:'openid', width:120}">用户</th>
        <th lay-data="{field:'ip', width:160}">ip来源</th>
        <th lay-data="{field:'times', width:160, sort: true}">浏览次数</th>
        <th lay-data="{field:'totalTime', width:160, sort: true}">总浏览时间/秒</th>
        <th lay-data="{field:'time', width:160, sort: true}">首次访问时间</th>
        <th lay-data="{field:'province', width:160, sort: true}">省</th>
        <th lay-data="{field:'city', width:160, sort: true}">市</th>
    </tr>
    </thead>
</table>

<script src="js/history.js"></script>
</body>
</html>
