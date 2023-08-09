@extends('sites/layouts/base')
@section('content')
    <section class="contact-main pt-6 pb-60">
        <div class="container">
            <div class="contact-info-main mt-0">
                <div class="row">
                    <div class="col-lg-10 col-offset-lg-1 mx-auto">
                        <div class="contact-info bg-white">
                            <div class="contact-info-title text-center mb-4 px-5">
                                <h3 class="mb-1">INFORMATIONS DE CONTACT</h3>
                                <p class="mb-0">
                                    Retouvez ici nos contacts, laissez-nous un message en cas d'inquiétude.
                                </p>
                            </div>
                            <div class="contact-info-content row mb-1">
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <div class="info-icon mb-2">
                                            <i class="fa fa-map-marker-alt theme"></i>
                                        </div>
                                        <div class="info-content">
                                            <h3>Localisation</h3>
                                            <p class="m-0">Kowegbo, 2ème arrondissement, Cotonou, Bénin</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <div class="info-icon mb-2">
                                            <i class="fa fa-phone theme"></i>
                                        </div>
                                        <div class="info-content">
                                            <h3>Téléphones</h3>
                                            <p class="m-0"><a href="tel:+229 63854326">(+229) 63 85 43 26</a></p>
                                            <p class="m-0"><a href="tel:+229 69259425">(+229) 69 25 94 25</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 mb-4">
                                    <div class="info-item bg-lgrey px-4 py-5 border-all text-center rounded">
                                        <div class="info-icon mb-2">
                                            <i class="fa fa-envelope theme"></i>
                                        </div>
                                        <div class="info-content ps-4">
                                            <h3 style="text-transform: none;">Adresse email</h3>
                                            <p class="m-0"><a href="mailto:marketing@travel-orahairport.com">marketing@travel-orahairport.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contact-form1" class="contact-form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="map rounded overflow-hiddenb rounded mb-md-4">
                                            <div style="width: 100%">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4031787.2222341835!2d2.30937765!3d9.3073556!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1023542b047a5695%3A0xecb277f8cb622ef5!2zQsOpbmlu!5e0!3m2!1sfr!2sbj!4v1666202363212!5m2!1sfr!2sbj" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div id="contactform-error-msg"></div>
                                        <form method="post" action="#" name="contactform2" id="contactform2">
                                            <div class="form-group mb-2">
                                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Nom et prénom(s)">
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="text" name="subject" class="form-control" id="subject" placeholder="Sujet">
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Adresse Email">
                                            </div>
                                            <div class="textarea mb-2">
                                                <textarea name="comments" placeholder="Message"></textarea>
                                            </div>
                                            <div class="comment-btn text-center">
                                                <input type="submit" class="nir-btn" id="submit2" value="Send Message">
                                            </div>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection