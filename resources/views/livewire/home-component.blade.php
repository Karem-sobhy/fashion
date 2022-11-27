<main>
    <!-- Start Slider -->
    <section class="slider">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slider/1.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-text">
                        <span>Something Is Better</span>
                        <span>Fashion Lorrem</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider/2.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-text">
                        <span>Something Is Better</span>
                        <span>Fashion Lorrem</span>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slider/3.jpg" class="d-block w-100" alt="..." />
                    <div class="carousel-text">
                        <span>Something Is Better</span>
                        <span>Fashion Lorrem</span>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <i class="fa-regular fa-circle-left fs-1 text-dark"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <i class="fa-regular fa-circle-right fs-1 text-dark"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- End Slider -->
    <!-- Start First Section -->
    <section class="section first-section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-12 col-md-5 order-md-last">
                    <div class="row d-flex flex-md-column justify-content-center align-items-center">
                        <div class="col-6 col-md-12">
                            <div class="first-img pb-md-5">
                                <img class="w-100"
                                    src="assets/img/first-section/81758042c051a4f6273c028de8fbac2a--mens-fashion-accessories-fashion-clothes.jpg"
                                    alt="" />
                            </div>
                        </div>
                        <div class="col-6 col-md-12">
                            <div class="second-img">
                                <img class="w-100"
                                    src="assets/img/first-section/1guide-ultime-bien-porter-acheter-chemise-formelle-homme-selection-isaia.jpg"
                                    alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="single-img">
                        <img class="w-100" src="assets/img/first-section/blog-teen-vogue-daily-mkerr.jpg"
                            alt="" />
                    </div>
                    <div class="content">
                        <span class="content-hot">Hot Collection</span>
                        <h2 class="content-title">New Trend For Women</h2>
                        <p class="text-wrap">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Pariatur reprehenderit <br />
                            adipisci minus, tenetur voluptas natus at harum quasi.
                            Dignissimos <br />
                            explicabo ex corrupti
                        </p>
                        <a href="{{ route('home.shop') }}" class="btn btn-outline-dark rounded-0 px-5 py-2">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End First Section -->
    <!-- Start Featured Section -->
    @livewire('featured-items-component', ['home' => true])
    <!-- end Featured Section -->
    <!-- Start Offer Section -->
    <section class="offer-section">
        <div class="row banners g-0">
            <div class="banner-1 col-12 col-md-6">
                <img src="assets/img/offer/Rectangle 15.png" alt="" />
                <div class="arrow-up"></div>
                <div class="overlay"></div>
                <div class="text-box">
                    <div class="d-flex h-100">
                        <div class="col-6 ms-auto d-flex align-items-center">
                            <div class="text">
                                <span>70%</span><span>OFF</span><br /><span>Tao Kinben Na?</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-2 col-md-6">
                <img src="assets/img/offer/image.png" alt="" />
                <div class="arrow-down"></div>
                <div class="overlay"></div>
                <div class="text-box">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="text-center">
                            <span>Amr Chehara Kharap Na</span>
                            <span class="me-2">Chehara</span>
                            <span>Dia Ki Hoy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Offer Section -->
    <!-- Start Latest Section -->
    @livewire('latest-items-component')
    <!-- End Latest Section -->
    <!-- Start Testimonials Section -->
    <section class="section testimonials-section">
        <div class="banner">
            <img src="assets/img/testimonials/Layer 21.png" alt="" class="w-100" />
            <div class="text-box">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="content text-center">
                        <span class="mb-5 d-inline-block"><i class="fa-solid fa-quote-left"></i></span>
                        <p class="mb-5">
                            “Nunc vulputate odio vitae sapien euismod rhoncus.
                            <br class="d-none d-md-block" />
                            Vestibulum a N Vestibulum a
                        </p>

                        <img src="assets/img/testimonials/Layer 22.png" alt="" />

                        <span class="d-block mt-2 ceo">MD SHAHIN ALAM</span>
                        <span class="d-block job">Ceo Of TTCM</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->
</main>
