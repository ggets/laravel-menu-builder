<?php
$currentUrl = url()->current();
?>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
{{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> --}}
<link href="{{asset('vendor/ggets-menu-builder/style.css')}}" rel="stylesheet">
<link href="{{asset('vendor/ggets-menu-builder/floating-labels.css')}}" rel="stylesheet">
<div id="hwpwrap">
	<div class="custom-wp-admin wp-admin wp-core-ui js menu-max-depth-0 nav-menus-php auto-fold admin-bar">
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
																<input id="menu-name" name="menu-name" type="text" class="form-control amenu-name menu-item-textbox" placeholder="Name" value="@if(isset($indmenu)){{$indmenu->name}}@endif">
																<label for="menu-name">Name</label>
																<input type="hidden" id="idmenu" value="@if(isset($indmenu)){{$indmenu->id}}@endif" />
															</div>
															<div class="col-2 publishing-action">
																@if(request()->has('menu')&&request()->input('menu')!=='0')
																	<a onclick="getMenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save"><spinner class="spinner mr-2" id="spincustomu2"></spinner><i class="fas fa-save"></i></a>
																@else
																	<a onclick="createMenu()" name="save_menu" id="save_menu_header" class="btn btn-primary menu-save"><i class="fas fa-save"></i></a>
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
																			<h3 class="accordion-section-title hndle d-flex flex-row justify-content-between align-items-center py-1" tabindex="0"><i>New Menu Item</i> <span class="screen-reader-text">Press return or enter to expand</span><button type="button" class="btn btn-sm btn-light py-1 px-3"><i class="fas fa-plus mr-2"></i><span class="text-dark">Add</span></button>


																			</h3>
																			<div class="accordion-section-content py-1 pl-1 pr-0" style="display: none;">
																				<div class="inside">
																					<div class="menu-item-create" id="menu-item-create" style="padding-left: 6rem;">


																						<div class="row mr-0">
																							<div class="col-11 pr-0">
																								<div class="row">
																									<div id="menu-item-name-wrap" class="col-5 form-label-group pr-0">
																										<div class="input-group">
																											<input id="menu-item-name" name="label" type="text" class="form-control menu-item-textbox" placeholder="Label">
																											<label for="menu-item-name">Label</label>
																										</div>
																									</div>
																									<div id="menu-item-url-wrap" class="col-7 form-label-group">
																										<div class="input-group">
																											<input id="menu-item-url" name="url" type="text" class="form-control menu-item-textbox" placeholder="URL" aria-label="URL" aria-describedby="btnGroupAddon">
																											<label for="menu-item-url">URL</label>
																											<div class="input-group-append btn-group">
																												<button type="button" class="input-group-text btn btn-outline-secondary"><i class="fas fa-exchange"></i></button>
																												<button type="button" class="input-group-text btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split px-2" data-toggle="dropdown" aria-expanded="false">
																													<span class="sr-only">Toggle Dropdown</span>
																												</button>
																												<div class="dropdown-menu dropdown-menu-right bg-light rounded-lg">
																													<a href="#" class="dropdown-item btn btn-sm btn-light"><i class="pr-3 fas fa-link"></i>URL</a>
																													<a href="#" class="dropdown-item btn btn-sm btn-light"><i class="pr-3 fas fa-tag"></i>Route name</a>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																							<div class="col-1 d-flex justify-content-end align-items-start pl-0 pr-1">
																								<a onclick="createItem()" class="btn btn-info submit-add-to-menu right" href="#"><span class="spinner" id="spincustomu"></span><i class="fas fa-save"></i></a>
																							</div>
																						</div>
																						<div class="row mr-0">
																							<div class="col-11 pr-0">
																								<div class="row">
																									<div id="menu-item-class-wrap" class="col-5 form-label-group pr-0">
																										<div class="input-group">
																											<input id="menu-item-class" name="class" type="text" class="form-control menu-item-textbox" placeholder="Classes (CSS) (optional)">
																											<label for="menu-item-class">Classes (CSS) (optional)</label>
																										</div>
																									</div>
																									@if(!empty($roles))
																									<div id="menu-item-role_id-wrap" class="col-7 form-label-group">
																										<div class="input-group">
																											<select id="menu-item-role" name="role">
																												<option value="0">Select Role</option>
																												@foreach($roles as $role)
																													<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																												@endforeach
																											</select>
																											<label for="menu-item-role_id"> <span>Role</span></label>
																										</div>
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

																	<dt class="menu-item-handle d-flex flex-row justify-content-between align-items-center py-0">
																		<span class="item-type fas fa-@if($m->link){{"link"}}@else{{"tag"}}@endif"></span>
																		<span class="item-title py-1">
																			<span class="menu-item-title">
																				<span id="menutitletemp_{{$m->id}}">{{$m->label}}</span>
																				<span style="color: transparent;">|{{$m->id}}|</span>
																			</span>
																			<span class="is-submenu" style="@if($m->depth==0)display: none;@endif">Subelement</span>
																		</span>
																		<span class="item-controls d-flex flex-row align-items-center">
																			<span class="item-order hide-if-js"> <a href="{{ $currentUrl }}?action=move-up-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-up"><abbr title="Move Up">↑</abbr></a> | <a href="{{ $currentUrl }}?action=move-down-menu-item&menu-item={{$m->id}}&_wpnonce=8b3eb7ac44" class="item-move-down"><abbr title="Move Down">↓</abbr></a>
																			</span>
																			<a id="edit-{{$m->id}}" title=" " class="item-edit btn btn-sm btn-light py-1 pl-4 pr-3" href="{{ $currentUrl }}?edit-menu-item={{$m->id}}#menu-item-settings-{{$m->id}}">Edit</a>
																		</span>
																	</dt>
																</dl>

																<div class="menu-item-settings" id="menu-item-settings-{{$m->id}}">
																	<input type="hidden" class="edit-menu-item-id" name="menuid_{{$m->id}}" value="{{$m->id}}" />





																						<div class="d-flex flex-row">
																							<div class="flex-grow-0 mr-2 field-move hide-if-no-js">
																		<div class="d-flex flex-row">
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																			<button type="button" class="btn btn-sm btn-light menus-move-top fas fa-arrow-alt-to-top"></button>
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																		</div>
																		<div class="d-flex flex-row">
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																			<button type="button" class="btn btn-sm btn-light menus-move-up fas fa-arrow-alt-up"></button>
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																		</div>
																		<div class="d-flex flex-row">
																			<button type="button" class="btn btn-sm btn-light menus-move-left fas fa-arrow-alt-left"></button>
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																			<button type="button" class="btn btn-sm btn-light menus-move-right fas fa-arrow-alt-right"></button>
																		</div>
																		<div class="d-flex flex-row">
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																			<button type="button" class="btn btn-sm btn-light menus-move-down fas fa-arrow-alt-down"></button>
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																		</div>
																		<div class="d-flex flex-row">
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																			<button type="button" class="btn btn-sm btn-light menus-move-bottom fas fa-arrow-alt-to-bottom"></button>
																			<button type="button" class="btn btn-sm btn-light" disabled="disabled"></button>
																		</div>

																							</div>
																							<div class="flex-grow-1 py-4 pl-1">
																								<div class="row mr-0">
																									<div class="col-11 pr-0">
																										<div class="row">
																											<div id="menu-item-name-wrap" class="col-5 form-label-group pr-0">
																												<div class="input-group">
																													<input id="edit-menu-item-title-{{$m->id}}" name="idlabelmenu_{{$m->id}}" value="{{$m->label}}" type="text" class="form-control menu-item-textbox" placeholder="Label">
																													<label for="edit-menu-item-title-{{$m->id}}">Label</label>
																												</div>
																											</div>
																											<div id="menu-item-url-wrap" class="col-7 form-label-group">
																												<div class="input-group">
																													<input id="edit-menu-item-url-{{$m->id}}" name="url_menu_{{$m->id}}" value="{{$m->link}}" type="text" class="form-control menu-item-textbox" placeholder="URL" aria-label="URL" aria-describedby="btnGroupAddon">
																													<label for="edit-menu-item-url-{{$m->id}}">URL</label>
																													<div class="input-group-append btn-group">
																														<button type="button" class="input-group-text btn btn-outline-secondary"><i class="fas fa-exchange"></i></button>
																														<button type="button" class="input-group-text btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split px-2" data-toggle="dropdown" aria-expanded="false">
																															<span class="sr-only">Toggle Dropdown</span>
																														</button>
																														<div class="dropdown-menu dropdown-menu-right bg-light rounded-lg">
																															<a href="#" class="dropdown-item btn btn-sm btn-light"><i class="pr-3 fas fa-link"></i>URL</a>
																															<a href="#" class="dropdown-item btn btn-sm btn-light"><i class="pr-3 fas fa-tag"></i>Route name</a>
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																									<div class="col-1 d-flex justify-content-end align-items-start pl-0 pr-1">
																										<a onclick="getMenu()" class="btn btn-info" id="update-{{$m->id}}" href="javascript:void(0)"><span class="spinner" id="spincustomu"></span><i class="fas fa-save"></i></a>
																									</div>
																								</div>
																								<div class="row mr-0">
																									<div class="col-11 pr-0">
																										<div class="row">
																											<div id="menu-item-class-wrap" class="col-5 form-label-group pr-0">
																												<div class="input-group">
																													<input id="edit-menu-item-classes-{{$m->id}}" name="clases_menu_{{$m->id}}" value="{{$m->class}}" type="text" class="form-control menu-item-textbox" placeholder="Classes (CSS) (optional)">
																													<label for="edit-menu-item-classes-{{$m->id}}">Classes (CSS) (optional)</label>
																												</div>
																											</div>
																											@if(!empty($roles))
																											<div id="menu-item-role_id-wrap" class="col-7 form-label-group">
																												<div class="input-group">
																													<select id="edit-menu-item-role-{{$m->id}}" name="role_menu_[{{$m->id}}]">
																														<option value="0">Select Role</option>
																														@foreach($roles as $role)
																														<option @if($role->id == $m->role_id) selected @endif value="{{ $role->$role_pk }}">{{ ucwords($role->$role_title_field) }}</option>
																														<option value="{{ $role->$role_pk }}">{{ ucfirst($role->$role_title_field) }}</option>
																														@endforeach
																													</select>
																													<label for="edit-menu-item-role-{{$m->id}}"> <span>Role</span></label>
																												</div>
																											</div>
																											@endif
																										</div>
																									</div>
																									<div class="col-1 d-flex justify-content-end align-items-start pl-0 pr-1">
																										<a onclick="getMenu()" class="btn btn-danger" id="delete-{{$m->id}}" href="{{ $currentUrl }}?action=delete-menu-item&menu-item={{$m->id}}&_wpnonce=2844002501"><span class="spinner" id="spincustomu"></span><i class="fas fa-trash-alt"></i></a>
																									</div>
																								</div>
																							</div>
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
