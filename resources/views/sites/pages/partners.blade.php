@extends('sites/layouts/base')
@section('content')
    <section class="contact-main pt-6 pb-60">
        <div class="container">
            <div class="contact-info-main mt-0">
                <div class="row">
                    <div class="col-lg-10 col-offset-lg-1 mx-auto">
                        <div class="contact-info bg-white">
                            <div class="contact-info-title text-center mb-4 px-5">
                                <h3 class="mb-1">PARTENAIRES</h3>
                                <p class="mb-0">
                                    Retouvez ici nos partenaires.
                                </p>
                            </div>
                            <div class="contact-info-content row mb-1">
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/fedapay.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cinetpay.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/singpay.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/cocan.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/uba.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/visa.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/mtn.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/moov.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/orange.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/airtel.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/free.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/tmoney.png') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/express.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/iata.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/pci.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/partners/sunu.jpeg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection