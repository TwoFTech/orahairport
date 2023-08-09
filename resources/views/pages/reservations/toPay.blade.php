@extends('sites/layouts/base')

@section('customStyles')
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>

    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <script>
        function checkout() {
            CinetPay.setConfig({
                apikey: '467610211639b1fbfa16535.87195747',//   YOUR APIKEY
                site_id: '670781',//YOUR_SITE_ID
                notify_url: "{{ route('reservations.paid', ['reservation' => $reservation, 'token' => $reservation->token]) }}",
                mode: 'SANDBOX'
            });
            CinetPay.getCheckout({
                transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
                amount: "{{ $reservation->amount }}",
                currency: 'XOF',
                channels: 'ALL',
                description: 'Règlement de réservation',   
                 //Fournir ces variables pour le paiements par carte bancaire
                customer_name:"{{ $reservation->lastname }}",//Le nom du client
                customer_surname:"{{ $reservation->firstname }}",//Le prenom du client
                customer_email: "{{ $reservation->email }}",//l'email du client
                customer_phone_number: "{{ $reservation->phone }}",//le téléphone du client
                customer_address : "",//addresse du client
                customer_city: "",// La ville du client
                customer_country : "",// le code ISO du pays
                customer_state : "",// le code ISO l'état
                customer_zip_code : "", // code postal

            });
            CinetPay.waitResponse(function(data) {
                if (data.status == "REFUSED") {
                    if (alert("Votre paiement a échoué")) {
                        window.location.reload();
                    }
                } else if (data.status == "ACCEPTED") {
                    if (alert("Votre paiement a été effectué avec succès")) {
                        window.location.reload();
                    }
                }
            });
            CinetPay.onError(function(data) {
                console.log(data);
            });
        }
    </script>
@endsection

@section('content')
    <section class="contact-main pt-6 pb-60">
        <div class="container">
            <div class="contact-info-main mt-0">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="contact-info bg-white">
                            <div class="contact-info-content row mb-1">
                                <p class="mb-2">Procédez au règlement de la réservation à travers le bouton ci-dessous.</p>
                                @if($reservation->pnr != null && $reservation->amount != null && $reservation->transaction_id == null)
                                    <form class="form-reservation" method="post" action="{{ route('reservations.paid', ['reservation' => $reservation, 'token' => $reservation->token]) }}">
                                        @csrf
                                        <button class="btn-sm text-white btn btn-info btn-pay d-inline-block" id="btn-pay"><i class='link-icon' data-feather='send'></i> Régler avec {{ getFormattedPrice($reservation->amount) }} F</button>
                                        <script 
                                            src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                                            data-public-key="pk_sandbox_vg6uQjwTztFJbaxNW3I_0ksw"
                                            data-button-text="<i class='link-icon' data-feather='send'></i> Régler avec {{ getFormattedPrice($reservation->amount) }} F"
                                            data-button-class="btn-sm text-white btn btn-info btn-fedapay d-none"
                                            data-transaction-amount="{{ $reservation->amount }}"
                                            data-transaction-description="Règlement de réservation"
                                            data-customer-email="{{ $reservation->email }}"
                                            data-customer-lastname="{{ $reservation->firstname }}"
                                            data-customer-firstname="{{ $reservation->lastname }}"
                                            data-customer-iso="XOF">
                                        </script>
                                        <button onclick="checkout()" type="button" class="btn-cinetpay d-none">Cinetpay</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center payment_method mt-4">
                        Paiement avec
                        <p>
                            <img src="https://www.fedapay.com/wp-content/themes/fedapay_theme/pictures/feda-logo-blue-new.svg">
                            <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cinetpay.png') }}">
                            <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/singpay.png') }}">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customScripts')
    <script type="text/javascript">
        const btn_pay = document.getElementById('btn-pay')

        btn_pay.addEventListener('click', function(e) {
            e.preventDefault()
            Swal.fire({
              title: 'Payer {{ getFormattedPrice($reservation->amount) }} F',
              html:
                "<br>Réglez le montant à partir de l'un des moyens de paiement ci-dessous afin de procéder au règlement de la réservation. <br><br>" +
                '<p><span class="m__payment fedapay"><img src="https://www.fedapay.com/wp-content/themes/fedapay_theme/pictures/feda-logo-blue-new.svg"></span><br> Si vous êtes au Bénin, Niger, Mali, Togo, Guinée Conakry, Sénégal.</p>  ' +
                '<p><span href="#" class="m__payment cinetpay"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cinetpay.png') }}"></span><br> Si vous êtes au Burkina Faso, Cameroun, Comores, Côte d\'ivoire, RDC.</p> ' +
                '<p><span href="#" class="m__payment singpay"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/singpay.png') }}"></span><br> Si vous êtes au Gabon.</p>',
              showConfirmButton: false,
            })

            const feda_pay = document.querySelector('.fedapay')
            const cinet_pay = document.querySelector('.cinetpay')
            const sing_pay = document.querySelector('.singpay')

            sing_pay.addEventListener('click', function(e) {
                e.preventDefault()
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let url = "{{ route('reservations.singpay', ['reservation' => $reservation, 'token' => $reservation->token]) }}"
                fetch(url,
                    {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                        },
                        method: 'get',
                    }
                ).then(
                    response => response.text()
                ).then((text) => { 
                    swal.close()
                    let data = JSON.parse(text);
                    window.location.href = data.link;
                })
            })

            feda_pay.addEventListener('click', function(e) {
                swal.close()
                const feda_btn = document.querySelector('.btn-fedapay')
                feda_btn.click()
            })

            cinet_pay.addEventListener('click', function(e) {
                swal.close()

                Swal.fire({
                  title: 'Désolé, vous ne pouvez pas payer pour le moment !',
                  // showConfirmButton: false,
                })
                
                // const cinet_btn = document.querySelector('.btn-cinetpay')
                // cinet_btn.click()
            })
        })
    </script>
@endsection