var mySwiper;
$(document).ready(function () {
    mySwiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        grabCursor: true
    });

    $(window).resize(function() {
        if(this.resizeTO) clearTimeout(this.resizeTO);
        this.resizeTO = setTimeout(function() {
            $(this).trigger('resizeEnd');
        }, 100);
    });

    adaptSwiper();
    $(window).bind('resizeEnd', adaptSwiper);
});

function adaptSwiper() {
        var num;
        if(window.innerWidth > 991)
            num = 3;
        else
            num = 1;
        updateSwiper(num);
}

function updateSwiper(num) {
    mySwiper.params.slidesPerView = num;
    mySwiper.update();
}

