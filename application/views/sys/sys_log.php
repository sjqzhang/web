
<div class="main-content" id="page_div">


    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="<?php echo site_url() ?>">首页</a>
            </li>
            <li class="active"></li>
        </ul>
    </div>


    <div class="page-content">
        <div class="page-content-area">
            <div class="row">
                <div class="col-xs-12">
                
                <!--

                    <script src="resources/assets/js/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
                    <script src="resources/assets/js/jqBootstrapValidation/jqBootstrapValidation.js"></script>
                    <script src="resources/assets/js/basegrid.js"></script>
                          
        <link rel="stylesheet" href="resources/assets/js/mmgrid/mmGrid.css">
        <link rel="stylesheet" href="resources/assets/js/mmgrid/theme/bootstrap/mmGrid-bootstrap.css">
        <link rel="stylesheet" href="resources/assets/js/mmgrid/mmPaginator.css">
        <link rel="stylesheet" href="resources/assets/js/mmgrid/theme/bootstrap/mmPaginator-bootstrap.css">
        
                <script src="resources/assets/js/mmgrid/mmGrid.js"></script>
        <script src="resources/assets/js/mmgrid/mmPaginator.js"></script>
        
        
        
        <script src="resources/assets/js/markdown/markdown.min.js"></script>
        <script src="resources/assets/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="resources/assets/js/jquery.hotkeys.min.js"></script>
        <script src="resources/assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="resources/assets/js/bootbox.min.js"></script>
        <script src="resources/assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="resources/assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="resources/assets/js/date-time/moment.min.js"></script>
        <script src="resources/assets/js/date-time/daterangepicker.min.js"></script>
        <script src="resources/assets/js/date-time/bootstrap-datetimepicker.min.js"></script>
		-->

        
        
        <script src="resources/sys/js/sys_log.js"></script>       
                
                    <!-- PAGE CONTENT BEGINS -->
       <!--
        <div id="gridBarId">
                <button id="addBtn" class="btn btn-xs  btn-success">
                    <i class="ace-icon fa  fa-plus bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">新增</span>
                </button>
                <span> &nbsp;&nbsp;</span>
                <button id="editBtn" class="btn btn-xs  btn-pink">
                    <i class="ace-icon fa  fa-edit  bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">修改</span>
                </button>
                <span> &nbsp;&nbsp;</span>
                <button id="delBtn" class="btn btn-xs   btn-danger">
                    <i class="ace-icon fa fa-university bigger-110"></i>
                    <span class="bigger-110 no-text-shadow">删除</span>
                </button>
      </div>
	  -->
                                
        <div class="space-2"></div>
        <div class="hr hr-dotted"></div>
                                
                                
         <div id="gridSearchBarId"  class="page-header">
                <form  class="form-inline">
                    <label class="inline input-sm">
                        <span class="lbl">关健字：</span>
                    </label>

                    <div class="form-group">
                        <input class="form-control input-sm" type="text" name="keyword" id="keyword"/> 
                    </div>

                    <span> &nbsp;&nbsp;</span>
                    <button id="searchBtn" class="btn btn-xs   btn-purple">
                        <i class="ace-icon fa  fa-search  bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">查询</span>
                    </button>
                    <!--
                    <span> &nbsp;&nbsp;</span>
                    <button class="btn btn-xs  btn-success" id="refresh">
                        <i class="ace-icon fa  fa-refresh   bigger-110"></i>
                        <span class="bigger-110 no-text-shadow">刷新</span>
                    </button>
                    -->
                </form>
            </div>

                            <div>
                                <table id="gridId"></table>
                                <div id="pageBarId"></div>
                            </div>

                            <div id="dialogPannelId" style="display:none;">
                                <form novalidate="novalidate" class="form-horizontal" id="formPannelId" method="post" role="form">
                                            <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="id">编号</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="id" id="id" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="url">路径</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="url" id="url" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="params">参数</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <div name="params" id="params" class="wysiwyg-editor"></div>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="error_code">错误码</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="error_code" id="error_code" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="error_message">错误信息</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="error_message" id="error_message" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ip">用户IP</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="ip" id="ip" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="admin_id">用户编号</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="admin_id" id="admin_id" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="time">时间</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="time" id="time" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="query">执行的sql</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="query" id="query" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>
                                </form>
                            </div>
                    
                    
                    
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
