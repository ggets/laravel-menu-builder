window.LFWO=(window.LFWO||{});
window.LFWO.menu_builder=(window.LFWO.menu_builder||{});
window.LFWO.menu_builder.arraydata=(window.LFWO.menu_builder.arraydata||[]);
function getMenu(){
	window.LFWO.menu_builder.arraydata=[];
	$('#spinsavemenu').show();
	var cont=0;
	$('#menu-to-edit li').each(function(index){
		var dept=0;
		for(var i=0;(i<$('#menu-to-edit li').length);i++){
			var n=$(this).attr('class').indexOf('menu-item-depth-'+i);
			if(n!=-1)dept=i;
		}
		var textoiner=$(this).find('.item-edit').text();
		var id=this.id.split('-');
		var textoexplotado=textoiner.split('|');
		var padre=0;
		if(!!textoexplotado[textoexplotado.length-2] &&
			textoexplotado[textoexplotado.length-2] !=id[2]){
			padre=textoexplotado[textoexplotado.length-2];
		}
		window.LFWO.menu_builder.arraydata.push({
			depth:dept,
			id:id[2],
			parent:padre,
			sort:cont
		});
		cont++;
	});
	updateItem();
	updateMenu();
}
function createItem(){
	$('#spincustomu').show();
	$.ajax({
		data:{
		labelmenu:$('#custom-menu-item-name').val(),
			linkmenu:$('#custom-menu-item-url').val(),
			rolemenu:$('#custom-menu-item-role').val(),
			idmenu:$('#idmenu').val()},
		url:route_menu_builder_create_item,
		type:'POST',
		success:function(response){
			window.location.reload();
		},
		complete:function(){
			$('#spincustomu').hide();
		}
	});
}
function updateItem(id=0){
	if(id){
	var label=$('#idlabelmenu_'+id).val();
		var clases=$('#clases_menu_'+id).val();
		var url=$('#url_menu_'+id).val();
		var role_id=0;
		if($('#role_menu_'+id).length){
			role_id=$('#role_menu_'+id).val();
		}
		var data={
			label:label,
			clases:clases,
			url:url,
			role_id:role_id,
			id:id
		};
	}
	else{
		var arr_data=[];
		$('.menu-item-settings').each(function(k, v){
			var id=$(this).find('.edit-menu-item-id').val();
			var label=$(this).find('.edit-menu-item-title').val();
			var clases=$(this).find('.edit-menu-item-classes').val();
			var url=$(this).find('.edit-menu-item-url').val();
			var role=$(this).find('.edit-menu-item-role').val();
			arr_data.push({
				id:id,
				label:label,
				class:clases,
				link:url,
				role_id:role
			});
		});
		var data={
			arraydata:arr_data };
	}
	$.ajax({
		data:data,
		url:route_menu_builder_update_item,
		type:'POST',
		beforeSend:function(xhr){
			if(id){
			$('#spincustomu2').show();
			}
		},
		success:function(response){
		},
		complete:function(){
			if(id){
			$('#spincustomu2').hide();
			}
		}
	});
}
function deleteItem(id){
	$.ajax({
	dataType:'json',
		data:{
			id:id
		},
		url:route_menu_builder_delete_item,
		type:'POST',
		success:function(response){
		}
	});
}
function createMenu(){
	if(!!$('#menu-name').val()){
	$.ajax({
	dataType:'json',
			data:{
				menuname:$('#menu-name').val()},
			url:route_menu_builder_create_menu,
			type:'POST',
			success:function(response){
				window.location=(window.LFWO.csrf.token+'?menu='+response.resp);
			}
		});
	}
	else{
		alert('Enter menu name!');
		$('#menu-name').focus();
		return false;
	}
}
function updateMenu(){
	$.ajax({
	dataType:'json',
		data:{
			arraydata:window.LFWO.menu_builder.arraydata,
			menuname:$('#menu-name').val(),
			idmenu:$('#idmenu').val()},
		url:route_menu_builder_update_menu,
		type:'POST',
		beforeSend:function(xhr){
			$('#spincustomu2').show();
		},
		success:function(response){
		},
		complete:function(){
			$('#spincustomu2').hide();
		},
		statusCode:{
			200:function(){
			console.log('saved.');
			},
			500:function(){
				alert("Script exhausted");
			}
		}
	}).done(function(data){
		// success function
		}).always(function(jqXHR){
			console.log(jqXHR);
				if(jqXHR.status==500 || jqXHR.status==0){
					// internal server error or internet connection broke
				}
		});
}
function deleteMenu(){
	var r=confirm('Do you want to delete this menu ?');
	if(r==true){
		$.ajax({
		dataType:'json',
			data:{
				id:$('#idmenu').val()},
			url:route_menu_builder_delete_menu,
			type:'POST',
			beforeSend:function(xhr){
				$('#spincustomu2').show();
			},
			success:function(response){
				if(!response.error){
				alert(response.resp);
					window.location=window.LFWO.menu_builder.menuwr;
				}
				else{
					alert(response.resp);
				}
			},
			complete:function(){
				$('#spincustomu2').hide();
			}
		});
	}
	else{
		return false;
	}
}
function insertParam(key, value){
	key=encodeURI(key);
	value=encodeURI(value);
	var kvp=document.location.search.substr(1).split('&');
	var i=kvp.length;
	var x;
	while(i--){
		x=kvp[i].split('=');
		if(x[0]==key){
			x[1]=value;
			kvp[i]=x.join('=');
			break;
		}
	}
	if(i < 0){
		kvp[kvp.length]=[key, value].join('=');
	}
	//this will reload the page, it's likely better to store this until finished
	document.location.search=kvp.join('&');
}
wpNavMenu.registerChange=function(){
	getmenus();
};
