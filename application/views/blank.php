<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>Blank Page - Ace Admin</title>

    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <base href="<?php echo base_url(); ?>"/>
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="resources/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="resources/assets/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="resources/assets/css/ace-fonts.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="resources/assets/css/ace.min.css" id="main-ace-style"/>

    <link rel="stylesheet" href="resources/common/css/common.css"/>
    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="resources/assets/js/ace-extra.min.js"></script>

</head>

<body class="skin-4 no-skin">
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default navbar-fixed-top">

    <div class="navbar-container" id="navbar-container">

        <div class="navbar-header pull-left">
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand">
                <i class=" fa fa-soundcloud"></i>
                <strong>
                    运维管理系统
                </strong>
            </a>

            <!-- /section:basics/navbar.layout.brand -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        欢迎你：陈文华
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                修改密码
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#">
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

<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <!-- #section:basics/sidebar -->
    <div id="sidebar" class="sidebar responsive">
        <ul class="nav nav-list">
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-gears"></i>
                    <span class="menu-text"> 系统管理 </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu" style="display: block">
                    <li class="">
                        <a href="form-elements.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            用户管理
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="form-wizard.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            用户组管理
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="wysiwyg.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            模块管理
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <li class="">
                        <a href="wysiwyg.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            操作日志
                        </a>

                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> 开发模板 </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu" style="display: block">
                    <li class="">
                        <a href="form-elements.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            模板一
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="form-wizard.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            模板二
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="wysiwyg.html">
                            <i class="menu-icon fa fa-caret-right"></i>
                            模板三
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>
            <li class="">
                <a href="index.php/welcome/test">
                    <i class="menu-icon fa fa-bar-chart-o"></i>
                    <span class="menu-text"> 系统报表 </span>
                </a>

                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="index.php/welcome/test">
                    <i class="menu-icon fa fa-cog"></i>
                    <span class="menu-text"> 开发工具 </span>
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
        <!-- /.nav-list -->

        <!-- #section:basics/sidebar.layout.minimize -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left"
               data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>

    </div>

    <!-- /section:basics/sidebar -->
    <div class="main-content">
        <!-- #section:basics/content.breadcrumbs -->
        <div class="breadcrumbs" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>

                <li>
                    <a href="#">Other Pages</a>
                </li>
                <li class="active">Blank Page</li>
            </ul>
            <!-- /.breadcrumb -->
        </div>

        <!-- /section:basics/content.breadcrumbs -->
        <div class="page-content">
            <div class="page-content-area">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div id="page_div"></div>
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

    <div class="footer">
        <div class="footer-inner">
            <!-- #section:basics/footer -->
            <div class="footer-content">
						<span class="bigger-120">
							魅族科技有限公司 &copy; 2003-2014
						</span>

            </div>

            <!-- /section:basics/footer -->
        </div>
    </div>

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div>
<!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='resources/assets/js/jquery.min.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='resources/assets/js/jquery1x.min.js'>" + "<" + "/script>");
</script>
<![endif]-->
<script src="resources/assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="resources/assets/js/ace-elements.min.js"></script>
<!--<script src="resources/assets/js/ace.min.js"></script>-->
<script src="resources/assets/js/uncompressed/ace.js"></script>
<!-- inline scripts related to this page -->
<script src="resources/common/js/common.js"></script>
</body>
</html>
