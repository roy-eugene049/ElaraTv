<!-- This will append MPesa logo on front page. -->
<!-- MPesa owl item start -->
@if(config('mpesa.ENABLE') == 1 && Module::has('MPesa') && Module::find('MPesa')->isEnabled())
    <div class="payment-item">
        <a title="{{ __("MPesa Payment") }}" target="__blank" href="https://www.safaricom.co.ke/m-pesa"><img
            data-src="{{ Module::asset('mpesa:logo/mpesa.png') }}" alt="mpesa.png" class="owl-lazy img-fluid"></a>
    </div>              
@endif
<!-- MPesa owl item end -->