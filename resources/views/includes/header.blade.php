<div class="wrapper-header">
    <h4 class="fw-semibold">@yield('header_title')</h4>
    <div class="profile-detail">
        <div class="dropdown">
            <div class="d-flex gap-2 align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                @if (Auth::user()->profile_picture == '-')
                <img class="image-profile" src="https://via.placeholder.com/800x600" alt="tet">
                @else
                    <img class="image-profile" src="{{ Auth::user()->profile_picture }}" alt="tet">
                @endif

                <p>{{ Auth::user()->name }}</p>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.1856 4.99373L7.49996 9.56123L2.81434 4.99373C2.73063 4.91196 2.61824 4.86617 2.50121 4.86617C2.38419 4.86617 2.2718 4.91196 2.18809 4.99373C2.14755 5.03345 2.11535 5.08085 2.09337 5.13317C2.07138 5.18549 2.06006 5.24167 2.06006 5.29842C2.06006 5.35517 2.07138 5.41135 2.09337 5.46367C2.11535 5.51599 2.14755 5.56339 2.18809 5.60311L7.17278 10.4631C7.26031 10.5484 7.37772 10.5962 7.49996 10.5962C7.62221 10.5962 7.73961 10.5484 7.82715 10.4631L12.8118 5.60405C12.8527 5.5643 12.8851 5.51678 12.9073 5.46429C12.9294 5.41179 12.9408 5.3554 12.9408 5.29842C12.9408 5.24145 12.9294 5.18505 12.9073 5.13255C12.8851 5.08006 12.8527 5.03254 12.8118 4.9928C12.7281 4.91102 12.6157 4.86523 12.4987 4.86523C12.3817 4.86523 12.2693 4.91102 12.1856 4.9928V4.99373Z"
                        fill="#FDFFF3" />
                </svg>
            </div>
            <ul class="dropdown-menu" style="inset: 0px auto auto -40px">
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li>
                    <a class="dropdown-item" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
