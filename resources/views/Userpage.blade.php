<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @extends('layouts.Link')
    <link rel="stylesheet" href="/css/Userpage.css">
    <title>User Page</title>

</head>

<body>
    <div class="body">
        <div class="leftbody">
            <div class="linkus2">
                <i class="bi bi-arrow-bar-left"></i>
                <p class="fixtxt">Hide Menu</p>
            </div>
            <!-- <p class="content">USER</p> -->
            <a class="linkus" href="{{ route('profileuser.page') }}">
                <i class="bi bi-person"></i>
                <p class="fixtxt">{{ $user->email }}</p>
            </a>
            <a class="linkus" href="{{ route('cart.page') }}" id="linkusmobile">
                <i class="bi bi-cart"></i>
                <p class="fixtxt">Cart</p>
            </a>
            <a class="linkus" href="{{ route('user.message') }}" id="linkusmobile">
                <i class="bi bi-chat"></i>
                <p class="fixtxt">Chat</p>
            </a>
            <a class="linkus" href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-in-left"></i>
                <p class="fixtxt">Logout</p>
            </a>
            <hr style="border:1px solid white; width:100%" class="hrmobile">
            <p class="content">CATEGORY</p>
            <!-- Kiểm tra xem đã chọn category chưa , chưa thì active để đổi background color -->
            <div class="linkus active" data-url="0">
                <i class="bi bi-list-ul"></i>
                <p class="fixtxt">All product</p>
            </div>
            @foreach($category as $category)
            <!--Kiểm tra xem category có tồn tại không, nếu chưa chọn thì ko thêm active, Nếu đã chọn category thì thêm active vào -->
            <div class="linkus" data-url="{{ $category->idcategory }}">
                <i class="{{ $category->iconcategory }}"></i>
                <p class="fixtxt">{{ $category->namecategory }}</p>
            </div>
            @endforeach
        </div>
        <div class="rightbody">
            <div class="headright">
                <a href="{{ route('user.page') }}" id="logotable"><img src="/images/logo.png"></a>
                <div class="lefthead">
                    <input class="search" type="text" placeholder="Search">
                </div>
                <div class="righthead">
                    <i class="bi bi-arrow-bar-right"></i>
                    <a href="{{ route('user.message') }}" class="btnlink"><i class="bi bi-chat"
                            style="color: #FFFFFF;font-size: 1.5em;"></i></a>
                    <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                        </button>
                        <ul class="dropdown-menu">
                            @if(empty($notification))
                            <li class="dropdown-item dropdown-item-ignore-close" style="justify-content:center">
                                <span>Nothing Here!</span>
                            </li>
                            @else
                            @foreach($notification as $notification)
                            <li class="dropdown-item dropdown-item-ignore-close">
                                <img src="{{ $notification->image }}" class="noti">
                                <div style="display:flex;flex-direction:column">
                                    <span class="notimobile"
                                        style="font-weight: 500;color:{{ $notification->status == 2 ? 'green' : ($notification->status == 1 ? 'orange' : 'red') }}">
                                        {{ $notification->notification }}
                                    </span>
                                    <span class="notimobile2"
                                        style="font-weight: 400; font-size:10px;margin-top:.25em">{{ $notification->updated_at }}</span>
                                </div>
                            </li>
                            <br>
                            <!-- <hr style="border:.5px solid black;margin-bottom:0 !important"> -->
                            @endforeach
                            @endif
                            <!-- <hr>
                            <li class="dropdown-item dropdown-item-ignore-close"
                                style="justify-content:center; height:2em !important">
                                <a href="{{ route('order.page') }}" style="font-weight: 400">See more</a>
                            </li> -->
                        </ul>
                    </div>
                    <!-- <a href="" class="btnlink"><i class="bi bi-bell"></i></a> -->
                    <a href="{{ route('cart.page') }}" class="btnlink"><i class="bi bi-cart"
                            style="color: #FFFFFF;font-size: 1.5em;"></i></a>
                    <a href="{{ route('profileuser.page') }}"><img src="{{ $user->avatar }}" class="avataruser"></a>
                </div>

            </div>
            <div class="bodyright">
                <!-- <a href="" class="loc active">All</a> -->
                <div href="" class="loc active" data-url="0">Price <i class="bi bi-arrow-up"></i></div>
                <div href="" class="loc" data-url="1">Price <i class="bi bi-arrow-down"></i></div>
                @error('fail')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="allmonhang">
                @foreach($products as $product)
                <div class="monhang">
                    <a href="#" class="popup-link" data-popup="#popup-{{ $product->idproduct }}">
                        <img src="{{ $product->image }}" class="imgsp">
                    </a>
                    <p class="namesp">{{ $product->nameproduct }}</p>
                    <p class="namehangsp">{{ $product->category->namecategory }}</p>
                    <p class="price">${{ $product->price }}</p>
                    <a href="{{ route('cart.add', ['idproduct' => $product->idproduct]) }}" class="addtocart"><i
                            class="bi bi-plus-circle"></i> Add to cart</a>
                    <span class="tonkho">Available: {{ $product->inventoryquantity}}</span>
                </div>
                <div id="popup-{{ $product->idproduct }}" class="popup">
                    <div class="popup-content">
                        <a href="#" class="close-popup"><i class="bi bi-x-circle"></i> Close</a>
                        <p class="price">{{ $product->nameproduct }}</p>
                        <img src="{{ $product->image }}" class="imgsp2">
                        <p class="review">{{ $product->review }}</p>
                        <p class="price">${{ $product->price }}</p>
                        <span class="tonkho2">Available: {{ $product->inventoryquantity}}</span>
                        <a href="{{ route('cart.add', ['idproduct' => $product->idproduct]) }}" class="addtocart"><i
                                class="bi bi-plus-circle"></i> Add to cart</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <button id="back-to-top" title="Back to Top"><i class="bi bi-arrow-bar-up"></i></button>


    @extends('layouts.Foot')
    <script>
    //ngăn chặn việc đóng dropdown khi chỉ bấm vào phần tử bên trong
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownItemsIgnoreClose = document.querySelectorAll('.dropdown-item-ignore-close');
        dropdownItemsIgnoreClose.forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    });

    $(document).ready(function() {
        // Lắng nghe sự kiện click trên các div có class "linkus" để lọc sản phẩm theo category
        $(".linkus").on("click", function() {
            // Lấy giá trị từ thuộc tính "data-value" của div đang được click
            var idcategory = $(this).data('url'); // Lấy giá trị của thuộc tính data-url của thẻ div
            var idprice = $('.loc.active').data('url');
            // Xóa class "active" trên tất cả các div có class "btn"
            $(".linkus").removeClass("active");
            // Thêm class "active" vào div được click
            $(this).addClass("active");
            updateProductList(idcategory, idprice);
        });

        $(".loc").on("click", function() {
            var idprice = $(this).data('url');
            var idcategory = $('.linkus.active').data('url');
            $(".loc").removeClass("active");
            $(this).addClass("active");
            updateProductList(idcategory, idprice);
        });

        function updateProductList(idcategory, idprice) {
            $.ajax({
                type: 'POST',
                url: '/Userpage/' + idcategory + '/' + idprice,
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(response) {
                    var html = response.html;
                    $('.allmonhang').html(html);
                },
                error: function(xhr, status, error) {}
            });
        }


    });

    $(".linkus, .loc").on("click", function() {
        $(".search").val(""); //khi bấm 1 trong 2 nút thì giá trong ô input đc reset
    });

    //Lắng nghe sự kiện nhập vào ô tìm kiếm
    $('.search').on('input', function() {
        var search = $(this).val();
        var idcategory = $('.linkus.active').data('url');
        var idprice = $('.loc.active').data('url');
        // if (!search) {
        //     search = '';
        // } 

        $.ajax({
            type: 'POST',
            url: '/Userpage/' + idcategory + '/' + idprice + '/' + search,
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                var html = response.html;
                $('.allmonhang').html(html);
            },
            error: function(xhr, status, error) {}
        });
    });

    $(".linkus2").on("click", function() {
        $(".leftbody,.linkus,.linkus2").css({
            "padding": "0",
            "visibility": "hidden",
            "width": "0",
            "transition": "width 2s ease"
        });
        $(".rightbody").css({
            "width": "100%"
        });
        $(".bi-arrow-bar-right").css({
            "visibility": "visible",
        });
        // if ($(window).width() > 768) {
        //     $(".bi-chat").css({
        //         "margin-right": "0"
        //     });
        // }
    });

    $(".bi-arrow-bar-right").on("click", function() {
        $(".leftbody, .linkus, .linkus2").css({
            "width": "",
            // "transition": "visibility 1.5s ease",
            "transition": "width 1.5s ease"
        });
        $(".rightbody").css({
            "width": ""
        });
        $(".bi-arrow-bar-right").css({
            "visibility": "",
        });
        // if ($(window).width() > 768) {
        //     $(".bi-chat").css({
        //         "margin-right": "0"
        //     });
        // }

        setTimeout(function() {
            $(".leftbody, .linkus, .linkus2").css({
                "padding": "",
                "visibility": "",
            });
        }, 1000); // 1.5 giây
    });


    // Gán sự kiện click cho phần tử có class "popup-link"
    $(document).on('click', '.popup-link', function(e) {
        e.preventDefault();
        var popupId = $(this).data('popup');
        $(popupId).fadeIn();
    });

    // Gán sự kiện click cho phần tử có class "close-popup"
    $(document).on('click', '.close-popup', function(e) {
        e.preventDefault();
        $(this).closest('.popup').fadeOut();
    });

    // Đóng popup khi bấm ngoài popup-content
    $(document).on('click', '.popup, .close-popup', function(event) {
        if ($(event.target).is('.popup, .close-popup') && !$(event.target).closest('.popup-content').length) {
            $('.popup').fadeOut();
        }
    });

    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 20) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top').click(function() {
            $('html, body').animate({scrollTop : 0}, 500);
            return false;
        });
    });
    </script>
</body>

</html>