<?php
namespace ggets\MenuBuilder\Facades;
use Illuminate\Support\Facades\Facade;
class Menu extends Facade{
	/**
	 * Return facade accessor
	 * @return string
	 */
	protected static function getFacadeAccessor(){
		return 'ggets-menu-builder';
	}
}