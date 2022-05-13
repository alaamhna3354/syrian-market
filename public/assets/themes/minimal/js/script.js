"use strict";
var $ = $.noConflict();
$(document).ready(function(){
    var bootstrapButton = $.fn.button.noConflict();
    $.fn.bootstrapBtn = bootstrapButton;
    $('.nav-registration li a').on('mouseenter',function(){
        $(this).parents('.nav-registration').find('.active.nav-link').removeClass('active');
        $(this).addClass('active');
    });

    $('.nav-registration li a').on('mouseleave', function(){
        $('.nav-registration').find('.nav-link').removeClass('active');
        $('.nav-registration').find('.nav-link:eq(1)').addClass('active');
    });

    $('.navbar-toggler').on('click',function(){
        $(this).toggleClass('custom-toggler');
    });

    $(".btn-play").on('click', function(e) {
        e.preventDefault();
        $("#modal-video").toggleClass("modal-open");
    });

    $(".modal-content").on('click',function(e){
        e.stopPropagation();
    });

    $(".modal-wrapper").on('click', function(e) {
        e.preventDefault();
        $("#modal-video").removeClass("modal-open");
    });

    $(".btn-close").on('click',function(){
        $("#modal-video").removeClass("modal-open");
    });

    $('.close').on('click', function () {
        $(".modal").modal("toggle");
    });

    $(".team-slider").each(function() {
        $(this).owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            margin: 30,
            autoplay: false,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive:{
                0:{
                    items: 1,
                    nav: false,
                },
                575:{
                    items: 1,
                    nav: false,
                },
                576:{
                    items: 2,
                },
                767:{
                    items: 2,
                },
                991:{
                    items: 2,
                },
                992:{
                    items: 3,
                }
            }
        });
    });

    $('.play').on('click', function() {
        owl.trigger('play.owl.autoplay', [1000])
    });

    $('.stop').on('click', function() {
        owl.trigger('stop.owl.autoplay')
    });

});
