
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

.highlight_red {color:#A60000;}
.highlight_green {color:#A7F43D;}
li {list-style: circle;font-size: 12px;}
li.title {list-style: none;}
ul.list {margin-left: 17px;}

div.content_wrap {width: 600px;height:380px;}
div.content_wrap div.left{float: left;width: 250px;}
div.content_wrap div.right{float: right;width: 340px;}
div.zTreeDemoBackground {width:250px;height:362px;text-align:left;}

ul.ztree {margin-top: 10px;border: 1px solid #617775;background: #f0f6e4;width:220px;height:360px;overflow-y:scroll;overflow-x:auto;}
ul.log {border: 1px solid #617775;background: #f0f6e4;width:300px;height:170px;overflow: hidden;}
ul.log.small {height:45px;}
ul.log li {color: #666666;list-style: none;padding-left: 10px;}
ul.log li.dark {background-color: #E3E3E3;}

/* ruler */
div.ruler {height:20px; width:220px; background-color:#f0f6e4;border: 1px solid #333; margin-bottom: 5px; cursor: pointer}
div.ruler div.cursor {height:20px; width:30px; background-color:#3C6E31; color:white; text-align: right; padding-right: 5px; cursor: pointer}

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
		<link rel="stylesheet" href="resources/plugins/zTree_v3/css/zTreeStyle/zTreeStyle.css">

                <script src="resources/plugins/zTree_v3/js/jquery.ztree.all-3.5.js"></script>
        
        <script src="resources/sys/js/sys_basedata.js"></script>       
                
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
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="id">编号</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="id" id="id" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>
	
 <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pid">父类别</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
			  
                <select data-placeholder="父类别"  name="pid" id="pid"  class="form-control" style="width:150px;">
				</select>
				
				<!--
				 <select data-placeholder="父类别"  name="pid" id="pid"  class="form-control" style="width:150px;">
				   
				 </select>
				 <input aria-invalid="false" aria-required="false" name="citySel" id="citySel" class="col-xs-12 col-sm-6 valid " type="text"/>
				    <a id="menuBtn" href="#" onclick="showMenu(); return false;">选择</a>
				 -->

				

            </div>
        </div>
    </div> 




	<div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">名称</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="name" id="name" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>   
	
	  <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="code">变量编码 </label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="code" id="code" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div>

	<div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="value">参数值</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
			<!--
                <input aria-invalid="false" aria-required="false" name="value" id="value" class="col-xs-12 col-sm-6 valid " type="text"/>
				-->
				<textarea style="width:390px;height:85px;" class="col-xs-12 col-sm-8 valid " name="value" id="value"  ></textarea>
            </div>
        </div>
    </div>  


 <div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sort">排序码</label>
        <div class="col-xs-12 col-sm-6">
            <div class="clearfix">
                <input aria-invalid="false" aria-required="false" name="sort" id="sort" class="col-xs-12 col-sm-6 valid " type="text"/>
            </div>
        </div>
    </div> 

                                </form>
                            </div>
      
					


				 	<div id="menuContent" class="menuContent" style="display:none; position: absolute;">
	<ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;z-index:5000"></ul>
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
