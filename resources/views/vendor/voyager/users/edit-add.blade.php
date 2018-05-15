@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
@stop

@section('content')
  <div class="page-content container-fluid">
      <form class="form-edit-add" role="form"
            action="{{ (isset($dataTypeContent->id)) ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) : route('voyager.'.$dataType->slug.'.store') }}"
            method="POST" enctype="multipart/form-data" autocomplete="off">
          <!-- PUT Method if we are editing -->
          @if(isset($dataTypeContent->id))
              {{ method_field("PUT") }}
          @endif
          {{ csrf_field() }}

          <div class="row">
              <div class="col-md-8">
                  <div class="panel panel-bordered">
                  {{-- <div class="panel"> --}}
                      @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif

                      <div class="panel-body">
                          <div class="form-group">
                              <label for="fullname">{{ __('voyager::generic.name') }}</label>
                              <input type="text" class="form-control" id="fullname" name="fullname" placeholder="{{ __('voyager::generic.name') }}"
                                     value="@if(isset($dataTypeContent->fullname)){{ $dataTypeContent->fullname }}@endif">
                          </div>

                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="@if(isset($dataTypeContent->username)){{ $dataTypeContent->username }}@endif">
                          </div>

                          <div class="form-group">
                              <label for="email">{{ __('voyager::generic.email') }}</label>
                              <input type="email" class="form-control" id="email" name="email" value="@if(isset($dataTypeContent->email)){{ $dataTypeContent->email }}@endif" placeholder="{{ __('voyager::generic.email') }}">
                          </div>

                          <div class="form-group">
                              <label for="password">{{ __('voyager::generic.password') }}</label>
                              @if(isset($dataTypeContent->password))
                                  <br>
                                  <small>{{ __('voyager::profile.password_hint') }}</small>
                              @endif
                              <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password" autocomplete="new-password">
                          </div>

                          @php
                            if($additionalDataContent['user_status'] == "active"){
                              $selected_gender = "active";
                            }else{
                              $selected_gender = "inactive";
                            }
                          @endphp
                          <div class="form-group">
                              <label for="status">Status</label>
                              <select class="form-control" id="status" name="status">
                                @if ($selected_gender == "active")
                                  <option value="active" selected>Active</option>
                                  <option value="inactive">Inactive</option>
                                @else
                                  <option value="active">Active</option>
                                  <option value="inactive" selected>Inactive</option>
                                @endif
                              </select>
                          </div>

                          @php
                            if($dataTypeContent->gender == "man"){
                              $selected_gender = "man";
                            }else{
                              $selected_gender = "woman";
                            }
                          @endphp
                          <div class="form-group">
                              <label for="gender">Gender</label>
                              <select class="form-control" id="gender" name="gender">
                                @if ($selected_gender == "man")
                                  <option value="man" selected>Man</option>
                                  <option value="woman">Woman</option>
                                @else
                                  <option value="man">Man</option>
                                  <option value="woman" selected>Woman</option>
                                @endif
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="sport">Sport</label>
                              @php
                                if(isset($additionalDataContent["coach"]->sport_id)){
                                  $selected_sport = $additionalDataContent["coach"]->sport_id;
                                }
                              @endphp
                              <select class="form-control" id="sport" name="sport">
                                @foreach ($additionalDataContent["sport"] as $key)
                                  @if(isset($additionalDataContent["coach"]->sport_id))
                                    @if ($selected_sport == $key->id)
                                      <option value="{{$key->id}}" selected>{{$key->name}}</option>
                                    @else
                                      <option value="{{$key->id}}">{{$key->name}}</option>
                                    @endif
                                  @else
                                    <option value="{{$key->id}}">{{$key->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="bod">Birth Of Date</label>
                              <input type="date" class="form-control" id="bod" name="bod" value="@if(isset($dataTypeContent->bod)){{ $dataTypeContent->bod }}@endif">
                          </div>

                          <div class="form-group">
                              <label for="address">Address</label>
                              <textarea class="form-control" id="address" name="address" placeholder="Address">@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif</textarea>
                          </div>

                          <div class="form-group">
                              <label for="phone_number">Phone</label>
                              <input type="text" class="form-control" id="phone_number" name="phone_number" value="@if(isset($dataTypeContent->phone_number)){{ $dataTypeContent->phone_number }}@endif"  placeholder="Phone Number">
                          </div>

                          @can('editRoles', $dataTypeContent)
                              <div class="form-group">
                                  <label for="default_role">{{ __('voyager::profile.role_default') }}</label>
                                  @php
                                      $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};

                                      $row     = $dataTypeRows->where('field', 'user_belongsto_role_relationship')->first();
                                      $options = json_decode($row->details);
                                  @endphp
                                  @include('voyager::formfields.relationship')
                              </div>
                              <div class="form-group">
                                  <label for="additional_roles">{{ __('voyager::profile.roles_additional') }}</label>
                                  @php
                                      $row     = $dataTypeRows->where('field', 'user_belongstomany_role_relationship')->first();
                                      $options = json_decode($row->details);
                                  @endphp
                                  @include('voyager::formfields.relationship')
                              </div>
                          @endcan

                      </div>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="panel panel panel-bordered panel-warning">
                      <div class="panel-body">
                          <div class="form-group">
                              @if(isset($dataTypeContent->avatar))
                                  <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image( $dataTypeContent->avatar ) }}" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                              @endif
                              <input type="file" data-name="avatar" name="avatar" id="avatar">
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <button type="submit" class="btn btn-primary pull-right save">
              {{ __('voyager::generic.save') }}
          </button>
      </form>

      {{-- <iframe id="form_target" name="form_target" style="display:none"></iframe>
      <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
          {{ csrf_field() }}
          <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
          <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
      </form> --}}
  </div>
@endsection

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>
@stop
