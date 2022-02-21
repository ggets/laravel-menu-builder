# Laravel Drag and Drop menu editor like wordpress

### *This package was forked from a previously abandoned one: It will take some time to fix support for laravel 9+ and the rest of the issues. Please be patient if you are in a search for a working version of the menu builder. Thank you!

[![Latest Stable Version](https://poser.pugx.org/ggets/laravel-menu-builder/v/stable)](https://packagist.org/packages/ggets/laravel-menu-builder) [![Latest Unstable Version](https://poser.pugx.org/ggets/laravel-menu-builder/v/unstable)](https://packagist.org/packages/ggets/laravel-menu-builder) [![Total Downloads](https://poser.pugx.org/ggets/laravel-menu-builder/downloads)](https://packagist.org/packages/ggets/laravel-menu-builder) [![Monthly Downloads](https://poser.pugx.org/ggets/laravel-menu-builder/d/monthly)](https://packagist.org/packages/ggets/laravel-menu-builder)

forked from https://github.com/lordmacu/wmenu
![Laravel drag and drop menu](https://raw.githubusercontent.com/ggets/wmenu-builder/master/screenshot.png)

### Installation

0. Prerequisites

0.1. jQuery

0.2. jQueryUI (with plugins)

0.3. Bootstrap

0.4. Fontawesome


To install dependencies via npm, run:
```bash
npm i jquery@3.6
npm i jquery-ui@1.13
npm i bootstrap@4.6
```

You are responsible for your own copy of FontAwesome.


Then in your laravel Mix config (*resources/js/app.js*)

```php
// resources/js/app.js
//
// jQuery
window.$=window.jQuery=require('jquery');
require('jquery-ui/ui/widget.js');
require('jquery-ui/ui/widgets/mouse.js');
require('jquery-ui/ui/widgets/sortable.js');
require('jquery-ui/ui/widgets/draggable.js');
require('jquery-ui/ui/widgets/droppable.js');
// Bootstrap
require('bootstrap');
```

Then, to compile your mix, run:
```bash
npm run dev
```

1. Run

```bash
composer require ggets/laravel-menu-builder
```

**_Step 2 & 3 are optional if you are using laravel 5.5_**

2. Add the following class, to "providers" array in the file config/app.php (optional on laravel 5.5)

```php
ggets\MenuBuilder\MenuServiceProvider::class,
```

3. add facade in the file config/app.php (optional on laravel 5.5)

```php
'Menu' => ggets\MenuBuilder\Facades\Menu::class,
```

4. Run publish

```php
php artisan vendor:publish --provider="ggets\MenuBuilder\MenuServiceProvider"
```

5. Configure (optional) in **_config/menu.php_** :

- **_CUSTOM MIDDLEWARE:_** You can add you own middleware
- **_TABLE PREFIX:_** By default this package will create 2 new tables named "menus" and "menu_items" but you can still add your own table prefix avoiding conflict with existing table
- **_TABLE NAMES_** If you want use specific name of tables you have to modify that and the migrations
- **_Custom routes_** If you want to edit the route path you can edit the field
- **_Role Access_** If you want to enable roles (permissions) on menu items

6. Run migrate

```php
php artisan migrate
```

DONE

### Menu Builder Usage Example - displays the builder

On your view blade file

```php
@extends('app')

@section('contents')
    {!! Menu::render() !!}
@endsection

//YOU MUST HAVE JQUERY LOADED BEFORE menu scripts
@push('scripts')
    {!! Menu::scripts() !!}
@endpush
```

### Using The Model

Call the model class

```php
use ggets\MenuBuilder\Models\Menus;
use ggets\MenuBuilder\Models\MenuItems;

```

### Menu Usage Example (a)

A basic two-level menu can be displayed in your blade template

##### Using Model Class
```php

/* get menu by id*/
$menu = Menus::find(1);
/* or by name */
$menu = Menus::where('name','Test Menu')->first();

/* or get menu by name and the items with EAGER LOADING (RECOMENDED for better performance and less query call)*/
$menu = Menus::where('name','Test Menu')->with('items')->first();
/*or by id */
$menu = Menus::where('id', 1)->with('items')->first();

//you can access by model result
$public_menu = $menu->items;

//or you can convert it to array
$public_menu = $menu->items->toArray();

```

##### or Using helper
```php
// Using Helper 
$public_menu = Menu::getByName('Public'); //return array

```

### Menu Usage Example (b)

Now inside your blade template file place the menu using this simple example

```php
<div class="nav-wrap">
    <div class="btn-menu">
        <span></span>
    </div><!-- //mobile menu button -->
    <nav id="mainnav" class="mainnav">

        @if($public_menu)
        <ul class="menu">
            @foreach($public_menu as $menu)
            <li class="">
                <a href="{{ $menu['link'] }}" title="">{{ $menu['label'] }}</a>
                @if( $menu['child'] )
                <ul class="sub-menu">
                    @foreach( $menu['child'] as $child )
                        <li class=""><a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a></li>
                    @endforeach
                </ul><!-- /.sub-menu -->
                @endif
            </li>
            @endforeach
        @endif

        </ul><!-- /.menu -->
    </nav><!-- /#mainnav -->
 </div><!-- /.nav-wrap -->
```

### HELPERS

### Get Menu Items By Menu ID

```php
use ggets\MenuBuilder\Facades\Menu;
...
/*
Parameter: Menu ID
Return: Array
*/
$menuList = Menu::get(1);
```

### Get Menu Items By Menu Name

In this example, you must have a menu named _Admin_

```php
use ggets\MenuBuilder\Facades\Menu;
...
/*
Parameter: Menu ID
Return: Array
*/
$menuList = Menu::getByName('Admin');
```

### Customization

you can edit the menu interface in **_resources/views/vendor/ggets-menu-builder/menu-html.blade.php_**

### Credits

- [wmenu](https://github.com/lordmacu/wmenu) laravel package menu like wordpress

### Compatibility

- Tested with laravel 5.2, 5.3, 5.4, 5.5, 5.6, 5.7, 5.8, 6.x, 7.x, 8.x, 9.x

### KNOWN ISSUES
- Not working with RTL websites [#21](https://github.com/harimayco/wmenu-builder/issues/21) (pull requests are welcome)
