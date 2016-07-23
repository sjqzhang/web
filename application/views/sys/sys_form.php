
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

      <style>
	  
	  .modal-dialog{
		width:1280px;
		top:20px;
	  }
	.tmpSave {
    background-color: #ccc;
    border: 1px solid #ccc;
    cursor: pointer;
    float: right;
    height: 30px;
    line-height: 30px;
    text-align: center;
    width: 50px;
}

	  </style>
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

        
        
        <script src="resources/sys/js/sys_form.js"></script>       
                
                    <!-- PAGE CONTENT BEGINS -->

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
                                            <div class="form-group" style="display:none;">
        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="id"></label>
        <div class="col-xs-12 col-sm-10"  >
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="id" id="id" class="col-xs-12 col-sm-12 valid " type="text"/>
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="name">名称</label>
        <div class="col-xs-12 col-sm-10">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="name" id="name" class="col-xs-12 col-sm-12 valid " type="text"/>
				
            </div>
        </div>
    </div>    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="file_name">文件名</label>
        <div class="col-xs-12 col-sm-10">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="file_name" id="file_name" class="col-xs-12 col-sm-12 valid " type="text"/>
				<select id="tpl"></select>
				<input type="button" value="合成报表" id="btnBuildReport"/>

				<input type="button" value="载入" id="btnLoadReport"/>
            </div>
        </div>
    </div>    <div class="form-group"  style="display:none;">
        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="db">数据库</label>
        <div class="col-xs-12 col-sm-10">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="db" id="db" class="col-xs-12 col-sm-12 valid " type="text"/>
            </div>
        </div>
    </div>  

	
 <ul class="nav nav-tabs" id="myTab">
      <li><a href="#tab_ctrl">控制器</a></li>
      <li><a href="#tab_model">模型</a></li>
      <li><a href="#tab_views">视图</a></li>
      <li><a href="#tab_js">JS</a></li>
    </ul>
       


	     <script>
      $(function () {
       
      
        $('#myTab a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
		  var id=$(this).attr('href').replace('#tab_','');
		  $('textarea[id='+id+']').trigger('click');
		  //console.log($('textarea[id='+id+']'));
		  reReport._editor[id].setSize('',500);
		  
        });
		setTimeout(function(){
		 $('#myTab a:first').trigger('click');
		},500);
      })
    </script> 
	
	
	    <div class="tab-content">
		<!--
      <div class="tab-pane active" id="home">...</div>
      <div class="tab-pane" id="profile">...</div>
      <div class="tab-pane" id="messages">...</div>
      <div class="tab-pane" id="settings">...</div>
	  -->
  
	
	<div class="form-group tab-pane" id="tab_ctrl" >
        <!--
		<label class="control-label col-xs-12 col-sm-1 no-padding-right" for="ctrl">控制器</label>
        -->
		<div class="col-xs-12 col-sm-12">
            <div class="clearfix"  style="border:1px solid #ccc">
                <textarea  name="ctrl"  mode="php"  id="ctrl" class="code"></textarea>
            </div>
			<div class="tmpSave">保存</div>
        </div>
    </div>    <div class="form-group tab-pane" id="tab_model">
	    <!--
        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="model">模型</label>
		-->
        <div class="col-xs-12 col-sm-12" >
            <div class="clearfix" style="border:1px solid #ccc">
                <textarea name="model" mode="php" id="model" class="code"></textarea>
            </div>
			<div class="tmpSave">保存</div>
        </div>
    </div>    <div class="form-group tab-pane" id="tab_views">
        <!--
		<label class="control-label col-xs-12 col-sm-1 no-padding-right" for="views">视图</label>
        -->
		<div class="col-xs-12 col-sm-12">
            <div class="clearfix"  style="border:1px solid #ccc">
                <textarea name="views" mode="php" id="views" class="code"></textarea>
            </div>
			<div class="tmpSave">保存</div>
        </div>
    </div>    <div class="form-group tab-pane" id="tab_js">
        <!--
		<label class="control-label col-xs-12 col-sm-1 no-padding-right" for="js">JS</label>
        -->
		<div class="col-xs-12 col-sm-12">
            <div class="clearfix"  style="border:1px solid #ccc">
                <textarea name="js" mode="javascript" id="js" class="code"></textarea>
            </div>
			<div class="tmpSave">保存</div>
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
