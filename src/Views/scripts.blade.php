<script type="text/javascript">
let	menus={
			"oneThemeLocationNoMenus":(""),
			"moveUp":("Move up"),
			"moveDown":("Mover down"),
			"moveToTop":("Move top"),
			"moveUnder":("Move under of %s"),
			"moveOutFrom":("Out from under  %s"),
			"under":("Under %s"),
			"outFrom":("Out from %s"),
			"menuFocus":("%1$s. Element menu %2$d of %3$d."),
			"subMenuFocus":("%1$s. Menu of subelement %2$d of %3$s.")
		},
		arraydata=[];
		window.LFWO=(window.LFWO||{});
		window.LFWO.routes=(window.LFWO.routes||{});
		window.LFWO.routes.menu_builder=(window.LFWO.routes.menu_builder||{});
		window.LFWO.routes.menu_builder.create_item=("{{route("menu-builder-create-item")}}");
		window.LFWO.routes.menu_builder.update_item=("{{route("menu-builder-update-item")}}");
		window.LFWO.routes.menu_builder.delete_item=("{{route("menu-builder-update-item")}}");
		window.LFWO.routes.menu_builder.create_menu=("{{route("menu-builder-create-menu")}}");
		window.LFWO.routes.menu_builder.update_menu=("{{route("menu-builder-update-menu")}}");
		window.LFWO.routes.menu_builder.delete_menu=("{{route("menu-builder-delete-menu")}}");
		csrftoken="{{csrf_token()}}";
		menuwr="{{url()->current()}}";
$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN':csrftoken
	}
});
</script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/ggets-menu/menu.js')}}"></script>
