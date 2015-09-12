/**
 * Created by eric7578 on 15/8/30.
 */
$(function () {
    var $body = $('body');
    //主容器
    var $container = $('.container');
    //公司介紹
    var $intro = $('.intro');
    //產品分類列表
    var $productKindList = $('.products-kinds li');
    //聯絡我們
    var $contactUs = $('.contact-us');
    //導覽列
    var $navbarItem = $('.navbar-item');

    $navbarItem.click(function () {
        var $this = $(this);
        $navbarItem.removeClass('current');
        $this.addClass('current');
        $body.animate({ scrollTop: $('.' + $this.data('target')).position().top }, "slow");
    });

    var $products = $('.products');
    var $introContent = $('.intro-content');
    var $productDetail = $('.product-detail');
    var $productItem = $('.product-item');
    var $productContainer = $('.product-container');
    var $productDetailContainer = $productDetail.find('.product-detail-container');
    var $contactForm = $('.contact-form');

    $('.intro-carousel')
        .slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            prevArrow: $('.prev-btn'),
            nextArrow: $('.next-btn')
        })
        .on('init', function () {
            setupCurrentCarousel(0);
        })
        .on('afterChange', function (event, $slick, next) {
            setupCurrentCarousel(next);
        });

    function setupCurrentCarousel (idx) {
        $introContent.removeClass('current')
            .eq(idx).addClass('current');
    }

    $productKindList.click(function () {
        $productKindList.removeClass('current');
        $(this).addClass('current');
        $.getJSON('/api/v1/get-product', function (data) {
            $productContainer.empty();
            for (var i = 0, len = data.length; i < len; i++) {
                var productData = data[i];
                var $product = $('<div/>')
                    .data('productId', productData.id)
                    .addClass('product-item');

                //img
                $('<img/>')
                    .attr('src', '/img/' + productData.id + '.jpg')
                    .appendTo($product);

                //name
                $('<div/>')
                    .addClass('product-name')
                    .text(productData.name)
                    .appendTo($product);

                //describe
                $('<div/>')
                    .addClass('product-describe')
                    .text(productData.description)
                    .appendTo($product);

                $productContainer.append($product);
            }
        });
    });

    //預設關閉
    $productDetail.hide().addClass('hide');

    $productContainer.on('click', '.product-item', function () {
        showProductDetail($(this));
    });

    $productDetail
        .on('click', '.btn-close', function () {
            hideProductDetail();
        })
        .on('click', '.btn-ask', function () {
            askProductDetail();
        })
        .on('click', '.product-image, .product-describe, .btn-set', function (e) {
            e.stopPropagation();
        })
        .click(function () {
            hideProductDetail();
        });

    function askProductDetail () {
        $navbarItem.filter('[data-target=contact-us]').click();
        var productName = $productDetail.find('.product-describe h3').text();
        $contactForm.find('#title').val('About: ' + productName);
    }

    function hideProductDetail () {
        $productDetail.fadeOut(500, function () {
            $productDetail.toggleClass('hide');
        });
    }

    function showProductDetail ($showTarget) {
        var $productDescribe = $productDetail.find('.product-describe');
        $productDescribe.find('h3').text($showTarget.find('.product-name').text());
        $productDescribe.find('p').text($showTarget.find('.product-describe').text());
        $productDetail.toggle(0, function () {
            $productDetail.toggleClass('hide');
        });
    }

});