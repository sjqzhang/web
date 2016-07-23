<div class="main-content" id="page_div">
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?php echo site_url() ?>">首页</a>
        </li>
        <li><a href="javascript:void(0)" onclick="loadPage('index.php/sys_user')">用户管理</a></li>
        <li class="active">编辑用户</li>
    </ul>
    <!-- /.breadcrumb -->
</div>
<div class="page-content">
<div class="page-content-area">
<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<h3 class="lighter block green">账号信息</h3>

<form class="form-horizontal" id="validation-form" method="post" role="form">
    <input type="hidden" name="id" id="id" class="col-xs-12 col-sm-6"
           value="<?php echo @$entity['id'] ?>"/>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="username">账号:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input type="text" name="username" id="username" class="col-xs-12 col-sm-6"
                       value="<?php echo @$entity['username'] ?>"/>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">密码:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input type="password" name="password" id="password" class="col-xs-12 col-sm-6"/>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sys_group_id">管理组:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <select name="sys_group_id" id="sys_group_id" class="col-xs-12 col-sm-6">
                    <?php foreach ($group_list as $k => $v): ?>
                        <option value="<?php echo $k; ?>"<?php if ($k == @$entity['sys_group_id']) {
                            echo "selected";
                        } ?>><?php echo $v; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>


    <div class="hr hr-dotted"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="truename">姓名:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input type="text" name="truename" id="truename" class="col-xs-12 col-sm-6"
                       value="<?php echo @$entity['truename'] ?>"/>
            </div>
        </div>
    </div>

    <div class="space-2"></div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">邮箱:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input type="email" id="email" name="email" class="col-xs-12 col-sm-6"
                       value="<?php echo @$entity['email'] ?>"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="flag_valid">启用:</label>

        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <label>
                    <input name="flag_valid" id="flag_valid" class="ace ace-switch ace-switch-6" type="checkbox"
                        <?php if (@$entity['flag_valid'] == 1) {
                            echo "checked";
                        } ?> value="1"/>
                    <span class="lbl"></span>
                </label>
            </div>
        </div>
    </div>


    <div class="clearfix ">
        <div class="col-md-offset-3 col-md-6">
            <button class="btn btn-info" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                提交
            </button>

            &nbsp; &nbsp; &nbsp;
            <a class="btn" href="javascript:void(0)" onclick="loadPage('index.php/sys_user')">
                <i class="ace-icon fa fa-undo bigger-110"></i>
                返回
            </a>
        </div>
    </div>
</form>
<script src="resources/assets/js/jquery.validate.min.js"></script>
<script>
    $(function () {
        jQuery.validator.addMethod("username", function (value, element) {
            return this.optional(element) || /^[_a-zA-Z0-9\-]+$/.test(value);
        }, "账号只能包含数字，字母，下划线");
        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    <?php if ($this->router->fetch_method() == "add"){echo "required: true,";}
                    ?>
                    minlength: 6,
                    maxlength: 15
                },
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 15,
                    username: 'required'
                },

                truename: {
                    required: true,
                    minlength: 2,
                    maxlength: 15
                }
            },
            messages: {
                email: {
                    required: "请输入邮箱",
                    email: "请输入正确邮箱格式"
                },
                password: {
                    required: "请输入密码",
                    minlength: "密码需要6-12个字符",
                    maxlength: "密码需要6-15个字符"
                },
                username: {
                    required: "请输入账号",
                    minlength: "账号需要3-15个字符",
                    maxlength: "账号需要3-15个字符"
                },
                truename: {
                    required: "请输入姓名",
                    minlength: "姓名需要2-15个字符",
                    maxlength: "姓名需要2-15个字符"
                }
            },
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },
            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },
            errorPlacement: function (error, element) {
                if (element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('div[class*="col-"]');
                    if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if (element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else error.insertAfter(element.parent());
            },
            submitHandler:function(form){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "index.php/sys_user/edit",
                    data: $('#validation-form').serialize(),
                    success: function (data) {
                        if (data.code == 0){
                            $.popMessage('ok', data.message);
//                            $("#validation-form")[0].reset();
                        }else if(data.code == 1001){
                            $.popMessage('error', data.message);
                        }else{
                            $.popMessage('warn', data.message);
                        }
                    },
                    error: function (data) {
                        $.popMessage('error', '服务器故障！');
                    }
                });
            }
        })
        ;
    })
    ;
</script>
<!-- PAGE CONTENT ENDS -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.page-content-area -->
</div>
<!-- /.page-content -->
</div>
<!-- /.main-content -->