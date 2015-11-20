var mazvitaPlayground = function () {

    function events() {
        $(document).on("click", ".pg-toggle", function (e) {
            e.preventDefault();
            if ($('.playground').hasClass('opened')) {
                $('.playground').removeClass('opened');
                //$('.playground > .options').hide();
                $(this).animate({
                    'right': 0
                }, 300, "easeInOutExpo");
            } else {
                $('.playground').addClass('opened');
                //$('.playground > .options').show();
                $(this).animate({
                    'right': -40
                }, 300, "easeInOutExpo");
            }
        });

        $(document).on("click", ".pg-close", function (e) {
            e.preventDefault();
            if ($('.playground').hasClass('opened')) {
                $('.playground').removeClass('opened');
                //$('.playground > .options').hide();

                $(".pg-toggle").animate({
                    'right': 0
                }, 300, "easeInOutExpo");

            }
        });

        $(document).on("click", ".playground .font-options a", function (e) {
            e.preventDefault();

            var value = $(this).attr('href');

            $(".font-options").find("a").removeClass("active");

            $(this).addClass("active");

            $("#font").attr('href', value);
        });

        $(document).on("click", ".playground .header-options a", function (e) {
            e.preventDefault();

            var value = $(this).attr('id');

            if (value === "header-dark") {
                $(".header").addClass("header-dark");
            } else {
                $(".header").removeClass("header-dark");
            }

            $(".header-options").find("a").removeClass("active");

            $(this).addClass("active");
        });

        $(document).on("click", ".playground .color-options > a", function (e) {
            e.preventDefault();

            var value = $(this).attr('href');

            $(".color-options").find("a").removeClass("active");

            $(this).addClass("active");

            $("#skin").attr('href', value);

        });
    }

    return {
        init: function () {
            events();
        }
    };
}();

$(function () {
    "use strict";
    mazvitaPlayground.init();
});