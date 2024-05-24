{{-- <div class = footer>
    <div class = col-lg-3">
        <img src="{{ asset('/assets/logo.svg') }}" alt="">
    </div>
</div> --}}

@vite('resources/css/footer.css')

<footer class="footer">
    <div class="row">
        <div class="col-lg-4">
            <div class="footer-logo">
                <img src="{{ asset('/assets/logo.svg') }}" alt="">
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor sed do eiusmod tempor </p>
            <div class="footer-social-logo">
                <i class="fa-regular fa-envelope" style="color: #cefe06;"></i>
                <i class="fa-brands fa-x-twitter" style="color: #cefe06;"></i>
                <i class="fa-brands fa-discord" style="color: #cefe06;"></i>
                <i class="fa-brands fa-instagram" style="color: #cefe06;"></i>
            </div>
        </div>

        <div class="col-lg-2">
        </div>

        <div class="col-lg-2">
            <div class ="footer-list">
                <ul class="list-unstyled mb-0">
                    <li>
                        <h5>About us</h5>
                    </li>
                    <li>
                        <a href="#!">About</a>
                    </li>
                    <li>
                        <a href="#!">Job</a>
                    </li>
                    <li>
                        <a href="#!">Press</a>
                    </li>
                    <li>
                        <a href="#!">Contact</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-2">
            <div class ="footer-list">
                <ul class="list-unstyled mb-0">
                    <li>
                        <h5>Partnership</h5>
                    </li>
                    <li>
                        <a href="#!">Gallery</a>
                    </li>
                    <li>
                        <a href="#!">Museum</a>
                    </li>
                    <li>
                        <a href="#!">Auctions</a>
                    </li>
                    <li>
                        <a href="#!">Fairs</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-2">
            <div class ="footer-list">
                <ul class="list-unstyled mb-0">
                    <li>
                        <h5>Support</h5>
                    </li>
                    <li>
                        <a href="#!">Help</a>
                    </li>
                    <li>
                        <a href="#!">FAQ</a>
                    </li>
                    <li>
                        <a href="#!">Term & Conditions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

