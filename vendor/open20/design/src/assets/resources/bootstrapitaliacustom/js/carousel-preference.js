$('.it-carousel-landscape-abstract-four-cols .owl-carousel').owlCarousel({
  margin: 40,
  items: 4,
  responsiveClass: true,
  stagePadding: 30,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    550: {
      items: 2,
      nav: true
    },
    767: {
      items: 2,
      nav: true
    },
    992: {
      items: 3,
      nav: true,
      loop: false
    },
    1200: {
      items: 4,
      nav: true,
      loop: false
    }
  }

})
$('.it-carousel-landscape-abstract-one-cols .owl-carousel').owlCarousel({
  margin: 40,
  items: 1,
  responsiveClass: true,
  stagePadding: 30,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    550: {
      items: 1,
      nav: true
    },
    767: {
      items: 1,
      nav: true
    },
    992: {
      items: 1,
      nav: true,
      loop: false
    },
    1200: {
      items: 1,
      nav: true,
      loop: false
    }
  }

})
$( ".owl-prev").html('<span class="mdi mdi-chevron-left"></span>');
$( ".owl-next").html('<span class="mdi mdi-chevron-right"></span>');