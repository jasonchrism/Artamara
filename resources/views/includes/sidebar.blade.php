@push('styles')
    @vite('resources/css/sidebar.css')
@endpush
<div class="sidebar">
    <div class="wrapper-sidebar">
        <img src="/assets/logo.svg" class="logo" alt="">
        @if (Auth::user()->role == 'ARTIST')
            <nav class="d-grid gap-4">
                <a href="{{ route('homeArtist') }}" class="sidebar-item">
                    @if (Request::is('*/home'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.2235 3.63529H20.3647V9.77647H14.2235V3.63529ZM3.63529 3.63529H9.77647V9.77647H3.63529V3.63529ZM14.2235 14.2235H20.3647V20.3647H14.2235V14.2235ZM3.63529 14.2235H9.77647V20.3647H3.63529V14.2235Z"
                                stroke="#CEFE06" stroke-width="1.27059" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.2235 3.63529H20.3647V9.77647H14.2235V3.63529ZM3.63529 3.63529H9.77647V9.77647H3.63529V3.63529ZM14.2235 14.2235H20.3647V20.3647H14.2235V14.2235ZM3.63529 14.2235H9.77647V20.3647H3.63529V14.2235Z"
                                stroke="#464646" stroke-width="1.27059" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/home') ? 'text-white' : '' }} ">Dashboard</p>
                </a>
                <a href="{{ route('artist-sales.index') }}" class="sidebar-item">
                    @if (Request::is('*/artist-sales'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 22V6H8L12 2L16 6H22V22H2ZM4 20H20V8H4V20ZM6 18H18L14.25 13L11.25 17L9 14L6 18ZM17.5 13C17.9167 13 18.271 12.8543 18.563 12.563C18.855 12.2717 19.0007 11.9173 19 11.5C18.9993 11.0827 18.8537 10.7287 18.563 10.438C18.2723 10.1473 17.918 10.0013 17.5 10C17.082 9.99867 16.728 10.1447 16.438 10.438C16.148 10.7313 16.002 11.0853 16 11.5C15.998 11.9147 16.144 12.269 16.438 12.563C16.732 12.857 17.086 13.0027 17.5 13ZM10.1 6H13.9L12 4.1L10.1 6Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 22V6H8L12 2L16 6H22V22H2ZM4 20H20V8H4V20ZM6 18H18L14.25 13L11.25 17L9 14L6 18ZM17.5 13C17.9167 13 18.271 12.8543 18.563 12.563C18.855 12.2717 19.0007 11.9173 19 11.5C18.9993 11.0827 18.8537 10.7287 18.563 10.438C18.2723 10.1473 17.918 10.0013 17.5 10C17.082 9.99867 16.728 10.1447 16.438 10.438C16.148 10.7313 16.002 11.0853 16 11.5C15.998 11.9147 16.144 12.269 16.438 12.563C16.732 12.857 17.086 13.0027 17.5 13ZM10.1 6H13.9L12 4.1L10.1 6Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/artist-sales') ? 'text-white' : '' }}">Art
                        Sales</p>
                </a>
                <a href="{{ route('artist-auction.index') }}" class="sidebar-item">
                    @if (Request::is('*/artist-auction'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 2H18V8L14 12L18 16V22H6V16L10 12L6 8V2ZM16 16.5L12 12.5L8 16.5V20H16V16.5ZM12 11.5L16 7.5V4H8V7.5L12 11.5ZM10 6H14V6.75L12 8.75L10 6.75V6Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 2H18V8L14 12L18 16V22H6V16L10 12L6 8V2ZM16 16.5L12 12.5L8 16.5V20H16V16.5ZM12 11.5L16 7.5V4H8V7.5L12 11.5ZM10 6H14V6.75L12 8.75L10 6.75V6Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/artist-auction') ? 'text-white' : '' }}">Art
                        Auction
                    </p>
                </a>
                <a href="{{ route('artist-transactions.index') }}" class="sidebar-item">
                    @if (Request::is('*/artist-transactions'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 2V5M15 2V5M8 9.5H16M8 13.5H14M8 17.5H12M5.5 4.00085C4.94772 4.00085 5.25 4 4.5 4V22.0008H18.5C19.0523 22.0008 18.5 22 19.5 22V4.00077L5.5 4.00085Z"
                                stroke="#CEFE06" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 2V5M15 2V5M8 9.5H16M8 13.5H14M8 17.5H12M5.5 4.00085C4.94772 4.00085 5.25 4 4.5 4V22.0008H18.5C19.0523 22.0008 18.5 22 19.5 22V4.00077L5.5 4.00085Z"
                                stroke="#464646" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/artist-transactions') ? 'text-white' : '' }}">
                        Transactions
                    </p>
                </a>
                <a href="{{ route('rating.index') }}" class="sidebar-item">
                    @if (Request::is('*/rating'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.89L14.07 9.075L14.415 9.825L15.165 9.9375L19.785 10.605L16.5 13.83L15.9375 14.3775L16.0725 15.1275L16.86 19.725L12.7275 17.5575L12 17.25L11.3025 17.6175L7.17002 19.755L7.92002 15.1575L8.05502 14.4075L7.50002 13.83L4.18502 10.5675L8.80502 9.9L9.55502 9.7875L9.90002 9.0375L12 4.89ZM12 1.5L8.58752 8.415L0.960022 9.5175L6.48002 14.9025L5.17502 22.5L12 18.915L18.825 22.5L17.52 14.9025L23.04 9.525L15.4125 8.415L12 1.5Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4.89L14.07 9.075L14.415 9.825L15.165 9.9375L19.785 10.605L16.5 13.83L15.9375 14.3775L16.0725 15.1275L16.86 19.725L12.7275 17.5575L12 17.25L11.3025 17.6175L7.17002 19.755L7.92002 15.1575L8.05502 14.4075L7.50002 13.83L4.18502 10.5675L8.80502 9.9L9.55502 9.7875L9.90002 9.0375L12 4.89ZM12 1.5L8.58752 8.415L0.960022 9.5175L6.48002 14.9025L5.17502 22.5L12 18.915L18.825 22.5L17.52 14.9025L23.04 9.525L15.4125 8.415L12 1.5Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/rating') ? 'text-white' : '' }}">Rating</p>
                </a>
            </nav>
        @else
            <nav class="d-grid gap-4">
                <a href="{{ route('homeAdmin') }}" class="sidebar-item">
                    @if (Request::is('*/home'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.2235 3.63529H20.3647V9.77647H14.2235V3.63529ZM3.63529 3.63529H9.77647V9.77647H3.63529V3.63529ZM14.2235 14.2235H20.3647V20.3647H14.2235V14.2235ZM3.63529 14.2235H9.77647V20.3647H3.63529V14.2235Z"
                                stroke="#CEFE06" stroke-width="1.27059" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.2235 3.63529H20.3647V9.77647H14.2235V3.63529ZM3.63529 3.63529H9.77647V9.77647H3.63529V3.63529ZM14.2235 14.2235H20.3647V20.3647H14.2235V14.2235ZM3.63529 14.2235H9.77647V20.3647H3.63529V14.2235Z"
                                stroke="#464646" stroke-width="1.27059" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/home') ? 'text-white' : '' }}">Dashboard</p>
                </a>
                <a href="{{ route('sales.index') }}" class="sidebar-item">
                    @if (Request::is('*/sales'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 22V6H8L12 2L16 6H22V22H2ZM4 20H20V8H4V20ZM6 18H18L14.25 13L11.25 17L9 14L6 18ZM17.5 13C17.9167 13 18.271 12.8543 18.563 12.563C18.855 12.2717 19.0007 11.9173 19 11.5C18.9993 11.0827 18.8537 10.7287 18.563 10.438C18.2723 10.1473 17.918 10.0013 17.5 10C17.082 9.99867 16.728 10.1447 16.438 10.438C16.148 10.7313 16.002 11.0853 16 11.5C15.998 11.9147 16.144 12.269 16.438 12.563C16.732 12.857 17.086 13.0027 17.5 13ZM10.1 6H13.9L12 4.1L10.1 6Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 22V6H8L12 2L16 6H22V22H2ZM4 20H20V8H4V20ZM6 18H18L14.25 13L11.25 17L9 14L6 18ZM17.5 13C17.9167 13 18.271 12.8543 18.563 12.563C18.855 12.2717 19.0007 11.9173 19 11.5C18.9993 11.0827 18.8537 10.7287 18.563 10.438C18.2723 10.1473 17.918 10.0013 17.5 10C17.082 9.99867 16.728 10.1447 16.438 10.438C16.148 10.7313 16.002 11.0853 16 11.5C15.998 11.9147 16.144 12.269 16.438 12.563C16.732 12.857 17.086 13.0027 17.5 13ZM10.1 6H13.9L12 4.1L10.1 6Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/sales') ? 'text-white' : '' }}">Art Sales
                    </p>
                </a>
                <a href="{{ route('auction.index') }}" class="sidebar-item">
                    @if (Request::is('*/auction'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 2H18V8L14 12L18 16V22H6V16L10 12L6 8V2ZM16 16.5L12 12.5L8 16.5V20H16V16.5ZM12 11.5L16 7.5V4H8V7.5L12 11.5ZM10 6H14V6.75L12 8.75L10 6.75V6Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 2H18V8L14 12L18 16V22H6V16L10 12L6 8V2ZM16 16.5L12 12.5L8 16.5V20H16V16.5ZM12 11.5L16 7.5V4H8V7.5L12 11.5ZM10 6H14V6.75L12 8.75L10 6.75V6Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/auction') ? 'text-white' : '' }}">Art
                        Auction
                    </p>
                </a>
                <a href="{{ route('transactions.index') }}" class="sidebar-item">
                    @if (Request::is('*/transactions'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 2V5M15 2V5M8 9.5H16M8 13.5H14M8 17.5H12M5.5 4.00085C4.94772 4.00085 5.25 4 4.5 4V22.0008H18.5C19.0523 22.0008 18.5 22 19.5 22V4.00077L5.5 4.00085Z"
                                stroke="#CEFE06" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 2V5M15 2V5M8 9.5H16M8 13.5H14M8 17.5H12M5.5 4.00085C4.94772 4.00085 5.25 4 4.5 4V22.0008H18.5C19.0523 22.0008 18.5 22 19.5 22V4.00077L5.5 4.00085Z"
                                stroke="#464646" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/transactions') ? 'text-white' : '' }}">
                        Transactions
                    </p>
                </a>
                <a href="{{route('viewAdmin')}}" class="sidebar-item">
                    @if (Request::is('*/viewUsers'))
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12C10.9391 12 9.92172 11.5786 9.17157 10.8284C8.42143 10.0783 8 9.06087 8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4ZM12 6C11.4696 6 10.9609 6.21071 10.5858 6.58579C10.2107 6.96086 10 7.46957 10 8C10 8.53043 10.2107 9.03914 10.5858 9.41421C10.9609 9.78929 11.4696 10 12 10C12.5304 10 13.0391 9.78929 13.4142 9.41421C13.7893 9.03914 14 8.53043 14 8C14 7.46957 13.7893 6.96086 13.4142 6.58579C13.0391 6.21071 12.5304 6 12 6ZM12 13C14.67 13 20 14.33 20 17V20H4V17C4 14.33 9.33 13 12 13ZM12 14.9C9.03 14.9 5.9 16.36 5.9 17V18.1H18.1V17C18.1 16.36 14.97 14.9 12 14.9Z"
                                fill="#CEFE06" />
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12C10.9391 12 9.92172 11.5786 9.17157 10.8284C8.42143 10.0783 8 9.06087 8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4ZM12 6C11.4696 6 10.9609 6.21071 10.5858 6.58579C10.2107 6.96086 10 7.46957 10 8C10 8.53043 10.2107 9.03914 10.5858 9.41421C10.9609 9.78929 11.4696 10 12 10C12.5304 10 13.0391 9.78929 13.4142 9.41421C13.7893 9.03914 14 8.53043 14 8C14 7.46957 13.7893 6.96086 13.4142 6.58579C13.0391 6.21071 12.5304 6 12 6ZM12 13C14.67 13 20 14.33 20 17V20H4V17C4 14.33 9.33 13 12 13ZM12 14.9C9.03 14.9 5.9 16.36 5.9 17V18.1H18.1V17C18.1 16.36 14.97 14.9 12 14.9Z"
                                fill="#464646" />
                        </svg>
                    @endif
                    <p class="sidebar-label fw-semibold {{ Request::is('*/viewUsers') ? 'text-white' : '' }}">User</p>
                </a>
            </nav>
        @endif
    </div>
</div>
