@extends('layouts.theme')
@section('title',__('Contact Us'))
@section('main-wrapper')
<div class="breadcrumb-main-block" style="background-image: url('images/b-2.jpg')">
  <div class="overlay-bg"></div>
  <div class="container-fluid">
    <div class="row">
      <h4 class="heading">Contact Us</h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
      </ol>
    </div>
  </div>
</div>

<div class="contact-main-block" style="background-color: #111;">
  <br>
  @if(Session::has('success'))
  <div class="alert alert-success">
    {{__('Success')}} : {{ Session::get('success') }}
  </div>
  @endif
  
  <div class="contact-form-block">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
          <div class="contact-us-img">
            <img src="{{ url('images/contactus.jpg')}}" class="img-fluid" alt="">
          </div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
          <h3 class="contact-us-heading">{{__('Contact')}} <span class="us_text">{{__('Us')}}</span></h3>
          <br>
          <h5 class="contact-us-heading">{{__('Contact Detail')}}</h5>
          <form class="contact-block" action="{{ route('send.contactus') }}" method="post">
            {{ csrf_field() }}
            
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label style="color: #fff;" for="">{{__('Name')}}:</label>
                  <input type="text" class="form-control custom-field-contact" name="name">
                  @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label style="color: #fff;" for="">{{__('Email')}}:</label>
                  <input type="email" class="search-input form-control custom-field-contact" name="email">
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group{{ $errors->has('subj') ? ' has-error' : '' }}">
                  <label style="color: #fff;" for="">{{__('Subject')}}:</label>
                  <select name="subj" id="" class="form-control custom-field-contact">
                    <option value="Billing Issue">{{__('Billing Issue')}}</option>
                    <option value="Streaming Issue">{{__('Streaming Issue')}}</option>
                    <option value="Application Issue">{{__('Application Issue')}}</option>
                    <option value="Advertising">{{__('Advertising')}}</option>
                    <option value="Partnership">{{__('Partnership')}}</option>
                    <option value="Other">{{__('Other')}}</option>
                  </select>
                  @if ($errors->has('subj'))
                  <span class="help-block">
                    <strong>{{ $errors->first('subj') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                  <label style="color: #fff;" for="">{{__('Message')}}:</label>
                  <textarea name="msg" class="form-control custom-field-contact" rows="5" cols="50"></textarea>
                  @if ($errors->has('msg'))
                  <span class="help-block">
                    <strong>{{ $errors->first('msg') }}</strong>
                  </span>
                  @endif
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-subscribe" value="{{__('Send')}}">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection