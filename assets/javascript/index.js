/**
 * Created by eric7578 on 15/8/30.
 */
$(function () {
    var $navList = $('.navbar-list').find('li');

    $navList.click(function () {
        $navList.removeClass('current');
        $(this).addClass('current');
    });

    var $products = $('.products');
    var $contactUs = $('.contact-us');
    var $introContent = $('.intro-content');
    $(window).on('resize', function () {
        $products.css('height', $(this).height());
        $contactUs.css('height', $(this).height());
        console.log($(this).width())
        $introContent.css('height', $(this).width() * 400 / 1024);
    });

    $('.intro-carousel').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 5000,
        prevArrow: $('.prev-btn'),
        nextArrow: $('.next-btn')
    });

    var $productNow = $('.product-now').detach();

    $('.product-item').click(function () {
        $(this).after($productNow);
        $productNow.fadeIn('slow', function () {
            alert('123')
        });
    })

});