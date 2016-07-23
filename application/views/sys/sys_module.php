<div class="main-content" id="page_div">
<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?php echo site_url() ?>">首页</a>
        </li>
        <li class="active">模块管理</li>
    </ul>
    <!-- /.breadcrumb -->
</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">
<div class="page-content-area">
<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->
<div class="page-header">

    <div class="row">
        <div class="col-xs-1" style="min-width: 80px">
            <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="loadPage('index.php/sys_module/add?module_type=module')">
                <i class="ace-icon fa fa-plus bigger-110"></i>新建
            </a>
        </div>
        <div class="col-xs-1" style="min-width: 80px">


            <a id="sort_save" href="javascript:saveSort()" class="btn  btn-sm disabled">
                <i class="ace-icon fa fa-save bigger-110"></i>保存排序
            </a>
        </div>
    </div>
</div>
<table id="myTable" class="table table-striped  table-hover">
    <thead>
    <tr>


        <th>模块名称</th>
        <th style="width: 90px">操作</th>
    </tr>
    </thead>

    <tbody id="sortable1">
    <?php foreach ($list as $value): ?>
        <tr>
        <td colspan="2">


        <table class="table table-striped table-bordered table-hover" style="margin: 0">
        <tr>

            <td><a href="#" class="portlet-header" module="module" value="<?php echo $value['id'] ?> "><i
                        class="ace-icon fa fa-arrows bigger-110"></i><?php echo $value['module_name'] ?> </a></td>

            <td style="width: 90px">
                <div class="action-buttons">

                    <a class="orange"
                       href="javascript:void(0)"  onclick="loadPage('index.php/sys_module/add?module_parent_id=<?php echo $value['id'] ?>&module_type=page')"
                       title="添加页面">
                        <i class="ace-icon fa fa-plus bigger-130"></i>
                    </a>

                    <a class="green"
                       href="javascript:void(0)"  onclick="loadPage('index.php/sys_module/edit?id=<?php echo $value['id'] ?>')">
                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                    </a>

                    <div class="inline position-relative">

                        <a href="#" class="red dropdown-toggle" data-toggle="dropdown" data-position="auto">
                            <i class="ace-icon fa fa-trash-o icon-only bigger-130"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                            <li>
                                <a href="javascript:void(0)" onclick="deleteEntity('<?php echo $value['id'] ?>',this)"
                                   class="tooltip-error" data-rel="tooltip" title=""
                                   data-original-title="Delete">
                                <span class="red">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </td>
        </tr>
        <?php if (!empty($value['children']) > 0): ?>

            <tr>
                <td colspan="2">
                    <table class="table table-striped table-bordered"
                           style="margin-bottom: 0px;width: 90%;float: right">

                        <tbody id="sortable_{%$value@index%}">
                        <?php foreach ($value['children'] as $page): ?>
                            <tr>
                                <td>
                                    <table class="table table-striped table-bordered" style="margin: 0">
                                        <tr>
                                            <td><a href="#" class="portlet-header1" module="page"
                                                   value="<?php echo $page['id'] ?>"><i
                                                        class="ace-icon fa fa-arrows bigger-110"></i> <?php echo $page['module_name'] ?>
                                                </a>
                                            </td>

                                            <td>
                                                <?php echo $page['module_resource'] ?>
                                            </td>


                                            <td style="width: 90px">

                                                <div class="action-buttons">

                                                    <a class="orange"
                                                       href="javascript:void(0)"  onclick="loadPage('index.php/sys_module/add?module_parent_id=<?php echo $page['id']  ?>&module_type=action')"
                                                       title="添加功能">
                                                        <i class="ace-icon fa fa-plus bigger-130"></i>
                                                    </a>

                                                    <a class="green"
                                                       href="javascript:void(0)"  onclick="loadPage('index.php/sys_module/edit?id=<?php echo $page['id']  ?>&module_type=action&parent_id=<?php echo $page['module_parent_id'] ?>')">
                                                                              <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                    </a>

                                                    <div class="inline position-relative">

                                                        <a href="#" class="red dropdown-toggle" data-toggle="dropdown"
                                                           data-position="auto">
                                                            <i class="ace-icon fa fa-trash-o icon-only bigger-130"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                            <li>
                                                                <a href="javascript:void(0)"
                                                                   onclick="deleteEntity('<?php echo $page['id'] ?>',this)"
                                                                   class="tooltip-error" data-rel="tooltip" title=""
                                                                   data-original-title="Delete">
                                <span class="red">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>

                                            </td>
                                        </tr>
                                        <?php if (!empty($page['children']) > 0): ?>
                                            <tr>
                                                <td colspan="3">
                                                    <table class="table table-striped table-bordered"
                                                           style="margin-bottom: 0px;width: 90%;float: right">
                                                        <tbody>
                                                        <?php foreach ($page['children'] as $action): ?>
                                                            <tr>
                                                                <td><?php echo $action['module_name'] ?></td>

                                                                <td>
                                                                    <?php echo $action['module_resource'] ?>
                                                                </td>


                                                                <td style="width: 70px">

                                                                    <div class="action-buttons">


                                                                        <a class="green"
                                                                           href="javascript:void(0)"  onclick="loadPage('index.php/sys_module/edit?id=<?php echo $action['id']  ?>&parent_id=<?php echo $action['module_parent_id'] ?>')">
                                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                                        </a>

                                                                        <div class="inline position-relative">

                                                                            <a href="#" class="red dropdown-toggle"
                                                                               data-toggle="dropdown"
                                                                               data-position="auto">
                                                                                <i class="ace-icon fa fa-trash-o icon-only bigger-130"></i>
                                                                            </a>

                                                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                <li>
                                                                                    <a href="javascript:void(0)"
                                                                                       onclick="deleteEntity('<?php echo $action['id'] ?>',this)"
                                                                                       class="tooltip-error"
                                                                                       data-rel="tooltip"
                                                                                       title=""
                                                                                       data-original-title="Delete">
                                <span class="red">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </span>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>

                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>


                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </td>
            </tr>
            </table>


            </td>
            </tr>

        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- PAGE CONTENT ENDS -->
<script>
    jQuery(function($){

        $('.dd').nestable();

        $('.dd-handle a').on('mousedown', function(e){
            e.stopPropagation();
        });

        $('[data-rel="tooltip"]').tooltip();

    });
    function deleteEntity(id, btn) {

        $.get("index.php/sys_module/delete?id=" + id, function (r) {
            if (r == 1000) {
                tr_row = btn.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode
                list_table = tr_row.parentNode;
                list_table.removeChild(tr_row);
            } else {
                alert("删除失败");
            }
        });

    }
    $(function () {
        $("#sortable1").sortable({
            update: function (event, ui) {
                $("#sort_save").removeClass('disabled');
                $("#sort_save").addClass('btn-warning');
            },
            handle: ".portlet-header"
        });
        $('tbody[id^=sortable_]').sortable({
            update: function (event, ui) {
                $("#sort_save").removeClass('disabled');
                $("#sort_save").addClass('btn-warning');
            },
            handle: ".portlet-header1"
        });

//        $( "#sortable" ).disableSelection();
    });
    function saveSort() {

        var idlist = "";
        var s = "";
        var data = {};
        $("#sortable1").find("a[module='module']").each(function () {
            if (idlist != "") {
                s = "|";
            }
            idlist = idlist + s + $(this).attr('value');
        });

        data['module'] = idlist;

        idlist = "";
        s = "";
        $("#sortable1").find("a[module='page']").each(function () {
            if (idlist != "") {
                s = "|";
            }
            idlist = idlist + s + $(this).attr('value');
        });
        data['page'] = idlist;


        $.post("index.php/sys_module/sort", data, function (r) {

            if (r == 1000) {

                $("#sort_save").removeClass('btn-warning');
                $("#sort_save").addClass('disabled');
            } else {
                alert("操作失败");
            }
        });
    }
</script>
</div>
<!-- /.col -->
<div class="col-sm-6">
    <div class="dd dd-draghandle">
        <ul class="dd-list">
            <?php foreach ($list as $value): ?>
            <li class="dd-item dd2-item" data-id="13">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa <?php echo $value['module_icon']?$value['module_icon']:'fa-gears'; ?> blue bigger-130"></i>
                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content"><span  class="" module="module" value="<?php echo $value['id'] ?> "><?php echo $value['module_name'] ?> </span></div>
                <?php if (!empty($value['children']) > 0): ?>
                    <ol class="dd-list">
                    <?php foreach ($value['children'] as $page): ?>
                            <li class="dd-item dd2-item dd-collapsed" data-id="16" >
                                <div class="dd-handle dd2-handle">
                                    <i class="normal-icon ace-icon fa fa-pencil-square-o blue bigger-130"></i>
                                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                </div>
                                <div class="dd2-content">Active Users</div>
                                <?php if (!empty($page['children']) > 0): ?>
                                    <ol class="dd-list" style="display: none">
                                    <?php foreach ($page['children'] as $action): ?>
                                    <li class="dd-item dd2-item" data-id="16" >
                                        <div class="dd2-content">Active Users</div>
                                    </li>
                                    <?php endforeach; ?>
                                    </ol>
                                <?php endif; ?>
                            </li>
                    <?php endforeach; ?>
                    </ol>
                <?php endif; ?>
            </li>


            <?php endforeach; ?>
<!--            <li class="dd-item dd2-item" data-id="14">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-clock-o pink bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Recent Posts</div>
            </li>

            <li class="dd-item dd2-item" data-id="15">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-signal orange bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Statistics</div>

                <ol class="dd-list">
                    <li class="dd-item dd2-item" data-id="16">
                        <div class="dd-handle dd2-handle">
                            <i class="normal-icon ace-icon fa fa-user red bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content">Active Users</div>
                        <ol class="dd-list">
                            <li class="dd-item dd2-item" data-id="16">
                                <div class="dd-handle dd2-handle">
                                    <i class="normal-icon ace-icon fa fa-user red bigger-130"></i>

                                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                </div>
                                <div class="dd2-content">Active Users</div>
                            </li>
                        </ol>
                    </li>

                    <li class="dd-item dd2-item dd-colored" data-id="17">
                        <div class="dd-handle dd2-handle btn-info">
                            <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content btn-info no-hover">Published Articles</div>
                    </li>

                    <li class="dd-item dd2-item" data-id="18">
                        <div class="dd-handle dd2-handle">
                            <i class="normal-icon ace-icon fa fa-eye green bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content">Visitors</div>
                    </li>
                </ol>
            </li>

            <li class="dd-item dd2-item" data-id="19">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-bars blue bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Menu</div>
            </li>-->
        </ul>
    </div>
</div>
<!--<div class="col-sm-6">
    <div class="dd dd-draghandle">
        <ul class="dd-list">
            <li class="dd-item dd2-item" data-id="13">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>
                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Click on an icon to start dragging</div>
            </li>

            <li class="dd-item dd2-item" data-id="14">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-clock-o pink bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Recent Posts</div>
            </li>

            <li class="dd-item dd2-item" data-id="15">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-signal orange bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Statistics</div>

                <ol class="dd-list">
                    <li class="dd-item dd2-item" data-id="16">
                        <div class="dd-handle dd2-handle">
                            <i class="normal-icon ace-icon fa fa-user red bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content">Active Users</div>
                        <ol class="dd-list">
                            <li class="dd-item dd2-item" data-id="16">
                                <div class="dd-handle dd2-handle">
                                    <i class="normal-icon ace-icon fa fa-user red bigger-130"></i>

                                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                </div>
                                <div class="dd2-content">Active Users</div>
                            </li>
                            </ol>
                    </li>

                    <li class="dd-item dd2-item dd-colored" data-id="17">
                        <div class="dd-handle dd2-handle btn-info">
                            <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content btn-info no-hover">Published Articles</div>
                    </li>

                    <li class="dd-item dd2-item" data-id="18">
                        <div class="dd-handle dd2-handle">
                            <i class="normal-icon ace-icon fa fa-eye green bigger-130"></i>

                            <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                        </div>
                        <div class="dd2-content">Visitors</div>
                    </li>
                </ol>
            </li>

            <li class="dd-item dd2-item" data-id="19">
                <div class="dd-handle dd2-handle">
                    <i class="normal-icon ace-icon fa fa-bars blue bigger-130"></i>

                    <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                </div>
                <div class="dd2-content">Menu</div>
            </li>
        </ul>
    </div>
</div>-->
</div>
<!-- /.row -->
</div>
<!-- /.page-content-area -->
</div>
<!-- /.page-content -->
</div>
<!-- /.main-content -->
