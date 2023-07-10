<?php /*a:1:{s:61:"E:\phpstudy_pro\WWW\tp6_shop\app\admin\view\category\add.html";i:1688722512;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加分类</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
</head>
<body>

<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-form" lay-filter="">
                <div class="layui-form-item">
                    <label class="layui-form-label">父级分类</label>
                    <div class="layui-input-inline">
                        <select name="group_id" lay-verify="required" lay-search="">
                            <option value="">直接选择或搜索选择</option>
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">分类名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="username" lay-verify="required|nickname"
                               value=""
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="addCategoryForm">确认</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="/static/layuiadmin/common.js"></script>
<script src="/static/layuiadmin/common-js.js"></script>

<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'useradmin', 'table', 'form'], function () {
        var form = layui.form;
        form.config.verify.url[1] = "通信地址不正确";

        form.on('submit(addCategoryForm)', function (data) {
            var field = data.field; //获取提交的字段
            console.log(field)
            if (field.password) {
                if (!field.repassword){
                    layer.msg("确认密码不能为空")
                    return;
                }
                if (field.password!=field.repassword){
                    layer.msg("二次密码不一样")
                    return;
                }

                let reg = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/

                let flag = reg.test(field.password)
                if (!flag){
                    layer.msg("密码必须6到12位且包含字母和数字，且不能出现特殊字符")
                    return;
                }
            }
            var params = {
                url: '/user/doOperate',
                data: field,
                type: 'post',
                sCallback: function (res) {
                    res = $.parseJSON(res);
                    layer.msg(res.msg, function () {
                        if (res.code == 200){
                            window.parent.location.reload()
                        }
                    })
                }
            };
            window.base.getData(params);
        })
    });

</script>
</body>
</html>

