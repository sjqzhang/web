

function SysForm(){
    that=this;
    if(location.href.indexOf('re_report')>=0){
        this.baseUrl='';
    } else {
        this.baseUrl='index.php/sys_form/';
    }
    BaseGrid.call(this,SysForm.prototype);
    

}

 

SysForm.prototype={
        init:function(){
    
        var self=this;
    
            var cols = [
                
	{title: 'id', name : 'id', width : 12, sortable : false, align: 'left'},
		{title: '名称', name : 'name', width : 12, sortable : false, align: 'left'},
		{title: '文件名', name : 'file_name', width : 12, sortable : false, align: 'left'}
	/*,
		{title: '数据库', name : 'db', width : 12, sortable : false, align: 'left'},
		{title: '控制器', name : 'ctrl', width : 12, sortable : false, align: 'left'},
		{title: '模型', name : 'model', width : 12, sortable : false, align: 'left'},
		{title: '视图', name : 'views', width : 12, sortable : false, align: 'left'},
		{title: '视图控制器', name : 'js', width : 12, sortable : false, align: 'left'}
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
        
},

	tmpSave:function(){
		var self=this;
		var bean =self.buildParam(self.formPannelId); 
		self.updateAction(bean, function(flag,msg){
					
		}); 

	},


	addAction : function(bean, callback) {
    var self=this;

	 $.post('index.php/sys_form/check_report',{file_name:$('#file_name').val()},function(data){
		data=self.data(data);
		
          	if(data.reply==0){
				$.post(self.addUrl, bean, function(data) {
							data=self.toJSON(data);
							callback(data.reply,data.message);
				}); 
			} else {
				self.myAlert(1,'已存在，不可增加');
			}
			
	  });



	},
	

	initCtrl:function(type){
		var self=this;
		
		if(type==0) {
			$('#btnBuildReport').click(function(){
				self.buildReport();
			});
		} else {
			$('#file_name').attr('readonly','readonly');
			$('#btnBuildReport,#tpl,#btnLoadReport').hide();
			$('.bootstrap-dialog-footer-buttons').append('<button class="btn btn-lg btn-sm btn-info" id="btnSave">保存不关闭</button>');
			$('#btnSave,.tmpSave').click(function(){
				self.tmpSave();
			});

		}

		$('#btnLoadReport').click(function(){
		
		  self.loadReport();
		
		});

		 var cbxOptions=
			    {
			        url:'index.php/sys_open/get_sys_template_combox',
			        selector:"#tpl",/*
                  	before:function(op,data){
                      return data.unshift({value:'all',text:'所有'})	
                    },*/
					after:function(op,data){
						
					}
			    }//end cbxOptions
		 self.combox(cbxOptions);


	},

	loadReport:function(){
	  var self=this;	
	  $.post('index.php/sys_form/load_report',{file_name:$('#file_name').val()},function(data){
            data=eval('('+data+')').reply;
			self._editor['ctrl'].setValue(data['ctrl']);
			self._editor['model'].setValue(data['model']);
			self._editor['views'].setValue(data['views']);
			self._editor['js'].setValue(data['js']);
	  })
	
	},

	
	buildReport:function(){
	  
	  var self=this;
	  var filename=$.trim( $('#file_name').val());

	  $.post('index.php/sys_open/get_sys_template',{id:$('#tpl').val()},function(data){
	  
		data= self.data(data);

		var tpl=data.reply[0];



		String.prototype.className = function(){
		var re=/_(\w)/g;
		var str= this.replace(re,function(){
		var args=arguments;
		   return arguments[1].toUpperCase();
		})
		return str.replace(/^\w/,function(){
		  return arguments[0].toUpperCase();
		})
		};
		
		String.prototype.instanceName = function(){
		var re=/_(\w)/g;
		return this.replace(re,function(){
		var args=arguments;
		   return arguments[1].toUpperCase();
		})
		};



		var codes=['ctrl','model','js','views'];
		var filename=$('#file_name').val();
		var instanceName= filename.instanceName();
		var className= filename.className();
		$('#db').val(tpl['db']);

		for(var key in codes){
		
		    var tmp= tpl[codes[key]];
			tmp=tmp.replace(/\{\{filename\}\}/ig,filename,tmp);
			tmp=tmp.replace(/\{\{db\}\}/ig,tpl['db'],tmp);
			tmp=tmp.replace(/\{\{instanceName\}\}/ig,instanceName,tmp);
			tmp=tmp.replace(/\{\{className\}\}/ig,className,tmp);
			self._editor[codes[key]].setValue(tmp);
		}


			
	  
	  });


 
	}
};



var sysForm=new SysForm();


$(document).ready(function(){
    
    sysForm.init();
    
    $('#addBtn').click(function(){
        sysForm.addEntrance();
    });
    
    $('#editBtn').click(function(){
        sysForm.editEntrance();
    });
    $('#delBtn').click(function(){
        sysForm.delEntrance();
    });
    $('#searchBtn').click(function(){
        sysForm.searchEntrance();
		return false;
    });


});


