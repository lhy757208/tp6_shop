<?php /*a:1:{s:64:"E:\phpstudy_pro\WWW\tp6_shop\app\admin\view\category\dialog.html";i:1688960306;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>分类列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">

    <style>
        body {
            background: #ffffff;
        }

        .layui-inline {
            border: 1px solid #eee;
            width: 140px;
            height: 330px;
            margin-right: 12px;
            padding: 10px;
            line-height: 1.9;
        }

        .layui-inline ul li {
            cursor: pointer;
        }

        .active {
            color: #009688;
        }
    </style>
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">

        </div>
        <div class="layui-card-body">
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <h5>一级分类</h5>
                    <ul class="p-0" type="0">
                        <li>一级</li>
                        <li>分级</li>
                        <li>分级</li>
                    </ul>
                </div>
            </div>

            <div class="layui-inline">
                <div class="layui-input-inline">

                    <h5>二级分类</h5>
                    <ul class="p-1" type="1">
                        <li>一级</li>
                        <li>分级</li>
                        <li>分级</li>
                    </ul>
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <h5>三级分类</h5>
                    <ul class="p-2" type="2">
                        <li>一级</li>
                        <li>分级</li>
                        <li>分级</li>
                    </ul>
                </div>
            </div>
            <div class="layui-input-block"></div>
            <button class="layui-btn classify-btn" style="margin-left:300px;">确 定</button>

        </div>

    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
<script src="/static/layuiadmin/goods/js/common.js?b4"></script>
<script>

    let moke = [
        {
            id: 1,
            name: '1级分类',
            pid: 0
        }, {
            id: 1,
            name: '11级分类',
            pid: 0
        }, {
            id: 1,
            name: '12级分类',
            pid: 0
        }, {
            id: 1,
            name: '13级分类',
            pid: 0
        },
    ];



    layui.use(['form'], function () {
        function queryClassif() { // 请求分类 后端接口
            let html = ''
            moke.forEach(function (item) {
                html += '<li class="child-ele"  data-id="' + item.id + '" pid="' + item.pid + '">' + item.name + '</li>'
            })

            $('.p-0').html(html)

            // });
        }

        queryClassif(); // 获取后端分类数据


        $('body').on('click', '.child-ele', function () {
            let pid = $(this).attr('data-id') ; // 这个地方需要 修改 pid => data-id  by singwa
            let type = $(this).parent().attr('type');
            let pcls = '.p-' + (1 + parseInt(type));

            $(this).parent().children('li').removeClass('active');
            $(this).addClass('active');
            if (pcls === '.p-3') {  //第三级分类  就避免在请求接口
                return false
            }
            $(".p-3").html("");
            $(".p-2").html("");


            // let moke = [
            //     {
            //         id: 20,
            //         name: '20级分类',
            //         pid: 0
            //     }, {
            //         id: 21,
            //         name: '21级分类',
            //         pid: 0
            //     }, {
            //         id: 22,
            //         name: '22级分类',
            //         pid: 0
            //     }, {
            //         id: 23,
            //         name: '23级分类',
            //         pid: 0
            //     },
            // ];

            let url = '/admin/category/getByPid?pid=' + pid

            // 封装的ajax
            layObj.get(url, function (res) {
                moke = res.result;
                console.log(moke);
                //alert($.parseJSON(moke));
                let html = ''
                moke.forEach(function (item) {
                    html += '<li class="child-ele" data-id="' + item.id + '"  pid="' + item.pid + '">' + item.name + '</li>'
                })
                console.log(pcls, 'pcls')
                $(pcls).html(html)
            });

        })
        $('html').on('click', '.classify-btn', function () {
            let p0 = $('.p-0 .active'),
                p1 = $('.p-1 .active'),
                p2 = $('.p-2 .active');

            let p0_name = p0.text(),
                p1_name = p1.text(),
                p2_name = p2.text();

            let p0_id = p0.attr('data-id'),
                p1_id = p1.attr('data-id'),
                p2_id = p2.attr('data-id');


            parent.$('#goods_cate').val(`${p0_name}->${p1_name}->${p2_name}`)
            parent.$('#goods_cate').attr('data-ids', `${p0_id},${p1_id},${p2_id}`)
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        })
    })
</script>
</body>
</html>

