<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AquaCycle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- <link rel="stylesheet" href="./assets/css/style.css"> --}}

    @vite(['resources/css/HomePage.css', 'resources/js/HomePage.js'])
</head> 

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('Landing Page')}}">
                <img src="{{ Vite::asset('resources/img/logo.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Our Device</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#articles">Articles</a>
                    </li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-brand ms-lg-3">Register</a>
                <a href="{{ route('login') }}" class="btn btn-light ms-2 " style="background-color:rgb(223, 229, 250);">Sign in</a>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="hero" class="min-vh-100 d-flex align-items-center text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 data-aos="fade-left" class="text-uppercase text-white fw-semibold display-1">Welcome, Tata!</h1>
                    <h5 class="text-white mt-3 mb-4" data-aos="fade-right">Be a Catalyst of Change by Making Micro-Actions</h5>
                    <div data-aos="fade-up" data-aos-delay="50">
                        <a href="#" class="btn btn-brand me-2">View Demo</a>
                        <a href="{{ route('login') }}" class="btn btn-light ms-2">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="50">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">About us</h1>
                        <div class="line"></div>
                        <p>We are students committed to driving change by promoting plastic recycling for a better tomorrow.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6" data-aos="fade-down" data-aos-delay="50">
                    <img src="{{ Vite::asset('resources/img/AboutUs.png')}}" alt="">
                </div>
                <div data-aos="fade-down" data-aos-delay="150" class="col-lg-5">
                    <h1>About AquaCycle</h1>
                    <p class="mt-3 mb-4">At AquaCycle, we empower students to take action for a cleaner environment by promoting the proper disposal and recycling of plastic bottles, fostering a culture of sustainability.</p>
                    <div class="d-flex pt-4 mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-mail-send-fill"></i>
                        </div>
                        <div>
                            <h5>Innovative Solutions</h5>
                            <p>We are committed to developing creative and effective solutions to tackle the growing issue of plastic waste in our communities.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="iconbox me-4">
                            <i class="ri-user-5-fill"></i>
                        </div>
                        <div>
                            <h5>Promoting Recycling</h5>
                            <p>Our goal is to promote the importance of plastic recycling, encouraging responsible habits that reduce environmental impact.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="iconbox me-4">
                            <i class="ri-rocket-2-fill"></i>
                        </div>
                        <div>
                            <h5>Educating and Inspiring</h5>
                            <p>Through awareness and education, we aim to inspire students to take action and become leaders in sustainable practices.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <!-- <section id="services" class="section-padding border-top">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Awesome Services</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-pen-nib-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UX Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-stack-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UI Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-ruler-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Logo Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-pie-chart-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Digital Marketing</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-code-box-line"></i>
                        </div>
                        <h5 class="mt-4 mb-3">Machine Learning</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="service theme-shadow p-lg-5 p-4">
                        <div class="iconbox">
                            <i class="ri-user-2-fill"></i>
                        </div>
                        <h5 class="mt-4 mb-3">UX Design</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet fugiat sunt distinctio?</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- COUNTER -->
    <!-- <section id="counter" class="section-padding">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <h1 class="text-white display-4">90,00+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Total Downloads</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <h1 class="text-white display-4">58K+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Trusted Clients</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <h1 class="text-white display-4">5M+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">THemes Designed</h6>
                </div>
                <div class="col-lg-3 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <h1 class="text-white display-4">100+</h1>
                    <h6 class="text-uppercase mb-0 text-white mt-3">Team Members</h6>
                </div>
            </div>
        </div>
    </section> -->

    <!-- PORTFOLIO -->
    <section id="portfolio" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Our Waste to Rewards Device</h1>
                        <div class="line"></div>
                        <p>Our smart waste-to-rewards device, equipped with ESP32 and sensors, transforms the act of recycling plastic bottles into a rewarding experience, allowing users to accumulate points through their account IDs for valuable prizes.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg1.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg1.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg2.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg2.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg3.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg3.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg4.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg4.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="portfolio-item image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/ProjectImg5.png')}}" alt="">
                        </div>
                        <a href="{{ Vite::asset('resources/img/ProjectImg5.png')}}" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div>
                    <!-- <div class="portfolio-item image-zoom mt-4">
                        <div class="image-zoom-wrapper">
                            <img src="./assets/images/project-6.jpg" alt="">
                        </div>
                        <a href="./assets/images/project-6.jpg" data-fancybox="gallery" class="iconbox"><i class="ri-search-2-line"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- REVIEW -->
    <section id="reviews" class="section-padding bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Testimonials</h1>
                        <div class="line"></div>
                        <p>Here are some reviews from the students and professors of our esteemed university.</p>
                    </div>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="150">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>The waste-to-rewards system is a game-changer! It makes recycling engaging and rewarding, motivating me and my peers to be more responsible with our plastic waste while earning points for prizes.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/profile.jpg')}}"alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Student</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="250">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>The waste-to-rewards system is a game-changer! It makes recycling engaging and rewarding, motivating me and my peers to be more responsible with our plastic waste while earning points for prizes.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-2.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Student</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="350">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>This innovative device not only promotes recycling but also teaches students the importance of sustainability in a fun and interactive way. It's a fantastic step toward creating environmentally conscious habits among young people</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-3.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Professor</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="450">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>This innovative device not only promotes recycling but also teaches students the importance of sustainability in a fun and interactive way. It's a fantastic step toward creating environmentally conscious habits among young people</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-4.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Professor</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="550">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>The waste-to-rewards system is a game-changer! It makes recycling engaging and rewarding, motivating me and my peers to be more responsible with our plastic waste while earning points for prizes.</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-5.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Student</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6" data-aos="fade-down" data-aos-delay="650">
                    <div class="review">
                        <div class="review-head p-4 bg-white theme-shadow">
                            <div class="text-warning">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p>This innovative device not only promotes recycling but also teaches students the importance of sustainability in a fun and interactive way. It's a fantastic step toward creating environmentally conscious habits among young people</p>
                        </div>
                        <div class="review-person mt-4 d-flex align-items-center">
                            <img class="rounded-circle" src="{{ Vite::asset('resources/img/avatar-6.jpg')}}" alt="">
                            <div class="ms-3">
                                <h5>Dianne Russell</h5>
                                <small>Professor</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Team Members</h1>
                        <div class="line"></div>
                        <p>Meet our passionate team of students dedicated to tackling plastic waste and promoting recycling.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center ">
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="150">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/profile.jpg')}}" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Adrianne John Basuel</h4>
                            <p class="mb-0 text-white">Capstone Proponent</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="250">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/profile.jpg')}}" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Adrianne John Basuel</h4>
                            <p class="mb-0 text-white">Capstone Proponent</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-down" data-aos-delay="350">
                    <div class="team-member image-zoom">
                        <div class="image-zoom-wrapper">
                            <img src="{{ Vite::asset('resources/img/profile.jpg')}}" alt="">
                        </div>
                        <div class="team-member-content">
                            <h4 class="text-white">Adrianne John Basuel</h4>
                            <p class="mb-0 text-white">Capstone Proponent</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="section-padding bg-light" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 text-white fw-semibold">Get in touch</h1>
                        <div class="line bg-white"></div>
                        <p class="text-white">We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" data-aos="fade-down" data-aos-delay="250">
                <div class="col-lg-8">
                    <form action="#" class="row g-3 p-lg-5 p-4 bg-white theme-shadow">
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="text" class="form-control" placeholder="Enter last name">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="email" class="form-control" placeholder="Enter Email address">
                        </div>
                        <div class="form-group col-lg-12">
                            <input type="text" class="form-control" placeholder="Enter subject">
                        </div>
                        <div class="form-group col-lg-12">
                            <textarea name="message" rows="5" class="form-control" placeholder="Enter Message"></textarea>
                        </div>
                        <div class="form-group col-lg-12 d-grid">
                            <button class="btn btn-brand">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG -->
    <section id="articles" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down" data-aos-delay="150">
                    <div class="section-title">
                        <h1 class="display-4 fw-semibold">Recent News & Articles</h1>
                        <div class="line"></div>
                        <p>We love to craft digital experiances for brands rather than crap and more lorem ipsums and do crazy skills</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-md-4 d-flex align-items-stretch" data-aos="fade-down" data-aos-delay="150">
                        <a href="{{ route('LandingPage.show', $article->id) }}" class="card-link" style="text-decoration: none; display: block;">
                            <div class="team-member image-zoom border-0 shadow-sm rounded d-flex flex-column" style="transition: box-shadow 0.3s ease; height: 100%;">
                                <div class="image-zoom-wrapper" style="overflow: hidden;">
                                    <img src="{{ Vite::asset('storage/app/public/' . $article->image_url) }}" alt="{{ $article->title }}" class="img-fluid" style="width: 400px; height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body p-3 flex-grow-1"> 
                                    <h5 class="mt-2" style="color: #333;">{{ $article->title }}</h5>
                                    <p style="color: #555;">{{ Str::limit($article->body, 150) }}</p>
                                </div>

                                <div class="card-footer p-3" style="color: #888;">
                                    <small>By: {{ $article->author }} on {{ $article->created_at->format('F j, Y') }}</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center my-4"> 
                    {{ $articles->fragment('articles')->links('pagination::bootstrap-5') }} 
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-3 col-sm-6">
                        <a href="#"><img src="{{ Vite::asset('resources/img/logo.png')}}" style="height: 75px; object-fill:cover; margin-top:-15px;" alt=""></a>
                        <div class="line"></div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, hic!</p>
                        <div class="social-icons">
                            <a href="#"><i class="ri-twitter-fill"></i></a>
                            <a href="#"><i class="ri-instagram-fill"></i></a>
                            <a href="#"><i class="ri-github-fill"></i></a>
                            <a href="#"><i class="ri-dribbble-fill"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">SERVICES</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">UI Design</a></li>
                            <li><a href="#">UX Design</a></li>
                            <li><a href="#">Branding</a></li>
                            <li><a href="#">Logo Designing</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">ABOUT</h5>
                        <div class="line"></div>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Company</a></li>
                            <li><a href="#">Career</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <h5 class="mb-0 text-white">CONTACT</h5>
                        <div class="line"></div>
                        <ul>
                            <li>New York, NY 3300</li>
                            <li>(414) 586 - 3017</li>
                            <li>www.example.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="footer-bottom">
            <div class="container">
                <div class="row g-4 justify-content-between">
                    <div class="col-auto">
                        <p class="mb-0">© Copyright Elixir. All Rights Reserved</p>
                    </div>
                    <div class="col-auto">
                        <p class="mb-0">Designed with 💜 By <a href="https://www.youtube.com/channel/UCYMEEnLzGGGIpQQ3Nu_sBsQ">SALMAN</a></p>
                    </div>
                </div>
            </div>
        </div> -->
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>