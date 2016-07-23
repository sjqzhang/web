
function WfNode(){
	that=this;
	if(location.href.indexOf('wf_node')>=0){
		this.baseUrl='';
	} else {
		this.baseUrl='index.php/wf_node/';
	}
	
	BaseGrid.call(this,WfNode.prototype);
}



WfNode.prototype={
		init:function(){
	
		var self=this;
	
		    var cols = [
	{title: '结点id', name : 'node_id', width : 5, sortable : false, align: 'left'},
		{title: '流程id', name : 'defination_id', width : 5, sortable : false, align: 'left'},
		{title: '结点名称', name : 'node_name', width : 5, sortable : false, align: 'left'},
		{title: '结点序号', name : 'node_index', width : 5, sortable : false, align: 'left'},
		{title: '结点类型', name : 'node_type', width : 5, sortable : false, align: 'left'},
		{title: '流程初始函数', name : 'init_function', width : 5, sortable : false, align: 'left'},
		{title: '流程运行函数', name : 'run_function', width : 5, sortable : false, align: 'left'},
		{title: '流程保存函数', name : 'save_function', width : 5, sortable : false, align: 'left'},
		{title: '流程流转函数', name : 'transit_function', width : 5, sortable : false, align: 'left'},
		{title: '前结点序号', name : 'prev_node_index', width : 5, sortable : false, align: 'left'},
		{title: '后结点序号', name : 'next_node_index', width : 5, sortable : false, align: 'left'},
		{title: '执行角色，组，人', name : 'executor', width : 5, sortable : false, align: 'left'},
		{title: '执行类型', name : 'execute_type', width : 5, sortable : false, align: 'left'},
		{title: '提醒', name : 'remind', width : 5, sortable : false, align: 'left'},
		{title: '可编辑的字段', name : 'field', width : 5, sortable : false, align: 'left'},
		{title: '最长时间', name : 'max_day', width : 5, sortable : false, align: 'left'},
		{title: '状态', name : 'status', width : 5, sortable : false, align: 'left'}
];
		    


//AJAX示例
var mmg =  $(this.gridId).mmGrid({
    cols: cols,
    url: self.searchUrl,
    method: 'post',
    remoteSort:true ,
    sortName: 'SECUCODE',
    sortStatus: 'asc',
    root: 'items',
    fullWidthRows:true,
    params:function(){
		var params=self.buildParam(self.gridSearchBarId);
    	return params;
	},
    plugins : [
        $(self.pageBarId).mmPaginator({limitList: [1,2,3,4]})
    ],
    checkCol:true,
    indexCol:true,
    multiSelect:true

});

this.grid=mmg;
		
}
};



var wfNode=new WfNode();


$(document).ready(function(){
	
	wfNode.init();
	
	$('#addBtn').click(function(){
		wfNode.addEntrance();
	});
	
	$('#editBtn').click(function(){
		wfNode.editEntrance();
	});
	$('#delBtn').click(function(){
		wfNode.delEntrance();
	});
	$('#searchBtn').click(function(){
		wfNode.searchEntrance();
	});
});

