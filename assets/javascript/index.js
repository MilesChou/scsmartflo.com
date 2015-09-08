/**
 * Created by eric7578 on 15/8/30.
 */
$(function () {
    var $navList = $('.navbar-nav').find('li');
    var $productNav = $('.product-nav');

    $navList.click(function () {
        $navList.removeClass('current');
        $(this).addClass('current');
    });

    $('img').click(function () {
        $('#product-modal').modal();
    });
});