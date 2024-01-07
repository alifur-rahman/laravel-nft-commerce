<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/pnotify.custom.css') }}">
    {{--
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/extentions/css/ext-component-toastr.min.css') }}">
    --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/user/css//pages/home.css') }}">
    <style>
        .content {
            margin-right: 0;
        }
    </style>
    @yield('style')
</head>

<body>

    <!-- <ul class="navbar-nav mr-auto">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Index</a>
            @else
            <a href="{{ route('user.login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('user.registration') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </ul> -->

    <div class="container-fluid">

        <!-- side menu -->
        <div class="sidebar">
            <div class="d-flex align-items-center justify-content-between p-3
          text-white">
                <i class="fa fa-bars pe-auto menu-btn" aria-hidden="true"></i>
                <a href="" class="text-white menu-text d-none">NFT's</a>
            </div>
            <div class="sidebar_menu">
                <a class="active_sidebar d-flex align-items-center" href=""><i class="fa fa-cart-plus"
                        aria-hidden="true"></i>
                    <span class="menu-text">Dashboard</span> </a>
                <a class="d-flex align-items-center" href=""><i class="fa
              fa-id-card-o" aria-hidden="true"></i> <span class="menu-text">Profile</span> </a>
                <a class="d-flex align-items-center" href=""><i class="fa
              fa-thermometer-full" aria-hidden="true"></i> <span class="menu-text">About</span> </a>
                <a class="d-flex align-items-center" href=""><i class="fa fa-money" aria-hidden="true"></i> <span
                        class="menu-text">Explore</span> </a>
            </div>
            <hr>
            <div class="sidebar_menu">
                <a class="d-flex align-items-center" href=""><i class="fa
              fa-cart-plus" aria-hidden="true"></i> <span class="menu-text">Resources</span></a>
                <a class="d-flex align-items-center" href=""><i class="fa
              fa-id-card-o" aria-hidden="true"></i> <span class="menu-text">Create</span></a>
                <a class="d-flex align-items-center" href=""><i class="fa
              fa-thermometer-full" aria-hidden="true"></i><span class="menu-text">Project</span></a>
                <a class="d-flex align-items-center" href=""><i class="fa fa-money" aria-hidden="true"></i><span
                        class="menu-text">Pages</span></a>
            </div>
            <div class="sidebar_menu sidebar-logout">
                {{-- <a href="/logout" class="d-flex align-items-center"><i class="fa fa-sign-out"
                        aria-hidden="true"></i><span class="menu-text">Logout</span> </a> --}}

                <a class="d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i><span class="menu-text">Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="content">
            <div>
                <div>
                    <!-- top nav -->
                    <div class="nav mb-4 d-flex justify-content-between
              align-items-center">
                        <div class="">
                            <i class="fa fa-bars mobile-menu-btn menu-btn text-white
                  d-none"></i>
                        </div>
                        <div class="search rounded shadow-box d-flex align-items-center
                pl-3 pr-3 flex-grow-1 mr-5 mobile-none">
                            <i class="fas fa-search text-white pr-2"></i>
                            <input class="text-muted p-2" type="search" name="" id="" placeholder="Search by category">
                        </div>

                        <div class="rounded shadow-box d-flex align-items-center p-2 pl-3
                pr-3 mr-4 mobile-none">
                            <i class="fas fa-search text-white pr-2"></i>
                            <p class="m-0 text-white">332 ETH</p>
                        </div>
                        <div class="rounded shadow-box d-flex align-items-center p-2 pl-3
                pr-3 mr-4 mobile-none">
                            <p class="m-0 text-white">Create</p>
                        </div>

                        <div class="rounded shadow-box gradiant-border d-flex
                align-items-center p-2 pl-3 pr-3 mr-4 mobile-none">
                            <p class="m-0 text-white">Connect Walet</p>
                        </div>

                        <div class=" p-2 pl-3 pr-3 position-relative">
                            <div class="d-flex align-items-center dropdown_menu">
                                <img src="{{asset('assets/user/images/sellers/user1.png')}}" class="rounded-circle mr-3"
                                    alt="" style="width: 45px;
                    height:45px">
                                <div class="user-info">
                                    <p class="user_name text-white m-0"><b>Md Enamul Haque</b></p>
                                    <p class="user_email m-0 small text-blue">enamul@gmail.com</p>
                                </div>
                                <i class="fa fa-angle-down text-white ml-5" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown_item user_dropdown">
                                <ul class="text-white rounded">
                                    <li>
                                        <a href="#" class="text-white"> <i class="fa fa-user mr-2"
                                                aria-hidden="true"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-white"> <i class="fa fa-heart-o
                          mr-2" aria-hidden="true"></i> Favorite</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-white"> <i class="fa fa-eye mr-2"
                                                aria-hidden="true"></i> Watchlist</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-white"> <i class="fa fa-table
                          mr-2" aria-hidden="true"></i> My Collection</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-white"> <i class="fa fa-cog mr-2"
                                                aria-hidden="true"></i> Setting</a>
                                    </li>
                                    <!-- <li>
                                        <a href="#" for="a" class="text-white"> <i class="fa
                          fa-moon-o mr-2" aria-hidden="true"></i>Night Mood</a>
                                        <label id="a" class="switch">
                                            <input id="night_mode" type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>

            </div>
            <footer class="mt-3">
                <div class="footer_section ">
                    <div class="footer_content d-flex flex-wrap">
                        <div class="col contact-new ">
                            <p class="text-white">Contact us</p>
                            <p>
                                hi, we are always open for cooperation and suggestions, <br /> contact us in one of the
                                ways below:
                            </p>
                            <div class="flex ">
                                <div class="col-info ">
                                    <p>
                                        <b>Phone:</b> <br />
                                        <span>+1 (800) 060-07-30</span>
                                    </p>
                                    <p>
                                        <b>Our Location:</b> <br />
                                        <span>715 Fake Street, New York, 10021 USA</span>
                                    </p>
                                </div>
                                <div class="col-info ">
                                    <p>
                                        <b>Email Address:</b> <br />
                                        <span>us@example.com</span>
                                    </p>

                                    <p>
                                        <b>Working Hours:</b> <br />
                                        <span>Sat-Thus 10:00pm - 7:00pm</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="column ">
                                <p class="text-white">Information</p>
                                <p>
                                    <a href=" ">about us</a>
                                </p>
                                <p>
                                    <a href=" ">delivery information</a>
                                </p>
                                <p>
                                    <a href=" ">privacy policy</a>
                                </p>
                                <p>
                                    <a href=" ">brands</a>
                                </p>
                                <p>
                                    <a href=" ">contact us</a>
                                </p>

                            </div>
                        </div>
                        <div class="col ">
                            <div class="column ">
                                <p class="text-white">My Account</p>
                                <p><a href=" ">store location</a></p>
                                <p>
                                    <a href=" ">order history</a>
                                </p>
                                <p>
                                    <a href=" ">wish list</a>
                                </p>
                                <p>
                                    <a href=" ">newsletter</a>
                                </p>
                                <p>
                                    <a href=" ">special offers</a>
                                </p>

                            </div>
                        </div>
                        <div class="col contact-new">
                            <p class="text-white">Newsletter</p>
                            <p>
                                enter your email address below to subscribe to our newsletter<br /> and keep up to date
                                with discounts and special offers.
                            </p>
                            <div class="email ">
                                <input type="email " class="form-control cus-input shadow " id="exampleInputEmail1 "
                                    aria-describedby="emailHelp " placeholder="mail@exmple.com ">
                                <button>Subscribe</button>
                            </div>
                            <p>follow us on social networks:</p>
                            <div class="social mb-3">
                                <a href="# "><img src="https://i.postimg.cc/44pPB9wk/facebook.png " alt=" " /></a>
                                <a href="# "><img src="https://i.postimg.cc/L8Q3nB4f/twitter.png " alt=" " /></a>
                                <a href="# "><img src="https://i.postimg.cc/TYG9S3Hy/instagram.png " alt=" " /></a>
                                <a href="# "><img src="https://i.postimg.cc/kGCxkTwr/youtube.png " alt=" " /></a>
                                <a href="# "><img src="https://i.postimg.cc/CKZHDBd2/telegram.png " alt=" " /></a>
                            </div>
                        </div>
                    </div>

                    <div class="content-foot ">
                        <div class="container ">
                            <div class="foot-text ">
                                <p class="text-white ">powered by <a href="https://democomplay.com/ "><span>Demo
                                            Company</span></a> - designed by <span>Creative Team</span></p>
                                <div class="pay d-flex flex-wrap">
                                    <img src="https://i.postimg.cc/PrtWyFPY/visa-logo-png-2013.png " alt=" " />
                                    <img src="https://i.postimg.cc/R0j1TSHZ/mastercard-PNG23.png " alt=" " />
                                    <img src="https://i.postimg.cc/sggJj0zs/paypal-logo-png-2119.png " alt=" " />
                                    <img src="https://i.postimg.cc/hjdsFzBm/American-Express-logo-PNG14.png " alt=" " />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</body>

<script src="{{ asset('assets/user/js/jquery.slim.min.js') }}"></script>
<script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/user/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://kit.fontawesome.com/1198e48619.js" crossorigin="anonymous"></script>
{{--
<script src="{{ asset('user-assets/assets/js/aos.js') }}"></script> --}}
<script src="{{ asset('assets/user/extentions/js/pnotify.custom.js') }}"></script>
<script src="{{ asset('assets/user/js/chart.js') }}"></script>
<script src="{{ asset('assets/user/js/master.js') }}"></script>
<script src="{{ asset('js/like-operation.js') }}"></script>

<script>
    function notify(type, message) {
        new PNotify({
            delay: 1000,
            text: message,
            title: 'Notification',
            addclass: '',
            type: type,
            remove: true,
            progress: true
        });
    }


    const labels = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Revinew',
            backgroundColor: '#23D8D1',
            borderColor: 'rgb(255, 99, 132)',
            maxBarThickness: 10,
            borderRadius: 5,
            data: [0.5, 2.0, 1, 1.5, 1.5, 2, 1.5],

        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 0,
                }
            }
        },

    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

    // for slide div
    AOS.init();
    // const ctx = document.getElementById('myChart');
</script>

@yield('page-js')

</html>