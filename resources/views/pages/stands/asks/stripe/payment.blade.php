@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Paiement</h4>

                @if($message = Session::get('error'))
	                <div class='form-row row'>
	                    <div class='col-md-12 error form-group hide'>
	                        <div class='alert-danger alert'>
	                        	{{ $message }}
	                        </div>
	                    </div>
	                </div>
                @endif

                <form 
                   	role="form" 
                    action="{{ route('stripe.post') }}" 
                    method="post" 
                    class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                id="payment-form">

                    @csrf
    
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Nom de la carte</label> 
                            <input class='form-control' size='4' type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Numéro de la carte</label>
                            <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Mois d'expiration</label>
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>
                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Année d'expiration</label>
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                        </div>
                    </div>
                        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customScripts')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
	<script type="text/javascript">
	  
		$(function() {
		  
		    /*------------------------------------------
		    --------------------------------------------
		    Stripe Payment Code
		    --------------------------------------------
		    --------------------------------------------*/
		    
		    var $form = $(".require-validation");
		     
		    $('form.require-validation').bind('submit', function(e) {
		        var $form = $(".require-validation"),
		        inputSelector = ['input[type=email]', 'input[type=password]',
		                         'input[type=text]', 'input[type=file]',
		                         'textarea'].join(', '),
		        $inputs = $form.find('.required').find(inputSelector),
		        $errorMessage = $form.find('div.error'),
		        valid = true;
		        $errorMessage.addClass('hide');
		    
		        $('.has-error').removeClass('has-error');
		        $inputs.each(function(i, el) {
		          var $input = $(el);
		          if ($input.val() === '') {
		            $input.parent().addClass('has-error');
		            $errorMessage.removeClass('hide');
		            e.preventDefault();
		          }
		        });
		     
		        if (!$form.data('cc-on-file')) {
		          e.preventDefault();
		          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
		          Stripe.createToken({
		            number: $('.card-number').val(),
		            cvc: $('.card-cvc').val(),
		            exp_month: $('.card-expiry-month').val(),
		            exp_year: $('.card-expiry-year').val()
		          }, stripeResponseHandler);
		        }
		    
		    });
		      
		    /*------------------------------------------
		    --------------------------------------------
		    Stripe Response Handler
		    --------------------------------------------
		    --------------------------------------------*/
		    function stripeResponseHandler(status, response) {
		        if (response.error) {
		        	console.log(response)
		            $('.error')
		                .removeClass('hide')
		                .find('.alert')
		                .text(response.error.message);
		        } else {
		            /* token contains id, last4, and card type */
		            var token = response['id'];
		                 
		            $form.find('input[type=text]').empty();
		            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
		            $form.get(0).submit();
		        }
		    }
		     
		});
	</script>
@endsection