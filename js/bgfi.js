/**
 * Created by Alexandre on 4/29/2016.
 */
//main carousel
var mainCarousel = jQuery('#carousel .owl-carousel');
mainCarousel.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    lazyLoad: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoplayHoverPause: true,
    autoplayTimeout: 8000
});

//carousel section actualité
var actualiteCarousel = jQuery('.actualite .owl-carousel');
actualiteCarousel.owlCarousel({
    items: 1,
    loop: true,
    nav: true,
    lazyLoad: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoplayHoverPause: true,
    navText: ['Précédent', 'Suivant']
});

//Product carousel
var productCarousel = jQuery('#product-carousel .owl-carousel');

productCarousel.owlCarousel({
    items:1,
    loop: true,
    autoplay: true
});

//Page actualité main carousel
var actualiteMainCarousel = jQuery('.news_carousel .owl-carousel');
/*
 actualiteMainCarousel.owlCarousel({
 items: 1,
 loop: true,
 autoplay: true,
 lazyLoad: true,
 autoplayTimeout: 8000,
 autoplayHoverPause: true,
 dotsContainer: '.carousel-thumbnails'
 });
 */

var viewportWidth = jQuery(document).width();
jQuery(function () {
    if(viewportWidth >= 768){
        actualiteMainCarousel.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            lazyLoad: true,
            autoplayTimeout: 8000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplayHoverPause: true,
            dotsContainer: '.carousel-thumbnails'
        });
    }
    else {
        actualiteMainCarousel.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            lazyLoad: true,
            autoplayTimeout: 8000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            autoplayHoverPause: true
        });
    }
})



//Country switcher
var switcher = jQuery('.countrySwitcher button'),
    countryOptions = jQuery('#countryList');

countryOptions.find('li').each(function () {
    jQuery(this).click(function () {
        var countryName = jQuery(this).html();
        switcher.html(countryName);
    })
})
