<?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="{{asset('vendor/ggets-menu-builder/style.css')}}" rel="stylesheet">
<link href="{{asset('vendor/ggets-menu-builder/floating-labels.css')}}" rel="stylesheet">
<div id="hwpwrap">
	<div class="custom-wp-admin wp-admin wp-core-ui js   menu-max-depth-0 nav-menus-php auto-fold admin-bar">
		<div id="wpwrap">
			<div id="wpcontent">
				<div id="wpbody">
					<div id="wpbody-content">

						<div class="wrap">

							<div class="manage-menus">
								<form method="get" action="{{ $currentUrl }}">
									<label for="menu" class="selected-menu"></label>

									{!! Menu::select('menu', $menulist) !!}

									<span class="submit-btn">
										<input type="submit" class="button-secondary" value="Choose">
									</span>
								</form>
							</div>
							<div id="nav-menus-frame">
								<div id="menu-management-liquid">
									<div id="menu-management">
										<form id="update-nav-menu" action="" method="post" enctype="multipart/form-data">
											@csrf
											<div class="menu-edit ">
												<div id="nav-menu-header">
													<div class="major-publishing-actions">
														<div class="row">
															<div id="menu-name-wrap" class="col-10 mb-0 mt-1 form-label-group">
																<input id="menu-name" name="menu-name" type="text" class="form-control amenu-name regular-text menu-item-textbox" placeholder="Name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
																<label for="menu-name">Name</label>
																<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
															</div>
															<div class="col-2 publishing-action">
																@if(request()->has('menu')&&request()->input('menu')!=='0')
																	<a onclick="getMenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save"><spinner class="spinner mr-2" id="spincustomu2"></spinner>Save</a>
																@else
																	<a onclick="createMenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save">Create</a>
																@endif
															</div>
														</div>
													</div>
												</div>
												<div id="post-body">
													<div id="post-body-content">

														@if(request()->has("menu"))
														<h3>Menu Structure</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Place each item in the order you prefer. Click on the arrow to the right of the item to display more configuration options.
															</p>
														</div>

														@if(request()->has('menu')  && !empty(request()->input("menu")))
														<div id="menu-settings-column" class="metabox-holder">

															<div class="clear"></div>

															<form id="nav-menu-meta" action="" class="nav-menu-meta" method="post" enctype="multipart/form-data">
																@csrf
																<div id="side-sortables" class="accordion-container">
																	<ul class="outer-border">
																		<li class="control-section accordion-section add-page" id="add-page">
																			<h3 class="accordion-section-title hndle" tabindex="0"> Add Menu Item <span class="screen-reader-text">Press return or enter to expand</span></h3>
																			<div class="accordion-section-content" style="display: none;">
																				<div class="inside">
																					<div class="customlinkdiv" id="customlinkdiv">


																						<div class="row">
																							<div class="col-11">
																								<div class="row">
																									<div id="menu-item-name-wrap" class="col-6 form-label-group">
																										<input id="menu-item-name" name="label" type="text" class="form-control regular-text menu-item-textbox" placeholder="Label">
																										<label for="menu-item-name">Label</label>
																									</div>
																									<div id="menu-item-url-wrap" class="col-6 form-label-group">
																										<input id="menu-item-url" name="url" type="text" class="form-control menu-item-textbox" placeholder="URL">
																										<label for="menu-item-url">URL</label>
																									</div>
																								</div>
																							</div>
																							<div class="col-1">
																								<div class="row">
																									<div class="col-12 form-label-group">
																										<a  href="#" onclick="createItem()" class="btn btn-info submit-add-to-menu right"><span class="spinner" id="spincustomu"></span>Add</a>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-11">
																								<div class="row">
																									<div id="menu-item-class-wrap" class="col-6 form-label-group">
																										<input id="menu-item-class" name="class" type="text" class="form-control menu-item-textbox" placeholder="Classes (CSS) (optional)">
																										<label for="menu-item-class">Classes (CSS) (optional)</label>
																									</div>
																									@if(!empty($roles))
																									<div id="menu-item-role_id-wrap" class="col-6 form-label-group">
																										<select id="menu-item-role" name="role">
																											<option value="0">Select Role</option>
																											@foreach($roles as $role)
																												<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																											@endforeach
																										</select>
																										<label for="menu-item-role_id"> <span>Role</span></label>
																									</div>
																									@endif
																								</div>
																							</div>
																						</div>

																					</div>
																				</div>
																			</div>
																		</li>

																	</ul>
																</div>
															</form>

														</div>
														@endif
														@else
														<h3>Menu Creation</h3>
														<div class="drag-instructions post-body-plain" style="">
															<p>
																Please enter the name and select "Create menu" button
															</p>
														</div>
														@endif

														<ul class="menu ui-sortable" id="menu-to-edit">
															@if(isset($menus))
															@foreach($menus as $m)
															<li id="menu-item-{{$m->id}}" class="menu-item menu-item-depth-{{$m->depth}} menu-item-page menu-item-edit-inactive pending" style="display: list-item;">
																<dl class="menu-item-bar">
																	<dt class="menu-item-handle">
																		<span class="item-title"> <span class="menu-item-title"> <span id="menutitletemp_{{$m->id}}">{{$m->label}}</span> <span style="color: transparent;">|{{$m->id}}|</span> </span> <span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span> </span>
																		<span class="item-controls"> <span class="item-type">Link</span> <span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a> </span> <a class="item-edit" id="edit-{{$m->id}}" title=" " href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}"> </a> </span>
																	</dt>
																</dl>

																<div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
																	<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />
																	<p class="description description-thin">
																		<label for="edit-menu-item-title-{{$m->id}}"> Label
																			<br>
																			<input type="text" id="idlabelmenu_{{$m->id}}" class="widefat edit-menu-item-title" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}">
																		</label>
																	</p>

																	<p class="field-css-classes description description-thin">
																		<label for="edit-menu-item-classes-{{$m->id}}"> Class CSS (optional)
																			<br>
																			<input type="text" id="clases_menu_{{$m->id}}" class="widefat code edit-menu-item-classes" name="clases_menu_{{$m->id}}" value="{{$m->class}}">
																		</label>
																	</p>

																	<p class="field-css-url description description-wide">
																		<label for="edit-menu-item-url-{{$m->id}}"> Url
																			<br>
																			<input type="text" id="url_menu_{{$m->id}}" class="widefat code edit-menu-item-url" id="url_menu_{{$m->id}}" value="{{$m->link}}">
																		</label>
																	</p>

																	@if(!empty($roles))
																	<p class="field-css-role description description-wide">
																		<label for="edit-menu-item-role-{{$m->id}}"> Role
																			<br>
																			<select id="role_menu_{{$m->id}}" class="widefat code edit-menu-item-role" name="role_menu_[{{$m->id}}]" >
																				<option value="0">Select Role</option>
																				@foreach($roles as $role)
																					<option @if($role->id == $m->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
																				@endforeach
																			</select>
																		</label>
																	</p>
																	@endif

																	<p class="field-move hide-if-no-js description description-wide">
																		<label><a href="{{ $currentUrl }}" class="btn btn-sm btn-light menus-move-up" style="display: none;">Move up</a> <a href="{{ $currentUrl }}" class="btn btn-sm btn-light menus-move-down" title="Mover uno abajo" style="display: inline;">Move Down</a> <a href="{{ $currentUrl }}" class="btn btn-sm btn-light menus-move-left" style="display: none;"></a> <a href="{{ $currentUrl }}" class="btn btn-sm btn-light menus-move-right" style="display: none;"></a> <a href="{{ $currentUrl }}" class="btn btn-sm btn-light menus-move-top" style="display: none;">Top</a> </label>
																	</p>

																	<div class="menu-item-actions description-wide submitbox">

																		<a class="btn btn-sm btn-danger item-delete submitdelete deletion" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501">Delete</a>
																		<a onclick="getMenu()" class="btn btn-sm btn-primary updatemenu" id="update-{{$m->id}}" href="javascript:void(0)">Update</a>

																	</div>

																</div>
																<ul class="menu-item-transport"></ul>
															</li>
															@endforeach
															@endif
														</ul>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
