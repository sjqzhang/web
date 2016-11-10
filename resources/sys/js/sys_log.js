

function SysLog(){
    that=this;
    if(location.href.indexOf('sys_log')>=0){
        this.baseUrl='';
    } else {
        this.baseUrl='index.php/sys_log/';
    }
    BaseGrid.call(this,SysLog.prototype);
    

}

 

SysLog.prototype={
        init:function(){
    
        var self=this;
    
            var cols = [
                
	{title: '编号', name : 'id', width : 10, sortable : false, align: 'left'},
		{title: '路径', name : 'url', width : 120, sortable : false, align: 'left',renderer:this.rendertitle},
		{title: '参数', name : 'params', width : 500, sortable : false, align: 'left',renderer:this.rendertitle},
		//{title: '编码', name : 'error_code', width : 11, sortable : false, align: 'left'},
		{title: '信息', name : 'error_message', width : 100, sortable : false, align: 'left',renderer:this.rendertitle},
		{title: '用户IP', name : 'ip', width : 100, sortable : false, align: 'left'},
		{title: '用户编号', name : 'admin_id', width : 50, sortable : false, align: 'left'},
		{title: '时间', name : 'time', width : 100, sortable : false, align: 'left',renderer:this.rendertime}
		//,{title: '执行的sql', name : 'query', width : 11, sortable : false, align: 'left',renderer:this.rendertitle}
];
            


//AJAX示例
var mmg =  $(this.gridId).mmGrid({
    cols: cols,
    fullWidthRows:true,
	height:window.screen.height -450,
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
        $(self.pageBarId).mmPaginator()
    ],
  //  checkCol:true,
   // indexCol:true,
  //  multiSelect:true,
		nowrap:true

});

this.grid=mmg;
        
},
	rendertime:function(val){


		return sysLog.date('Y-m-d H:i:s',val);

	},
	rendertitle:function(val){

		return "<span title='"+ val+"'>"+val+'</span>';
	}
};



var sysLog=new SysLog();


$(document).ready(function(){
    
    sysLog.init();
    
    $('#addBtn').click(function(){
        sysLog.addEntrance();
    });
    
    $('#editBtn').click(function(){
        sysLog.editEntrance();
    });
    $('#delBtn').click(function(){
        sysLog.delEntrance();
    });
	/*
	$('#exportBtn').click(function(){
        sysLog.export();
		return false;
    });
	*/
    $('#searchBtn').click(function(){
        sysLog.searchEntrance();
		return false;
    });
});


