@extends('layouts.admin')
@section('title',__('All Audio'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('livetv.create')}}" class="btn btn-danger btn-md" title="{{__('Create Audio')}}"><i class="material-icons left">add</i> {{__('Create Audio')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('Delete Selected')}}</a>   
     {{--  @if (Session::has('changed_language'))
        <a href="{{ route('tmdb_movie_translate') }}" class="btn btn-danger btn-md"><i class="material-icons left">translate</i>{{__(' Translate all to')}} {{Session::get('changed_language')}}</a>   
      @endif --}}
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <div class="delete-icon"></div>
            </div>
            <div class="modal-body text-center">
              <h4 class="modal-heading">{{__('Are You Sure ?')}}</h4>
              <p>{{__('Do you really want to delete these records? This process cannot be undone.')}}</p>
            </div>
            <div class="modal-footer">
              {!! Form::open(['method' => 'POST', 'action' => 'MovieController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-danger">Yes</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body content-block-two">
      <table id="moviesTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('Thumbnail')}}</th>
            <th>{{__('Audio Title')}}</th>
            <th>{{__('Featured')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Created By')}}</th>
            <th>{{__('Actions')}}</th>
          </tr>
        </thead>
          @if ($movies)
          <tbody>
           
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