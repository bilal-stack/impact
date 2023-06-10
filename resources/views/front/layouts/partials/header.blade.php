<header class="header py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="logo">
                    <a href=""><img src="{{asset('front/assets/images/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-md-7 ">
                <div class="icon-list">
                    <span><a href="#"><i class="fa-solid fa-heart"></i></a></span>
                    <span><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></span>
                    <span><a href="{{url('home')}}"><i class="fa-solid fa-user"></i></a></span>
                    <p><a href="{{route('register')}}">Create An Account</a></p>
                </div>
                <div class="main-menu ">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About Us</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                           role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Shop Art
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="#">Flora Art</a></li>
                                            <li><a class="dropdown-item" href="#">Big Cat</a></li>
                                            <li><a class="dropdown-item" href="#">Equine</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Faq's</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact Us</a>
                                    </li>
                                </ul>
                                <form class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search"
                                           aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-12">
                <header class="head-main">
                    <div class="navbar box-shadow">
                        <div class="container d-flex justify-content-between">
                            <a class="nav-button ml-auto mr-4"><span
                                        id="nav-icon3"><span></span><span></span><span></span><span></span></span></a>
                        </div>
                    </div> <!--navbar end-->

                    <div class="fixed-top dineuron-menu">
                        <div class="flex-center p-5">
                            <ul class="nav flex-column">
                                <li class="nav-item delay-1"><a class="nav-link" href="#">HOME</a></li>
                                <li class="nav-item delay-2"><a class="nav-link" href="#">ABOUT US</a></li>
                                <li class="nav-item dropdown  delay-3">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item delay-4"><a class="nav-link" href="#">FAQ'S</a></li>
                                <li class="nav-item delay-5"><a class="nav-link" href="#">CONTACT US</a></li>
                            </ul>
                        </div>
                    </div> <!--dineuron-menu end-->
                </header>
            </div>
        </div>
    </div>
</header>