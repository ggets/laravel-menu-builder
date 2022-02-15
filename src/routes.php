<?php
Route::group(['middleware'=>config('menu.middleware')],function(){
	$path=rtrim(config('menu.route_path'));
	Route::post("{$path}/create-menu",array("as"=>("menu-builder-create-menu"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@createMenu")));
	Route::post("{$path}/update-menu",array("as"=>("menu-builder-update-menu"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@updateMenu")));
	Route::post("{$path}/delete-menu",array("as"=>("menu-builder-delete-menu"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@deleteMenu")));
	Route::post("{$path}/create-item",array("as"=>("menu-builder-create-item"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@createItem")));
	Route::post("{$path}/update-item",array("as"=>("menu-builder-update-item"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@updateItem")));
	Route::post("{$path}/delete-item",array("as"=>("menu-builder-delete-item"),"uses"=>("\ggets\MenuBuilder\Controllers\MenuController@deleteItem")));
});
