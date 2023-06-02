<!-- This will append Mpesa payment tab content on checkout page. -->
<!-- MPesa Payment on front start -->

@if (env('MPESA_ENBALE') == 1 && in_array('mpesa',$currency_payments) )
    <li>
        <a href="#mpesa_payment_tab" data-toggle="tab">
            {{ __('staticwords.CheckoutWith') }} {{ __("MPesa Payment") }}
        </a>
    </li>
@endif

<!-- MPesa Payment on front end -->