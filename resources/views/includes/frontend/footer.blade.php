<section id="footer" class="row">
    <div class="col-lg-8 offset-lg-2 text-center text-xl-left pb-xl-4">
        <div class="row d-sm-flex ">
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 px-lg-0">
                <h3 class="pt-4 pb-4">INFORMATIE</h3>
                <a href="{{ route('faq') }}#bestellen"><p>Bestellen & Leveren</p></a>
                <a href="{{ route('faq') }}#betalen"><p>Betalen</p></a>
                <a href="{{ route('faq') }}#retourneren"><p>Retourneren</p></a>
                <a href="{{ route('faq') }}#garantie"><p>Garantie</p></a>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 px-lg-0">
                <h3 class="pt-4 pb-4">ACCOUNT</h3>
                <a href="{{ route('login') }}"><p>Log In</p></a>
                <a href="{{ route('account') }}"><p>Account</p></a>
                <a href="{{ route('winkelwagen') }}">
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <p class="m-0 mr-2">Winkelwagen</p>
                        <div class="d-flex align-items-center">
                            <span class="badge badge-pill badge-success">{{ Session::has('cart') ? Session::get('cart')->totalQuantity : '0' }}</span>
                        </div>
                    </div>

                </a>
                {{--<a href="verlanglijst.html"><p>Verlanglijst</p></a>--}}
               {{-- <a href="checkout.html"><p>Check out</p></a>--}}
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 px-lg-0">
                <h3 class="pt-4 pb-4">HELP</h3>
                <a href="{{ route('faq') }}#verzenden"><p>Verzenden</p></a>
                <a href="{{ route('faq') }}#privacy"><p>Privacy</p></a>
                <a href="{{ route('faq') }}#contact"><p>Contact</p></a>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3 px-lg-0">
                <h3 class="pt-4 pb-4">CONTACT INFO</h3>
                <p><i class="fas fa-globe-europe mr-2"></i> 1234 Koningslaan, Belgie</p>
                <p><i class="fas fa-phone-alt mr-2"></i> 0032 054 586 895</p>
                <p><i class="far fa-envelope mr-2"></i> <a href="#">mail@shop.be</a></p>
            </div>
        </div>
    </div>
</section>
<section id="footer-cards" class="d-lg-flex text-center row p-0">
    <div class="col-lg-8 offset-lg-2 text-white d-xl-flex text-center align-items-lg-center py-lg-4 p-0">
        <div class="d-md-flex justify-content-md-center d-lg-flex justify-content-lg-center mt-3 my-lg-3">
            <p class="mr-lg-4 mb-lg-0 mr-3">Copyright <i class="far fa-copyright"></i> 2019</p>
            <p class="mr-lg-4 mb-lg-0 mr-3">Funko <span>King</span></p>
            <p class="mr-lg-4 mb-lg-0 mr-3">All Rights Reserved</p>
            <p class="mr-lg-4 mb-lg-0 mr-3">Design by Gravedigger</p>
        </div>
        <div class="flex-lg-grow-1">
          {{--  <img class="img-fluid mr-2" src="{{asset('images/visasmall.png')}}" alt="bankcard">
            <img class="img-fluid mr-2" src="{{asset('images/mastercardsmall.png')}}" alt="bankcard">
            <img class="img-fluid mr-2" src="{{asset('images/maestrosmall.png')}}" alt="bankcard">--}}
            <img class="img-fluid mr-2 mt-2 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0" src="{{asset('images/stripe.png')}}"
                 alt="bankcard">
           {{-- <img class="img-fluid mt-2 mt-sm-0 mt-md-0 mt-lg-0 mt-xl-0" src="{{asset('images/bcsmall.png')}}" alt="bankcard">--}}
        </div>
    </div>
</section>
