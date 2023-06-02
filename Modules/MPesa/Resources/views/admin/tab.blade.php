<!-- This will append Mpesa payment tab content on admin payment settings page. -->
<!-- Mpesa Payment tab content strat -->
@extends('layouts.master')
@section('title', __('adminstaticwords.APISettings'))

@section('maincontent')
<div class="contentbar">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30 mt-4">
                <div class="card-body">
                    <div class="admin-form-main-block mrg-t-40">
                        <div class="admin-form-block z-depth-1">
                        
                            <h6 class="form-block-heading apipadding">{{__('MPesa Payemnt Gateway')}}</h6>
                            <br>
                
                            <form action="{{ route('mpesa.payment.settings') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <!-- Consumer Secret Key -->
                                        <div class="form-group">
                                            <div class="search">
                                                <label class="text-dark" for="MPESA_CONSUMER_SECRET"> {{ __("MPESA CONSUMER SECRET:") }}</label>
                                                <input type="password" class="form-control" id="MPESA_PASSKEY"  name="MPESA_CONSUMER_SECRET" id="MPESA_CONSUMER_SECRET" value="{{ env('MPESA_CONSUMER_SECRET') }}" placeholder='{{ __("enter your MPESA CONSUMER SECRET KEY") }}'>
                                                <span toggle="#MPESA_PASSKEY" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Consumer Key -->
                                        <div class="form-group">
                                            <label class="text-dark">{{ __("Consumer Key:") }}</label>
                                            <input required name="MPESA_COSUMER_KEY" value="{{ env('MPESA_COSUMER_KEY') }}" type="text" class="form-control" placeholder="{{ __("Enter CONSUMER KEY") }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Pass Key -->
                                        <div class="form-group">
                                            <div class="search">
                                                <label class="text-dark" for="MPESA_PASSKEY">{{ __("MPESA PASS KEY:") }}</label>
                                                <input id="pass_log_id202" type="password" class="form-control" id="MPESA_PASSKEY"  name="MPESA_PASSKEY" value="{{ env('MPESA_PASSKEY') }}" placeholder='{{ __("enter your MPESA PASSKEY.") }}'>
                                                <span toggle="#pass_log_id202" class="fa fa-fw fa-eye field-icon toggle-password2"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Shortcode -->
                                        <div class="form-group">
                                            <label class="text-dark">{{ __("MPESA SHORTCODE:") }}</label>
                                            <input required name="MPESA_SHORTCODE" value="{{ env('MPESA_SHORTCODE') }}" type="text" class="form-control" placeholder="{{ __("Enter MPESA SHORTCODE") }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Status -->
                                        <div class="form-group">
                                            <label class="text-dark" for="">{{ __("Status:") }}</label>
                                            <br>
                                            <label class="switch">
                                                {!! Form::checkbox('MPESA_ENBALE', 1, (config('mpesa.ENABLE') == 1 ? "checked"  :""), ['id' => 'MPESA_ENBALE','class' => 'checkbox-switch']) !!}
                                                <span class="slider round"></span>
                                            </label>
                                            <br>
                                            <small class="txt-desc">{{ __("(Active or deactive payment gateway by toggling it.)") }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <!-- Live/Sandbox -->
                                        <div class="form-group sandbox-switch">
                                            <label class="text-dark">{{ __("Sandbox (TEST MODE):") }}</label>
                                            <br>
                                                <label class="switch">
                                                    {!! Form::checkbox('MPESA_SANDBOX', 1, (config('mpesa.MPESA_SANDBOX') == 'live' ? "checked" : ""), ['id' => 'MPESA_SANDBOX', 'class' => 'bootswitch', "data-on-text"=>"LIVE", "data-off-text"=>"SANDBOX", "data-size"=>"small"]) !!}
                                                </label>
                                                <br>
                                            <small class="txt-desc">{{ __("(Active or deactive test mode in payment gateway by toggling it.)") }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <!-- Reset / Submit Buttom -->
                                        <div class="btn-group">
                                            <a href={{url()->previous()}} class="btn btn-info"><i class="material-icons left">reply</i> {{__('Back')}}</a>
                                            <button type="reset" class="btn btn-danger"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
                                            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('Save Settings')}}</button>
                                        </div>
                                        <div class="clear-both"></div>
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
@endsection

@section('custom-script')

    <!-- Script for eye icon password - show/hide -->
    <script>

        $(".toggle-password2").click(function() 
        {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } 
            else {
                input.attr("type", "password");
            }
        });

    </script>

@endsection
<!-- Mpesa Payment tab content end -->