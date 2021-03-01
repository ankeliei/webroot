<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>时长统计</title>
    <meta name="renderer" content="webkit">
    <script src="/layui/layui.js"></script>
    <script>
        window.onload = function () {
            document.getElementById("userTime").className += " layui-this";
        }
    </script>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="js/echarts.min.js"></script>
    <script src="js/ecStat.min.js"></script>
</head>
<body>
<?php
include("headbar.php")
?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <div id="div1" style="width: 900px;height:600px;"></div>
            <script type="text/javascript">
                var myChart1 = echarts.init(document.getElementById('div1'));
                option1 = {
                    grid: {
                        top : '15%',
                        height: '70%'
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataZoom: {
                                yAxisIndex: "none"
                            },
                            dataView: {
                                readOnly: false
                            },
                            magicType: {
                                type: ["line", "bar"]
                            },
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    dataZoom: [
                        {
                            type:"slider",//slider表示有滑动块的，
                            show:true,
                            xAxisIndex:[0],//表示x轴折叠
                            start:0,//数据窗口范围的起始百分比,表示1%
                            end:100//数据窗口范围的结束百分比,表示35%坐标
                        }
                    ],
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                        data: ['当日新增用户','总用户量'],
                        selected: {
                            '当日新增用户': true,
                            '总用户量': true
                        }
                    },
                    title: {
                        x:'center',
                        y:'top',
                        textAlign:'left',
                        text: '新增用户统计'
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                    },
                    xAxis: {
                        type: 'time',
                        boundaryGap: false
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [
                        {
                            name: '当日新增用户',
                            data: [],
                            type: 'bar',
                            areaStyle: {}
                        },
                        {
                            name: '总用户量',
                            data: [],
                            type: 'line'
                        }
                    ]
                };
            </script>

            <br><br><br><br>

            <div id="div2" style="width: 900px;height:600px;"></div>
            <script type="text/javascript">
                var myChart2 = echarts.init(document.getElementById('div2'));

                option2 = {
                    title: {
                        x:'center',
                        y:'top',
                        textAlign:'left',
                        text: '用户浏览时长分布直方图'
                    },
                    grid: {
                        top : '20%',
                        height: '70%'
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataZoom: {
                                yAxisIndex: "none"
                            },
                            dataView: {
                                readOnly: false
                            },
                            magicType: {
                                type: ["line", "bar"]
                            },
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                    },
                    xAxis: {
                        name: '时长(秒)',
                        type: 'value'
                    },
                    yAxis: {
                        name: '人次',
                        type: 'value'
                    },
                    // legend: {
                    //     orient: 'vertical',
                    //     left: 'left',
                    //     data: ['浏览时长分布','浏览次数分布','单次平均浏览时间分布'],
                    //     selected: {
                    //         '浏览时长分布': true,
                    //         '浏览次数分布': true,
                    //         '单次平均浏览时间分布': true
                    //     }
                    // },
                    series: [
                        {
                            name: '浏览时长分布',
                            type: 'bar',
                            data: []
                        }
                        // ,
                        // {
                        //     name: '浏览次数分布',
                        //     type: 'bar',
                        //     data: []
                        // },
                        // {
                        //     name: '单次平均浏览时间分布',
                        //     type: 'bar',
                        //     data: []
                        // },
                    ]
                };
            </script>

            <br><br><br><br>

            <div id="div3" style="width: 900px;height:600px;"></div>
            <script type="text/javascript">
                var myChart3 = echarts.init(document.getElementById('div3'));

                option3 = {
                    title: {
                        x:'center',
                        y:'top',
                        textAlign:'left',
                        text: '点击率分布'
                    },
                    grid: {
                        top : '20%',
                        height: '70%'
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataZoom: {
                                yAxisIndex: "none"
                            },
                            dataView: {
                                readOnly: false
                            },
                            magicType: {
                                type: ["line", "bar"]
                            },
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {
                            type: 'shadow'
                        },
                    },
                    xAxis: {
                        name: '时间',
                        type: 'time'
                    },
                    yAxis: {
                        name: '点击量（次）',
                        type: 'value'
                    },
                    series: [
                        {
                            name: '点击率',
                            type: 'line',
                            data: []
                        }
                    ]
                };
            </script>
        </div>
    </div>
</div>
<script>
    layui.use(['jquery','element'], function () {
        var element = layui.element;
        var $ = layui.$;

        $.ajax({url:"/ajax/firstTime.php",success:function (result){
                res1 = JSON.parse(result);
                firstday = new Date(new Date(res1.data[0]).toDateString());

                numberToday = 0;
                for(i = 0; i<res1.count; i++){
                    if(new Date(res1.data[i])<new Date(firstday.getTime() + 24*60*60*1000)){
                        numberToday = numberToday+1;
                    }
                    else {
                        option1.series[0].data.push([firstday.toLocaleDateString(),numberToday]);
                        option1.series[1].data.push([firstday.toLocaleDateString(),i]);
                        firstday = new Date(firstday.getTime() + 24*60*60*1000);
                        numberToday = 0;
                        i--;
                    }
                }
                console.log(option1.series[0].data);
                myChart1.setOption(option1);
            }})

        $.ajax({url: "/ajax/totalTime.php", success:function (result){
                res2 = JSON.parse(result);
                data0 = [];
                console.log(res2);
                for(i =0; i<res2.count; i++){
                    data0.push(Number(res2.data[i][1]));
                }
                var bins0 = ecStat.histogram(data0,'scott');

                option2.series[0].data = bins0.data;

                myChart2.setOption(option2);
            }})

        $.ajax({url:"/ajax/clickNumber.php", success:function (result){
                res3 = JSON.parse(result);
                console.log(res3);
                for(i=0; i<res3.count; i++){
                    option3.series[0].data.push([ new Date(res3.data[i][0]*1000).toLocaleDateString(), res3.data[i][1]]);
                }
                myChart3.setOption(option3);
            }})
    });
</script>
</body>
</html>
