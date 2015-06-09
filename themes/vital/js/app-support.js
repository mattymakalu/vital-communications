$(document).ready(function() {
    if($('.slider').length) {
        $('.slider').slick({
            dots: true,
            speed: 500,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 3000
        });
    };

    if($('.slider-manual').length) {
        imagesLoaded( $('.slider-manual'),function(){
            $('.slider-manual').slick({
                dots: true,
                speed: 500,
                adaptiveHeight: true
            });
        });
    };

    $('.service-card-grid a, .team-grid a').each(function(key){
        var type = $(this).data('type');

        $(this).magnificPopup({
            items: {
                src: $(this).find('.popup'),
                type: 'inline'
            }
        });
    });

    $(document).on('click', '.popup__gallery-link', function(){
        var location = $(this).data('location');
        $(location).trigger('click');
    });

    $.fn.almComplete = function(alm){
        console.log(alm);
        var newElements = $('.alm-reveal').find('.item');

        // append elements to container
        $packeryContainer.append( newElements );
        // add and lay out newly appended elements
        $packeryContainer.packery( 'appended', newElements );
        $packeryContainer.packery( 'layout' );
    }

    var maps = $('.gmap');
    maps.each(function(){
        var $this = $(this);
        var map = new GMaps({
            div: $this.attr('id'),
            lat: $this.data('lat'),
            lng: $this.data('lng'),
            scrollwheel: false
        });

        map.addMarker({
            lat: $this.data('lat'),
            lng: $this.data('lng'),
            icon: $this.data('icon')
        });
    });
});