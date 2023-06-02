<!-- This will append Mpesa payment tab content on checkout page. -->
<!-- Mpesa payment tab content start -->
<div class="tab-pane" id="mpesa_payment_tab">
    
    @if(config('mpesa.ENABLE') == 1)
        <form action="{{ route("payvia.mpesa") }}" method="POST">
            @csrf
            
            <!-- Amount -->
            <input type="hidden" name="amount" value="{{ $plan->amount }}">

            <!-- Plan ID -->
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">

            <!-- Phone Number -->
            <div class="form-group">
                <input class="form-control" minlength="12" maxlength="12" required type="text" name="phoneno" value="{{ old('phoneno') }}" placeholder="{{ __("Enter your mpesa phone no starts with 254") }}">
            </div>
            
            <!-- Submit Button -->
            <div class="form-group">
                <button class="payment-btn paypal-btn" type="submit" title="checkout">
                    {{__('Pay with MPesa')}} 
                </button>
            </div>
            
        </form>
    @else
        <h4>{{ __("Mpesa Payment gateway is not enabled yet !") }}</h4>
    @endif
</div>
<!-- Mpesa payment tab content end -->