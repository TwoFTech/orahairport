@extends('layouts.app')

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
                notify_url: "{{ route('stands.pay') }}",
                mode: 'PRODUCTION'
            });
            CinetPay.getCheckout({
                transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
                amount: "100",
                currency: 'XOF',
                channels: 'ALL',
                description: 'Demande de point de vente',   
                 //Fournir ces variables pour le paiements par carte bancaire
                customer_name:"{{ Auth::user()->name }}",//Le nom du client
                customer_surname:"{{ Auth::user()->name }}",//Le prenom du client
                customer_email: "{{ Auth::user()->email }}",//l'email du client
                customer_phone_number: "{{ Auth::user()->phone }}",//l'email du client
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
                    console.log(data)
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
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Informations sur votre demande</h4>
                <form class="form-stand" method="post" action="{{ route('stands.pay') }}" name="form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="fullname" class="form-label">Enseigne</label>
                            <input type="text" class="form-control" id="enseigne" autocomplete="off" placeholder="L'enseigne du point de vente" name="enseigne" value="{{ $stand['name'] }}" readonly>
                            @error("enseigne")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Numéro mobile</label>
                            <input type="text" class="form-control" id="phone" autocomplete="off" placeholder="Numéro mobile du point de vente" name="phone" value="{{ $stand['phone'] }}" readonly>
                            @error("phone")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Pays</label>
                            <input type="text" class="form-control" id="country" autocomplete="off" placeholder="Pays" name="country" value="{{ $stand['country'] }}" readonly>
                            @error("country")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="city" autocomplete="off" placeholder="Ville" name="city"  value="{{ getCity($stand['city']) }}" readonly>
                            @error("city")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Quartier</label>
                            <input type="text" class="form-control" id="quartier" autocomplete="off" placeholder="Quartier" name="quartier" value="{{ $stand['quartier'] }}" readonly>
                            @error("quartier")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="text" class="form-label">Rue</label>
                            <input type="text" class="form-control" id="rue" autocomplete="off" placeholder="Rue" name="rue" value="{{ $stand['rue'] }}" readonly>
                            @error("rue")
                                <p class="text-danger"><small>{{ $message }}</small></p>
                            @enderror
                        </div>
                        <input type="hidden" name="reduc" value="{{ $stand['reduc'] }}">
                        @if($stand['reduc'] != "on")
                            <div class="col-lg-12 mb-3 text-danger">
                                Vous n'avez pas indiqué vouloir bénéficier des 20% de réduction.
                            </div>
                        @else
                            <div class="col-lg-12 mb-3">
                                <h4>Contacts fournis</h4>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" class="form-control" value="{{ explode('@xfokl', unserialize(Cookie::get('contacts'))[0])[0] }} - {{ explode('@xfokl', unserialize(Cookie::get('contacts'))[0])[1] }}" readonly>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" class="form-control" value="{{ explode('@xfokl', unserialize(Cookie::get('contacts'))[1])[0] }} - {{ explode('@xfokl', unserialize(Cookie::get('contacts'))[1])[1] }}" readonly>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" class="form-control" value="{{ explode('@xfokl', unserialize(Cookie::get('contacts'))[2])[0] }} - {{ explode('@xfokl', unserialize(Cookie::get('contacts'))[2])[1] }}" readonly>
                            </div>
                        @endif  
                    </div>
                    <a href="{{ route('stands.create', 'edit') }}" class="btn-sm btn btn-dark btn-update"><i class='link-icon' data-feather='edit-3'></i> Modifier</a>
                    <button class="btn-sm text-white btn btn-info btn-pay d-none" id="btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    @if(str_contains('Bénin Niger Mali Togo Guinée Conakry Sénégal', $stand['country']))
                        <script 
                            src="https://cdn.fedapay.com/checkout.js?v=1.1.7"
                            data-public-key="pk_sandbox_qWM4_7-llW9FPYLFMzYp4QO8"
                            data-button-text="<i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F"
                            data-button-class="btn-sm text-white btn btn-info btn-pay btn-fedapay"
                            data-transaction-amount="{{ getStandAmount() }}"
                            data-transaction-description="Demande de point de vente"
                            data-customer-email="{{ Auth::user()->email }}"
                            data-customer-lastname="{{ Auth::user()->name }}"
                            data-customer-firstname="{{ Auth::user()->name }}"
                            data-customer-iso="XOF">
                        </script>
                    @elseif(str_contains('Burkina Faso Comores Côte d\'Ivoire RDC', $stand['country']))
                        <!-- <button type="button" class="btn-cinetpay btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button> -->
                        <!-- <button onclick="checkout()" type="button" class="btn-cinetpay btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button> -->
                        <button type="button" class="btn-stripe btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    @elseif(str_contains('Cameroun', $stand['country']))
                        <button type="button" class="btn-adwapay btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    @elseif(str_contains('Gabon', $stand['country']))
                        <button type="button" class="singpay btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    @else
                        <span class="btn-pay btn-sm btn btn-warning">Aucun moyen de paiement</span>
                    @endif
                </form>
                {{-- @if($stand['country'] === 'Cameroun')
                    <form method="post" action="https://www.my-dohone.com/dohone/pay" style="margin-top: -40px;">
                        <input type="hidden" name="cmd" value="start">
                        <input type="hidden" name="rN" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="rT" value="{{ Auth::user()->phone }}">
                        <input type="hidden" name="rH" value="MG216U34571964786098606">
                        <input type="hidden" name="rMt" value="{{ getStandAmount() }}">
                        <input type="hidden" name="rDvs" value="XAF">
                        <input type="hidden" name="source" value="Orahairport Travel">
                        <input type="hidden" name="endPage" value="{{ route('home') }}">
                        <input type="hidden" name="notifyPage" value="{{ route('home') }}">
                        <input type="hidden" name="cancelPage" value="{{ route('stands.payment') }}">
                        <button type="submit" class="btn-sm text-white btn btn-info btn-pay"><i class='link-icon' data-feather='send'></i> Payer {{ getFormattedPrice(getStandAmount()) }} F</button>
                    </form>
                @endif --}}
            </div>
            
        </div>
    </div>
    <div class="col-md-12 text-center payment_method">
        Paiement avec
        <p>
            {{-- @if($stand['country'] === 'Cameroun') --}}
                <!-- <img src="https://media-exp1.licdn.com/dms/image/C4E0BAQE069jLPKbPbg/company-logo_200_200/0/1625558898700?e=1674086400&v=beta&t=U4G0Ulx2pIBxj40WrkysNrtEjrtXsKTNReYVPaY2dlA"> -->
            {{-- @else --}}
                <img src="https://www.fedapay.com/wp-content/themes/fedapay_theme/pictures/feda-logo-blue-new.svg">
                <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cinetpay.png') }}">
                <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/singpay.png') }}">
            {{-- @endif --}}
        </p>
    </div>
</div>
@endsection

@section('customScripts')
    <script type="text/javascript">
        //const btn_pay = document.getElementById('btn-pay')

        //btn_pay.addEventListener('click', function(e) {
            //e.preventDefault()
            // Swal.fire({
            //   title: 'Payer {{ getFormattedPrice(getStandAmount()) }} F',
            //   html:
            //     "<br>Réglez le montant à partir de l'un des moyens de paiement ci-dessous afin de procéder à la demande. <br><br>" +
            //     '<p><span class="m__payment fedapay"><img src="https://www.fedapay.com/wp-content/themes/fedapay_theme/pictures/feda-logo-blue-new.svg"></span></p> ' +
            //     '<p><span href="#" class="m__payment cinetpay"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cinetpay.png') }}"></span></p> ' +
            //     '<p><span href="#" class="m__payment singpay"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/singpay.png') }}"></span></p>',
            //   showConfirmButton: false,
            // })

            //const feda_pay = document.querySelector('.fedapay')
            const adwa_pay = document.querySelector('.btn-adwapay')
            const stripe_pay = document.querySelector('.btn-stripe')
            const sing_pay = document.querySelector('.singpay')
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if(adwa_pay != null) {
                adwa_pay.addEventListener('click', function(e) {
                    e.preventDefault()
                    fetch('/points-de-vente/paiement/adwapay',
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
                        // swal.close()
                        let data = JSON.parse(text);
                        // window.location.href = data.link;
                        console.log(text)
                    })
                })
            }

            // feda_pay.addEventListener('click', function(e) {
            //     swal.close()
            //     const feda_btn = document.querySelector('.btn-fedapay')
            //     feda_btn.click()
            // })

            // if(cinet_pay != null) {
            //     cinet_pay.addEventListener('click', function(e) {
            //         var data = JSON.stringify({
            //           "apikey": "467610211639b1fbfa16535.87195747",
            //           "site_id": "670781",
            //           "transaction_id":  Math.floor(Math.random() * 100000000).toString(), //
            //           "amount": 100,
            //           "currency": "XOF",
            //           "alternative_currency": "",
            //           "description": "Demande de point de vente",
            //           "notify_url": "{{ route('stands.callback.cinetpay') }}",
            //           "return_url": "{{ route('stands.redirect.cinetpay') }}",
            //           "metadata": "{{ Auth::user()->id }}",
            //           "channels": "ALL",
            //           "lang": "FR",
            //           // "invoice_data": {
            //           //   "Donnee1": "",
            //           //   "Donnee2": "",
            //           //   "Donnee3": ""
            //           // }
            //         });

            //         fetch('https://api-checkout.cinetpay.com/v2/payment',
            //             {
            //                 headers: {
            //                     "Content-Type": "application/json",
            //                     "X-CSRF-TOKEN": token
            //                 },
            //                 method: 'post',
            //                 body: data
            //             }
            //         ).then(
            //             response => response.text()
            //         ).then((text) => { 
            //             swal.close()
            //             let data = JSON.parse(text);
            //             window.location.href = data.data.payment_url;
            //         })
            //     })
            // }

            if(sing_pay != null) {
                sing_pay.addEventListener('click', function(e) {
                    fetch('/points-de-vente/paiement/singpay',
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
                        // swal.close()
                        let data = JSON.parse(text);
                        window.location.href = data.link;
                        // console.log(text)
                    })
                })
            }

            if(stripe_pay != null) {
                stripe_pay.addEventListener('click', function(e) {
                    console.log(1)
                    window.location.href = "{{ route('stripe.payment') }}";
                })
            }
        //})
    </script>
@endsection