@extends('layouts.admin')
@section('title','All Notifications')
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      @can('notification.manage')
      <a href="{{route('notification.create')}}" class="btn btn-danger btn-md" title="{{ __('Create Notification') }}"><i class="material-icons left">add</i> {{ __('Create Notification')}}</a>
      @endcan
      <!-- Delete Modal -->
      @can('notification.manage')
        <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete" title="{{ __('Delete Selected') }}"><i class="material-icons left">delete</i> {{ __('Delete Selected')}}</a> 
      @endcan  
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" title="{{ __('Close') }}">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">{{ __('Are You Sure')}} ?</h4>
              <p>{{ __('Do you really want to delete these records? This process cannot be undone.')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'NotificationController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{ __('No')}}</button>
                <button type="submit" class="btn btn-danger">{{ __('Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{ __('User')}}</th>
            <th>{{ __('Title')}}</th>
            <th>{{ __('Description')}}</th>
            <th>{{ __('Status')}}</th>
          </tr>
        </thead>
        @if ($notification)
          <tbody>
            @foreach ($directors as $key => $director)
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$director->id}}" id="checkbox{{$director->id}}">
                    <label for="checkbox{{$director->id}}" class="material-checkbox"></label>
                  </div>
                  {{$key+1}}
                </td>
                <td>
                  <img
                  @if ($director->image)
                    src="{{asset('/images/directors/' . $director->image)}}"
                  @else
                    src="{{ asset('images/local.png') }}"
                  @endif
                    alt="Pic" width="70px" class="img-responsive img-thumbnail">
                </td>
                <td>{{$director->name}}</td>
                <td>
                  <div class="admin-table-action-block">
                    <a href="{{route('directors.edit', $director->id)}}" data-toggle="" data-original-title="Edit" class="btn-info btn-floating" title="{{ __('Edit')}}"><i class="material-icons">mode_edit</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$director->id}}deleteModal" title="{{ __('Delete')}}"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="{{$director->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" title="{{ __('Close')}}">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{ __('Are You Sure')}} ?</h4>
                      <p>{{ __('Do you really want to delete these records? This process cannot be undone.')}}</p>
                    </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['DirectorController@destroy', $director->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{ __('No')}}</button>
                          <button type="submit" class="btn btn-danger">{{ __('Yes')}}</button>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>
@endsection