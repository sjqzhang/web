<?php $_user = MAuth::get_user_info(); ?>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title ">个人信息</h4>
            </div>
            <div class="modal-body">
                <!-- #section:pages/profile.info -->
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 账号:</div>
                        <div class="profile-info-value">
                            <span class="editable" ><?php echo $_user['user_name']; ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> 姓名</div>

                        <div class="profile-info-value">
                            <span class="editable" ><?php echo $_user['truename']; ?> </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> 邮箱</div>

                        <div class="profile-info-value">
                            <span class="editable"><?php echo $_user['email']; ?> </span>
                        </div>
                    </div>
                </div>
                <p></p>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <!--
            <a href="#" class="navbar-brand">
                <i class=" fa fa-soundcloud" style="background-image:resources/assets/images/logo1_03.png"></i>
                <strong>
                    需求管理系统
                </strong>
            </a>

            <div style="float:left;width:180px;height:40px;">
              <div style="float:left;width:42px;height:42px;background-image:url('resources/assets/images/logo1.png')"></div>
              <div style="float:right;width:136px;height:100%;color:#fff;">
              <div style="float:left;padding-top:5px;"><strong>需求系统</strong></div>
              <div style="float:left;margin-top:-6px;color:#aaa;">web.web.com</div>
              </div>
            </div>
            -->

            <div><img src="resources/assets/images/logo.png"></div>

            <!-- /section:basics/navbar.layout.brand -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        欢迎你：<?php echo $_user['user_name']; ?>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="javascript:void(0)" id="info">
                                <i class="ace-icon fa fa-user"></i>
                                个人信息
                            </a>
                        </li>
						<!--
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ace-icon fa fa-lock"></i>
                                修改密码
                            </a>
                        </li>
						-->
                        <li class="divider"></li>

                        <li>
                            <a href="index.php/home/logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
    </div>
    <!-- /.navbar-container -->
</div>

