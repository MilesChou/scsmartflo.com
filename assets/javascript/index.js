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

    //placeholder
    $contactUs.find('.form-control').placeholder();

    //導覽列
    var $navbarItem = $('.navbar-item');

    $navbarItem.click(function () {
        var $this = $(this);
        $navbarItem.removeClass('current');
        $this.addClass('current');
        $body.animate({ scrollTop: $('.' + $this.data('target')).position().top }, "slow");
    });

    var $introContent = $('.intro-content');
    var $productContainer = $('.product-container');
    var $contactForm = $('.contact-form');
    var $form = $contactForm.find('form');

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
        })
        .click(function () {
            $('.navbar-item[data-target=products]').click();
        });

    function setupCurrentCarousel (idx) {
        $introContent.removeClass('current')
            .eq(idx).addClass('current');
    }

    $productKindList.click(function () {
        $productKindList.removeClass('current');
        $(this).addClass('current');
        $.getJSON('/api/v1/get-product', { kind: $(this).data('kind') }, function (data) {
            $productContainer.empty();
            for (var i = 0, len = data.length; i < len; i++) {
                var productData = data[i];
                var $product = $('<div/>')
                    .data('id', productData.id)
                    .addClass('product-item');

                //img
                $('<img/>')
                    .attr('src', '/upload/' + productData.pic)
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
    $productContainer.on('click', '.product-item', function () {
        showProductDetail($(this));
    });

    function showProductDetail ($showTarget) {
        $.fancybox.open({
            padding: 0,
            width: 'auto',
            height: 'auto',
            href: '/product/get-info/id/' + $showTarget.data('id'),
            type: 'ajax',
            wrapCSS: 'product-detail',
            closeBtn: false,
            afterShow: function () {
                var $productDetail = $('.product-detail');
                $productDetail
                    .on('click', '.btn-close', function () {
                        $.fancybox.close()
                    })
                    .on('click', '.btn-ask', function () {
                        $.fancybox.close();
                        $navbarItem.filter('[data-target=contact-us]').click();
                        var productName = $productDetail.find('.product-describe h3').text();
                        $contactForm.find('#title').val('About: ' + productName);
                    });
            },
            beforeClose: function () {
                $('.product-detail').off('click');
            }
        });
    }

    $form.validate({
        rules: {
            username: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            title: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            username: {
                required: 'required',
                minlength: 'at least 2 characters'
            },
            email: {
                required: "required",
                email: "invalid email",
            },
            title: {
                required: 'required',
                minlength: 'at least 2 characters'
            }
        },
        submitHandler: function () {
            $.post('/api/v1/faq', $form.serializeArray(), function () {
                alert('Thank you for the interest!');
            })
        }
    });
});
