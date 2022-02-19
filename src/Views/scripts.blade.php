<script type="text/javascript">
// =========== Laravel Framework Object for storing everything that
// =========== is used globally in a structured place.
window.LFWO=(window.LFWO||{});
// ----------- Routes:
window.LFWO.routes=(window.LFWO.routes||{});
window.LFWO.routes.menu_builder=(window.LFWO.routes.menu_builder||{});
window.LFWO.routes.menu_builder.create_item=("{{route("menu-builder-create-item")}}");
window.LFWO.routes.menu_builder.update_item=("{{route("menu-builder-update-item")}}");
window.LFWO.routes.menu_builder.delete_item=("{{route("menu-builder-update-item")}}");
window.LFWO.routes.menu_builder.create_menu=("{{route("menu-builder-create-menu")}}");
window.LFWO.routes.menu_builder.update_menu=("{{route("menu-builder-update-menu")}}");
window.LFWO.routes.menu_builder.delete_menu=("{{route("menu-builder-delete-menu")}}");
// ----------- Strings:
window.LFWO.strings=(window.LFWO.strings||{});
window.LFWO.strings.menu_builder=(window.LFWO.strings.menu_builder||{});
window.LFWO.strings.menu_builder.oneThemeLocationNoMenus=("<oneThemeLocationNoMenus>");
window.LFWO.strings.menu_builder.moveUp=("Move up");
window.LFWO.strings.menu_builder.moveDown=("Mover down");
window.LFWO.strings.menu_builder.moveToTop=("Move top");
window.LFWO.strings.menu_builder.moveUnder=("Move into %s");
window.LFWO.strings.menu_builder.moveOutOf=("Out of %s");
window.LFWO.strings.menu_builder.under=("Under %s");
window.LFWO.strings.menu_builder.menuFocus=("%1$s. Element menu %2$d of %3$d.");
window.LFWO.strings.menu_builder.subMenuFocus=("%1$s. Menu of subelement %2$d of %3$s.");
// ----------- Menu Builder:
window.LFWO.menu_builder=(window.LFWO.menu_builder||{});
window.LFWO.menu_builder.arraydata=(window.LFWO.menu_builder.arraydata||[]);
window.LFWO.menu_builder.menuwr=("{{url()->current()}}");
// ----------- CSRF:
window.LFWO.csrf=(window.LFWO.csrf||{});
window.LFWO.csrf.token=("{{csrf_token()}}");
// =========== End Laravel Framework Object
$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN':window.LFWO.csrf.token
	}
});
</script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu-builder/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu-builder/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu-builder/menu.js')}}"></script>
