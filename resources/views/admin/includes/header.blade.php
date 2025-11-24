<header class="app-header">
    <div class="main-header-container container-fluid">
        <div class="header-content-left">
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="desktop-logo">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="desktop-dark">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="toggle-dark">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="desktop-white">
                        <img src="{{ asset('assets/images/profile.png') }}" alt="logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <div class="header-element">
                <a aria-label="Hide Sidebar"
                    class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                    data-bs-toggle="sidebar" href="javascript:void(0);">
                    <span></span>
                </a>
                <h5 class="mt-3" style="font-weight: 400;"> 👋 Hello! @if (Auth::check())
                    {{ Auth::user()->user_name  }} ({{ Auth::user()->user_role }})
                    @else
                    Guest
                    @endif
                </h5>
            </div>
        </div>
        <div class="header-content-right">

            <div class="header-element">
                <div class="d-flex align-items-center">

                    <div class="me-2">
                        {{-- <h5 class="available-credits">
                            Available Credits: 50000
                        </h5> --}}
                    </div>

                    <a href="javascript:void(0);" class="header-link me-2">
                        <i class="fa-solid fa-bell fs-4"></i>
                    </a>

                    <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex align-items-center">

                            <span class="me-1">
                                <img src="{{ Auth::user()->profile_picture ? asset(Auth::user()->profile_picture) : asset('assets/images/profile.png') }}" alt="img" width="32"
                                    height="32" class="rounded-circle">
                            </span>

                            <span class="d-sm-block d-none ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                    </a>

                    <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                        aria-labelledby="mainHeaderProfile">

                        <li>
                            <a class="dropdown-item d-flex" href="{{ url('profile') }}">
                                <i class="ti ti-user fs-18 me-2 op-7"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex" href="{{ url('setting') }}">
                                <i class="ti ti-settings fs-18 me-2 op-7"></i>Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti ti-logout fs-18 me-2 op-7"></i> Log Out
                            </a>

                            <form id="logout-form" action="{{ url('/LogoutUser') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
    <style>
        /* Style for the Available Credits box */
        .available-credits {
            /* Styles from your original inline style */
            border: 1px solid #E7EAE9;
            border-radius: 20px;
            background-color: #fff;
            font-size: 13px;
            /* Added padding for a good look */
            padding: 0.25rem 0.75rem;
            margin-bottom: 0;
            /* Important to remove default h5 margin */
            /* Ensure it's inline with other elements */
            display: flex;
            align-items: center;
            height: 32px;
            /* Set height to align better with the profile image */
        }

        /* Base style for header links/icons */
        .header-link {
            /* Add any common padding/margin you need for clickable targets */
            padding: 5px;
            display: flex;
            align-items: center;
        }
    </style>
</header>
