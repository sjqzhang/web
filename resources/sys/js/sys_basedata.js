

function SysBasedata(){
    that=this;
    if(location.href.indexOf('sys_basedata')>=0){
        this.baseUrl='';
    } else {
        this.baseUrl='index.php/sys_basedata/';
    }
    BaseGrid.call(this,SysBasedata.prototype);
    

}

 

SysBasedata.prototype={
        init:function(){
    
        var self=this;
    
            var cols = [
                
	//{title: '编号', name : 'id', width : 16, sortable : false, align: 'left'},
		{title: '名称', name : 'name', width : 5, sortable : false, align: 'left'},
		{title: '父类', name : 'name2', width : 5, sortable : false, align: 'left',renderer:function(v){
	

			if(v==''|v==null){
				return '无'
			} else {
				return v;
			}

	}},
		{title: '变量编码 ', name : 'code', width : 10, sortable : false, align: 'left'},
		{title: '参数值', name : 'value', width : 80, sortable : false, align: 'left'},
		
			{title: '排序码', name : 'sort', width : 6, sortable : false, align: 'left'}
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
        
},initCtrl:function(type){
var self=this;
   var cbxOptions=
			    {
			        url:'index.php/sys_basedata/get_parent_list',
			        selector:"#pid",
					before:function(opt,data){
					//console.log(data);
					  data.unshift({'value':-1,text:'新建分类'});
					  return data;
					},
					after:function(op,data){
						if(type==1) {
							self.getSelected(function(row){
								self.bind(self.dialogPannelId,row[0]);
							});
						}
					}
			    }//end cbxOptions
			 self.combox(cbxOptions);
}
};




//ztree




		var setting = {
			async: {
				enable: true,
				url:"index.php/sys_basedata/get_basedata_for_ztree",
				autoParam:["id", "name=n", "level=lv"],
				otherParam:{"otherParam":"zTreeAsyncTest"},
				dataFilter: filter
			}
		};

		function filter(treeId, parentNode, childNodes) {
			if (!childNodes) return null;
			for (var i=0, l=childNodes.length; i<l; i++) {
				childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
			}
			return childNodes;
		}


/*
var setting = {
			view: {
				dblClickExpand: false
			},
			data: {
				simpleData: {
					enable: true
				}
			},
			callback: {
				beforeClick: beforeClick,
				onClick: onClick
			}
		};

		var zNodes =[
			{id:1, pId:0, name:"北京"},
			{id:2, pId:0, name:"天津"},
			{id:3, pId:0, name:"上海"},
			{id:6, pId:0, name:"重庆"},
			{id:4, pId:0, name:"河北省", open:true},
			{id:41, pId:4, name:"石家庄"},
			{id:42, pId:4, name:"保定"},
			{id:43, pId:4, name:"邯郸"},
			{id:44, pId:4, name:"承德"},
			{id:5, pId:0, name:"广东省", open:true},
			{id:51, pId:5, name:"广州"},
			{id:52, pId:5, name:"深圳"},
			{id:53, pId:5, name:"东莞"},
			{id:54, pId:5, name:"佛山"},
			{id:6, pId:0, name:"福建省", open:true},
			{id:61, pId:6, name:"福州"},
			{id:62, pId:6, name:"厦门"},
			{id:63, pId:6, name:"泉州"},
			{id:64, pId:6, name:"三明"}
		 ];

		 */

		function beforeClick(treeId, treeNode) {
			var check = (treeNode && !treeNode.isParent);
			if (!check) alert("只能选择城市...");
			return check;
		}
		
		function onClick(e, treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
			nodes = zTree.getSelectedNodes(),
			v = "";
			nodes.sort(function compare(a,b){return a.id-b.id;});
			for (var i=0, l=nodes.length; i<l; i++) {
				v += nodes[i].name + ",";
			}
			if (v.length > 0 ) v = v.substring(0, v.length-1);
			var cityObj = $("#citySel");
			cityObj.attr("value", v);
		}

		function showMenu() {
			//debugger;
			var cityObj = $("#citySel");
			var cityOffset = $("#citySel").offset();
			$("#menuContent").css({left:cityOffset.left -200+ "px", top:cityOffset.top-60 + "px",'z-index':5000}).slideDown("fast");
			$("#menuContent").show();
			

			$("body").bind("mousedown", onBodyDown);
		}
		function hideMenu() {
			$("#menuContent").fadeOut("fast");
			$("body").unbind("mousedown", onBodyDown);
		}
		function onBodyDown(event) {
			if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length>0)) {
				hideMenu();
			}
		}





var sysBasedata=new SysBasedata();


$(document).ready(function(){
    
    sysBasedata.init();

	$.fn.zTree.init($("#treeDemo"), setting);
    
    $('#addBtn').click(function(){
        sysBasedata.addEntrance();
    });
    
    $('#editBtn').click(function(){
        sysBasedata.editEntrance();
    });
    $('#delBtn').click(function(){
        sysBasedata.delEntrance();
    });
    $('#searchBtn').click(function(){
        sysBasedata.searchEntrance();
		return false;
    });
});


