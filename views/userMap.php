<?php
require_once "../php/Dbcon.php";
$sql = "select * from history";
$con = new Dbcon();
$con->setSql($sql);
$res = $con->getRes();
$str = "";
$maxTime = 0;

if($res->num_rows > 0){
    while ($row = $res->fetch_assoc()){
        $totalTime = $row['totalTime'];
        $lat = $row['lat'];
        $lng = $row['lng'];
        if($totalTime>$maxTime){
            $maxTime = $totalTime;
        }
        $str = $str."{\"count\": ".$totalTime.", \"lat\": ".$lat.", \"lng\": ".$lng."},";
    }
    $str = rtrim($str,",");
}
else{
    $arr['sql'] = $sql;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>数据图示</title>
    <meta name="renderer" content="webkit">
    <script src="/layui/layui.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=MT6EOiljanKXED8g90iOGOd6TR0T9ET0"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/Heatmap/2.0/src/Heatmap_min.js"></script>
    <script>
        window.onload=function(){
            document.getElementById("dataInMap").className += " layui-this";
        }
    </script>

    <style type="text/css">
        ul,li{list-style: none;margin:0;padding: 0}

        html{height:100%}
        body{height:100%;margin:0px;padding:0px}
        #container{height:100%;width:78%;float:left;border-right:2px solid #bcbcbc;}
        #r-result{height:100%;width:20%;float:left;}
        .btn-container{margin:20px;}
        fieldset{border: 1px solid;border-radius: 3px;}
        fieldset label{font-size: 14px; line-height: 30px;}
        .btn{
            color: #333;background-color: #fff;display: inline-block;padding: 6px 12px;font-size: 14px;
            font-weight: normal;line-height: 1.428571429;border: 1px solid #ccc;border-radius: 4px;
            margin-top: 5px;margin-bottom: 5px;}
        .btn:hover{color: #333;background-color: #ebebeb;border-color: #adadad;}
        .text-primary{
            font-weight: bold;
        }
        textarea{border: 1px solid #ccc;border-radius: 4px;}
        textarea:focus{border-color: #66afe9;outline: 0;box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(102,175,233,0.6);}
        .color-list li{font-size: 14px; line-height: 30px;}
    </style>
</head>
<body>
<?php
include("headbar.php")
?>
<div id="container">
</div>
<div id="r-result">
    <div class="btn-container">
        <fieldset>
            <legend>热力图设置区域</legend>
            <label>设置热力图半径0-100</label>
            <input type="range" max="100" style = "width:150px" min="1" value="20" onchange="setRadius(this.value)">
            <span id="radius-result" class="text-primary">20</span>
            <br/>
            <label>设置热力图透明度0-100</label>
            <input type="range" max="100" style = "width:150px" min="1" value="80" onchange="setOpacity(this.value)">
            <span id="opacity-result" class="text-primary">80</span>
            <br/>
            <label>设置热力图渐变区间</label>

            <ul class="color-list">
                <li>起始颜色: <input data-key="0.1" type="color" value="#66FF00" onchange="setGradient()"/></li>
                <li>中间颜色: <input  data-key="0.5" type="color" value="#FFAA00" onchange="setGradient()"/></li>
                <li>结束颜色: <input data-key="1.0" type="color" value="#FF0000" onchange="setGradient()"/></li>
            </ul>

            <span style="font-size:14px;">显示热力图:</span><input type="checkbox"  onclick="toggle();" checked="checked" /></br>
        </fieldset>
    </div>

</div>
<script type="text/javascript">
    var map = new BMap.Map("container");          // 创建地图实例

    var point = new BMap.Point(108.08455, 34.27221);
    map.centerAndZoom(point, 5);             // 初始化地图，设置中心点坐标和地图级别
    map.enableScrollWheelZoom(); // 允许滚轮缩放




    // var points =[
    //     {"count": 49, "lat": 20.0440494392567, "lng":110.325525471264}];

    var points =[<?php echo $str?>];

    if(!isSupportCanvas()){
        alert('热力图目前只支持有canvas支持的浏览器,您所使用的浏览器不能使用热力图功能~')
    }

    heatmapOverlay = new BMapLib.HeatmapOverlay({"radius":20});
    map.addOverlay(heatmapOverlay);
    //heatmapOverlay.setDataSet({data:points,max:<?php //echo $maxTime?>//});
    heatmapOverlay.setDataSet({data:points});

    function setRadius(radius){
        document.getElementById("radius-result").innerHTML = radius;
        heatmapOverlay.setOptions({"radius":radius})
    }

    function setOpacity(opacity){
        document.getElementById("opacity-result").innerHTML = opacity;
        heatmapOverlay.setOptions({"opacity":opacity})
    }

    function toggle(){
        heatmapOverlay.toggle()
    }

    function setGradient(){
        var gradient = {};
        var colors = document.querySelectorAll("input[type='color']");
        colors = [].slice.call(colors,0);
        colors.forEach(function(ele){
            gradient[ele.getAttribute("data-key")] = ele.value;
        });
        heatmapOverlay.setOptions({"gradient":gradient});
    }
    function isSupportCanvas(){
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    }
</script>
</body>
</html>