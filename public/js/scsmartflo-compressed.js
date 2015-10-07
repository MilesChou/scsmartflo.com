/*
 * Placeholder plugin for jQuery
 * ---
 * Copyright 2010, Daniel Stocks (http://webcloud.se)
 * Released under the MIT, BSD, and GPL Licenses.
 */
(function($) {
    function Placeholder(input) {
        this.input = input;
        if (input.attr('type') == 'password') {
            this.handlePassword();
        }
        // Prevent placeholder values from submitting
        $(input[0].form).submit(function() {
            if (input.hasClass('placeholder') && input[0].value == input.attr('placeholder')) {
                input[0].value = '';
            }
        });
    }
    Placeholder.prototype = {
        show: function(loading) {
            // FF and IE saves values when you refresh the page. If the user refreshes the page with
            // the placeholders showing they will be the default values and the input fields won't be empty.
            if (this.input[0].value === '' || (loading && this.valueIsPlaceholder())) {
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'text');
                    } catch (e) {
                        this.input.before(this.fakePassword.show()).hide();
                    }
                }
                this.input.addClass('placeholder');
                this.input[0].value = this.input.attr('placeholder');
            }
        },
        hide: function() {
            if (this.valueIsPlaceholder() && this.input.hasClass('placeholder')) {
                this.input.removeClass('placeholder');
                this.input[0].value = '';
                if (this.isPassword) {
                    try {
                        this.input[0].setAttribute('type', 'password');
                    } catch (e) {}
                    // Restore focus for Opera and IE
                    this.input.show();
                    this.input[0].focus();
                }
            }
        },
        valueIsPlaceholder: function() {
            return this.input[0].value == this.input.attr('placeholder');
        },
        handlePassword: function() {
            var input = this.input;
            input.attr('realType', 'password');
            this.isPassword = true;
            // IE < 9 doesn't allow changing the type of password inputs
            if ($.browser.msie && input[0].outerHTML) {
                var fakeHTML = $(input[0].outerHTML.replace(/type=(['"])?password\1/gi, 'type=$1text$1'));
                this.fakePassword = fakeHTML.val(input.attr('placeholder')).addClass('placeholder').focus(function() {
                    input.trigger('focus');
                    $(this).hide();
                });
                $(input[0].form).submit(function() {
                    fakeHTML.remove();
                    input.show()
                });
            }
        }
    };
    var NATIVE_SUPPORT = !! ("placeholder" in document.createElement("input"));
    $.fn.placeholder = function() {
        return NATIVE_SUPPORT ? this : this.each(function() {
            var input = $(this);
            var placeholder = new Placeholder(input);
            placeholder.show(true);
            input.focus(function() {
                placeholder.hide();
            });
            input.blur(function() {
                placeholder.show(false);
            });

            // On page refresh, IE doesn't re-populate user input
            // until the window.onload event is fired.
            if ($.browser.msie) {
                $(window).load(function() {
                    if (input.val()) {
                        input.removeClass("placeholder");
                    }
                    placeholder.show(true);
                });
                // What's even worse, the text cursor disappears
                // when tabbing between text inputs, here's a fix
                input.focus(function() {
                    if (this.value == "") {
                        var range = this.createTextRange();
                        range.collapse(true);
                        range.moveStart('character', 0);
                        range.select();
                    }
                });
            }
        });
    }
})(jQuery);
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
                    .data('productId', productData.id)
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
            href: '/product/get-info/' + $showTarget.data('id'),
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