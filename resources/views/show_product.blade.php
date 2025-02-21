@extends('layouts.app')

@section('content')
<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ url('storage/images/' . $product->image) }}" alt="IMG-PRODUCT">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $product->name }}
                    </h4>

                    <span class="mtext-106 cl2">
                        $ {{ number_format($product->price, 0, ',', '.') }}
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        {{ $product->description }}
                    </p>

                    <form action="{{ route('add_to_cart', $product) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <button type="button" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </button>

                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock ?? PHP_INT_MAX }}">

                                    <button type="button" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </button>
                                </div>

                                <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!--  -->
                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                    <div class="flex-m bor9 p-r-10 m-r-11">
                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                            <i class="zmdi zmdi-favorite"></i>
                        </a>
                    </div>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bor10 m-t-50 p-t-43 p-b-40">
        <!-- Tab01 -->
        <div class="tab01">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item p-b-10">
                    <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
                </li>

                <li class="nav-item p-b-10">
                    <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-t-43">
                <!-- - -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="how-pos2 p-lr-15-md">
                        <p class="stext-102 cl6">
                        {{ $product->description }}
                        </p>
                    </div>
                </div>

                <!-- - -->
                <div class="tab-pane fade" id="information" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                            <ul class="p-lr-28 p-lr-15-sm">
                                <li class="flex-w flex-t p-b-7">
                                    <span class="stext-102 cl3 size-205">
                                        Weight
                                    </span>

                                    <span class="stext-102 cl6 size-206">
                                        0.79 kg
                                    </span>
                                </li>

                                <li class="flex-w flex-t p-b-7">
                                    <span class="stext-102 cl3 size-205">
                                        Dimensions
                                    </span>

                                    <span class="stext-102 cl6 size-206">
                                        110 x 33 x 100 cm
                                    </span>
                                </li>

                                <li class="flex-w flex-t p-b-7">
                                    <span class="stext-102 cl3 size-205">
                                        Materials
                                    </span>

                                    <span class="stext-102 cl6 size-206">
                                        60% cotton
                                    </span>
                                </li>

                                <li class="flex-w flex-t p-b-7">
                                    <span class="stext-102 cl3 size-205">
                                        Color
                                    </span>

                                    <span class="stext-102 cl6 size-206">
                                        Black, Blue, Grey, Green, Red, White
                                    </span>
                                </li>

                                <li class="flex-w flex-t p-b-7">
                                    <span class="stext-102 cl3 size-205">
                                        Size
                                    </span>

                                    <span class="stext-102 cl6 size-206">
                                        XL, L, M, S
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- - -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                            <div class="p-b-30 m-lr-15-sm">
                                <!-- Review -->
                                <div class="flex-w flex-t p-b-68">
                                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                        <img src="images/avatar-01.jpg" alt="AVATAR">
                                    </div>

                                    <div class="size-207">
                                        <div class="flex-w flex-sb-m p-b-17">
                                            <span class="mtext-107 cl2 p-r-20">
                                                Ariana Grande
                                            </span>

                                            <span class="fs-18 cl11">
                                                <i class="zmdi zmdi-star"></i>
                                                <i class="zmdi zmdi-star"></i>
                                                <i class="zmdi zmdi-star"></i>
                                                <i class="zmdi zmdi-star"></i>
                                                <i class="zmdi zmdi-star-half"></i>
                                            </span>
                                        </div>

                                        <p class="stext-102 cl6">
                                            Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                                        </p>
                                    </div>
                                </div>

                                <!-- Add review -->
                                <form class="w-full">
                                    <h5 class="mtext-108 cl2 p-b-7">
                                        Add a review
                                    </h5>

                                    <p class="stext-102 cl6">
                                        Your email address will not be published. Required fields are marked *
                                    </p>

                                    <div class="flex-w flex-m p-t-50 p-b-23">
                                        <span class="stext-102 cl3 m-r-16">
                                            Your Rating
                                        </span>

                                        <span class="wrap-rating fs-18 cl11 pointer">
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <input class="dis-none" type="number" name="rating">
                                        </span>
                                    </div>

                                    <div class="row p-b-25">
                                        <div class="col-12 p-b-5">
                                            <label class="stext-102 cl3" for="review">Your review</label>
                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                                        </div>

                                        <div class="col-sm-6 p-b-5">
                                            <label class="stext-102 cl3" for="name">Name</label>
                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                                        </div>

                                        <div class="col-sm-6 p-b-5">
                                            <label class="stext-102 cl3" for="email">Email</label>
                                            <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            SKU: JAK-01
        </span>

        <span class="stext-107 cl6 p-lr-25">
            Categories: Jacket, Men
        </span>
    </div>
</section>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<script src="vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/slick-custom.js') }}"></script>
<script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
<script>
    $('.parallax100').parallax100();
</script>
<script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
<script>
    $('.gallery-lb').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $('.js-addwish-b2, .js-addwish-detail').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist!", "success");
            $(this).addClass('js-addedwish-b2').off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist!", "success");
            $(this).addClass('js-addedwish-detail').off('click');
        });
    });

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart!", "success");
        });
    });
</script>
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative').css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        });
    });
</script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection