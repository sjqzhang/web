function ec_build_ops(option,data,selector){
				if(typeof(data)=='string'){
					data=eval('('+data+')');
				}
              if(!option['yAxis']){
				  option['yAxis']=[{'type':'value'}]
			  }
			  if(!option['legend']){
				  option['legend']={'data':[]}
			  }
			  if(!option['series']){
				  option['series']=[]
			  }
			  if(!option['tooltip']){
					 option['tooltip']={'show':true}
			  }
			  if(!option['xAxis']){
				  option['xAxis']=[{'type':'category'}]
			  }	
		
			  for(var i in	data['xAxis']){
			    var ops= data['xAxis'][i];
				if(!option['xAxis'][i]){
					option['xAxis'][i]={}
				}
		
				option['xAxis'][i]['data']=data[ops.data];
			  }
			  var legend=[];
			  for(var i in	data['series']){
			    var ops= data['series'][i];
				if(!option['series'][i]){
					option['series'][i]={};
				}
				option['series'][i]['type']=ops.type;
				option['series'][i]['name']=ops.name;
				if(!data[ops.data]){
					$(selector).html('<h3 style="text-align:center;">无数据</h3>');
					return;
				}
				option['series'][i]['data']=data[ops.data];
				legend.push(ops.name);
			  }
			  if(data['title']){
				option['title']=data['title'];
			  }
			  if(!data['legend']){
				 option['legend']['data']=legend;
			  } else {
				 option['legend']['data']=data['legend'];
			  }

			  return option;
}

function ec_pie_ops(option,data,selector){

	if(typeof(data)=='string'){
			data=eval('('+data+')');
		}
	  
	  if(!option['legend']){
		  option['legend']={'data':[]}
	  }
	  if(!option['series']){
		  option['series']=[]
		  option['series'][0]={};
		  option['series'][0]['type']='pie';

	  }
	  if(!option['tooltip']){
			 option['tooltip']={'show':true}
	  }

	  if(data['series']){
		 if(data['series'][0].length==0){
			$(selector).html('<h3 style="text-align:center;">无数据</h3>');
			return;
		 }
	     option['series'][0]=data['series'][0];
		 for(var i in data['series'][0]['data']){
			option['legend']['data'].push(data['series'][0]['data'][i]['name']);
		 }
	  }
	 

	 // var legend=[];

	 console.log(option);
	 

			  return option;

}

function js2tb(json){
	if(typeof(json)=='string'){
		json=eval('('+json+')');
	}
	if(json.reply){
		json=json.reply;
	}
	var head='<tr>';
	var body='';
	for(var name in json[0]){
			head+='<th>'+name+'</th>';
	} 
	head+='</tr>';
	for(var i=0;i<json.length;i++){
		body+='<tr>';
		for(var name in json[i]){
			body+='<td>'+json[i][name]+'</td>';
		}
		body+='</tr>';
	}
	return '<table border="1px">'+head+body+'</table>';
}


function EcUtil(){
	
    BaseGrid.call(this,EcUtil.prototype);
}



var ecutil=new EcUtil();