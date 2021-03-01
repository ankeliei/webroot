<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>访问内容统计</title>
    <meta name="renderer" content="webkit">
    <script src="/layui/layui.js"></script>
    <script>
        window.onload=function(){
            document.getElementById("content").className += " layui-this";
        }
    </script>
    <link rel="stylesheet" href="./lay/Lay_ui/css/layui.css">
    <script src="echarts.min.js"></script>
</head>
<body>
<?php
include("headbar.php")
?>
<div class="layui-layout layui-layout-admin">
  
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">
        <div id="div1" style="width: 600px;height:400px;"></div>
      <script type="text/javascript">
        var myChart1 = echarts.init(document.getElementById('div1'));
        option1 = {
    title: {
        text: '梨树相关信息咨询饼状图',
        subtext: '无名草',
        left: 'center'
    },
    tooltip: {
        trigger: 'item',
        formatter: '{a} <br/>{b} : {c} ({d}%)'
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['梨树施肥', '土壤盐碱', '病虫害咨询', '梨贩卖资讯', '梨树品种']
    },
    series: [
        {
            name: '访问来源',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
                {value: 835, name: '梨树施肥'},
                {value: 310, name: '土壤盐碱'},
                {value: 234, name: '病虫害咨询'},
                {value: 135, name: '梨贩卖资讯'},
                {value: 548, name: '梨树品种'}
            ],
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
        myChart1.setOption(option1);
        </script>



    <div id="div2" style="width: 600px;height:400px;"></div>
        <script type="text/javascript">
        var myChart2 = echarts.init(document.getElementById('div2'));
        option2 = {
    title: {
        text: '漏斗图',
        subtext: '纯属虚构'
    },
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        feature: {
            dataView: {readOnly: false},
            restore: {},
            saveAsImage: {}
        }
    },
    legend: {
        data: ['展现','点击','访问','咨询','贩卖']
    },

    series: [
        {
            name:'梨树漏斗图',
            type:'funnel',
            left: '10%',
            top: 60,
            //x2: 80,
            bottom: 60,
            width: '80%',
            // height: {totalHeight} - y - y2,
            min: 0,
            max: 100,
            minSize: '0%',
            maxSize: '100%',
            sort: 'ascending',
            gap: 2,
            label: {
                show: true,
                position:'inside'
            },
            labelLine: {
                length: 10,
                lineStyle: {
                    width: 1,
                    type: 'solid'
                }
            },
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 1
            },
            emphasis: {
                label: {
                    fontSize: 20
                }
                
            },
            data: [
                {value: 60, name: '访问'},
                {value: 80, name: '咨询'},
                {value: 100, name: '贩卖'},
                {value: 40, name: '点击'},
                {value: 20, name: '展现'}
            ]
        }
    ]
};
        myChart2.setOption(option2);
        </script>
    </div>
  </div>
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="./lay/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
</script>
</body>
</html>
