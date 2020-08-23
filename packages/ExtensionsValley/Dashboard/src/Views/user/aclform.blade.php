@extends('Dashboard::dashboard.dashboard')
@section('content-header')

    <!-- Navigation Starts-->
    @include('Dashboard::dashboard.partials.headersidebar')
    <!-- Navigation Ends-->

@stop
@section('content-area')
    <div class="right_col" role="main">

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{$title}}</h2>
                </div>
            </div>
        </div>
        <?php
        $action = 'extensionsvalley.admin.setpermission';
        ?>
        <div class="x_panel">
            {!!Form::open(array('route' => $action, 'method' => 'post'))!!}
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                    <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }} control-required">
                        {!! Form::label('groups', 'User Group') !!}
                        {!! Form::select('groups_id', array("0"=> " Choose Group","1" => "Super Admin") + ExtensionsValley\Dashboard\Models\Group::getGroups()->toArray(), (request()->has('id')) ?  request()->get('id') : null, [
                            'class'       => 'form-control js-permission-role select2',
                            'required'    => 'required'
                        ]) !!}
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group control-required" style="margin-top: 25px;">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group control-required">
                        <?php

                        $menugroups = new Illuminate\Support\Collection;
                        \Event::dispatch('admin.menu.groups', [$menugroups]);

                        ?>
                        <table class="table table-responsive">
                            <tr>

                                <th>Menus</th>
                                <th>Order</th>
                                <th>
                                    <input type="checkbox" id="view_all_permissions" class="flat ch_box">
                                    View
                                </th>
                                <th>
                                    <input type="checkbox" id="add_all_permissions" class="flat ch_box">
                                    Add
                                </th>
                                <th>
                                    <input type="checkbox" id="edit_all_permissions" class="flat ch_box">
                                    Edit
                                </th>
                                <th>
                                    <input type="checkbox" id="delete_all_permissions" class="flat ch_box">
                                    Delete
                                </th>
                                <th>
                                    <input type="checkbox" id="check_all_permissions" class="flat ch_box">
                                    All
                                </th>

                            </tr>
                            @if(sizeof($menugroups->all()))
                                <?php $count = 1;
                                    $maincounter = 0;
                                    $subcounter = 0;
                                ?>
                                @foreach($menugroups as $key)

                                    <?php
                                    if (sizeof($result)) {
                                        $main_menu_data = $result->Where('acl_key', $key['acl_key'])
                                                ->Where('group_id', request()->get('id'))
                                                ->first();
                                    } else {
                                        $main_menu_data = [];
                                    }
                                    ?>
                                    <tr>
                                        <td>{!! $key['menu_icon'] !!} {{$key['menu_text']}}
                                            <input type="hidden" name="main_menu_text[]" value="{{$key['menu_text']}}"/>
                                            <input type="hidden" name="main_menu_icon[]" value="{{$key['menu_icon']}}"/>
                                            <input type="hidden" name="main_menu_acl_key[]"
                                                   value="{{$key['acl_key']}}"/>
                                        </td>
                                        <td><input type="number" name="main_menu_order[]"
                                                   @if(!empty($main_menu_data->ordering))
                                                   value="{{$main_menu_data->ordering}}"
                                                    @endif
                                            /></td>
                                        <td>
                                            <input type="checkbox"
                                                   @if(!empty($main_menu_data->view)) checked="checked"
                                                   @endif
                                                   name="main_menu_view_{{$maincounter}}"
                                                   class="view_chk flat ch_box"/>

                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @if(!empty($key['sub_menu']))
                                        @foreach($key['sub_menu'] as $subkey)

                                            <?php
                                            if (sizeof($result)) {
                                                $sub_menu_data = $result->Where('acl_key', $subkey['acl_key'])
                                                        ->Where('group_id', request()->get('id'))
                                                        ->first();
                                            } else {
                                                $sub_menu_data = [];
                                            }
                                            ?>
                                            <tr>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{$subkey['menu_text']}}
                                                    <input type="hidden" name="sub_menu_link[]"
                                                           value="{{$subkey['link']}}"/>
                                                    <input type="hidden" name="sub_menu_text[]"
                                                           value="{{$subkey['menu_text']}}"/>
                                                    <input type="hidden" name="sub_menu_acl_key[]"
                                                           value="{{$subkey['acl_key']}}"/>
                                                    <input type="hidden" name="sub_menu_parent_acl_key[]"
                                                           value="{{$key['acl_key']}}"/>
                                                </td>
                                                <td>
                                                    <input type="number" name="sub_menu_order[]"
                                                           @if(!empty($sub_menu_data->ordering))
                                                           value="{{$sub_menu_data->ordering}}"
                                                            @endif
                                                    />
                                                </td>
                                                <td>
                                                    <?php $subcount = $count - 1;?>
                                                    <input type="checkbox" name="sub_menu_view_{{$subcounter}}"
                                                           class="view_chk flat ch_box view_{{$count}}"
                                                           @if(!empty($sub_menu_data->view)) checked="checked" @endif />
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="sub_menu_add_{{$subcounter}}"
                                                           class="add_chk flat ch_box add_{{$count}}"
                                                           @if(!empty($sub_menu_data->adding)) checked="checked" @endif />
                                                </td>
                                                <td>
                                                    <input type="checkbox"
                                                    name="sub_menu_edit_{{$subcounter}}"
                                                           class="edit_chk flat ch_box edit_{{$count}}"
                                                           @if(!empty($sub_menu_data->edit)) checked="checked" @endif />
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="sub_menu_delete_{{$subcounter}}"
                                                           class="del_chk flat ch_box del_{{$count}}"
                                                           @if(!empty($sub_menu_data->trash)) checked="checked" @endif />
                                                </td>
                                                <td><input type="checkbox" id="check_current_row_{{$count}}"
                                                           class="chk_current_row flat ch_box"/></td>
                                            </tr>
                                            <?php   $count++;
                                                    $subcounter++;
                                            ?>
                                        @endforeach
                                    @endif
                                        <?php $maincounter++; ?>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::token() !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

