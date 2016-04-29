require(['jquery'],function($) {
    $(function () {
        $(".rslides").responsiveSlides({
            auto: true,
            pager: false,
            speed: 500,
            maxwidth: 800,
        });
        $(".rslides").css('max-width', 'none');
    });
});