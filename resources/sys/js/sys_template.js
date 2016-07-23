

function SysTemplate(){
    that=this;
    if(location.href.indexOf('re_report_template')>=0){
        this.baseUrl='';
    } else {
        this.baseUrl='index.php/sys_template/';
    }
    BaseGrid.call(this,SysTemplate.prototype);
    

}

 

SysTemplate.prototype={
        init:function(){
    
        var self=this;
    
            var cols = [
                
	{title: 'id', name : 'id', width : 14, sortable : false, align: 'left'},
		{title: '名称', name : 'name', width : 14, sortable : false, align: 'left'}
	/*,
		{title: '数据库', name : 'db', width : 14, sortable : false, align: 'left'},
		{title: '控制器', name : 'ctrl', width : 14, sortable : false, align: 'left'},
		{title: '模型', name : 'model', width : 14, sortable : false, align: 'left'},
		{title: '视图', name : 'views', width : 14, sortable : false, align: 'left'},
		{title: 'JS', name : 'js', width : 14, sortable : false, align: 'left'}
		*/
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
        $(self.pageBarId).mmPaginator()
    ],
    checkCol:true,
    indexCol:true,
    multiSelect:true

});

this.grid=mmg;
        
},initCtrl:function(){

  var self=this;

  for(var i in self._editor){
	self._editor[i].refresh()
  }

}
};



var sysTemplate=new SysTemplate();


$(document).ready(function(){
    
    sysTemplate.init();
    
    $('#addBtn').click(function(){
        sysTemplate.addEntrance();
    });
    
    $('#editBtn').click(function(){
        sysTemplate.editEntrance();
    });
    $('#delBtn').click(function(){
        sysTemplate.delEntrance();
    });
    $('#searchBtn').click(function(){
        sysTemplate.searchEntrance();
		return false;
    });
});


