$(document).ready(function(){
  $(".msc-top-loaction-image").first().addClass("msc-active-img");
  $(".msc-top-loaction-image").hover(function () {
      $(".msc-top-loaction-image").removeClass("msc-active-img");
      $(this).addClass("msc-active-img");
    }, function () {
      $(this).removeClass("msc-active-img");
      $(".msc-top-loaction-image").first().addClass("msc-active-img");
    }
  );
})

$(document).ready(function(){
  $(".msc-top-loaction-image").first().find(".msc-overlay-top-property").addClass("msc-overlay-show");
  $(".msc-top-loaction-image").hover(function () {
    $(".msc-overlay-top-property").removeClass("msc-overlay-show");
    $(this).find(".msc-overlay-top-property").addClass("msc-overlay-show");
    }, function () {
      $(this).find(".msc-overlay-top-property").removeClass("msc-overlay-show");
      $(".msc-top-loaction-image").first().find(".msc-overlay-top-property").addClass("msc-overlay-show");
    }
  );
});

$(document).ready(function () {
  setTimeout(() => {
    var load_model = new bootstrap.Modal(document.getElementById("loading-form"));
  load_model.show();
  }, 2000);
});


$(document).ready(function () {
  var carousel_main = $('.shop-now').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    animateIn: 'animate__fadeIn',
    animateOut: 'animate__fadeOut',
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
  });

  $(".msc-thumbnail-image-shop").click(function () {
    var dotIndex = $(this).data("dot");
    carousel_main.trigger("to.owl.carousel", [dotIndex, 300]);
  });
});

$(document).ready(function () {
  $(".msc-image-thumbnail-listing").first().addClass("msc-details-active");
  $(".msc-image-thumbnail-listing").click(function(){
    $(".msc-image-thumbnail-listing").removeClass("msc-details-active");
    $(this).addClass("msc-details-active");
  }) 
});

$('.msc-gallery-details').owlCarousel({
  loop:true,
  margin:10,
  nav:false,
  autoplay:4000,
  smartSpeed:1000,
  animateOut: 'animate__slideOutDown',
  animateIn: 'animate__slideInDown',
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
});


$(document).ready(function(){
  var imgArray = [];
  var currIndex = -1;

  $(".msc-main-wrapper-gallery").each(function () { 
     var img_src = $(this).find(".msc-gallery-img").attr("src");
     imgArray.push(img_src);
  });

  $(".msc-main-wrapper-gallery").on("click",function(){
    var img_src = $(this).find(".msc-gallery-img").attr("src");
    currIndex = imgArray.indexOf(img_src);
    $(".msc-modal-img").attr('src', img_src).addClass("show-gallery");
    console.log("hello");
    $(".msc-modal-image").fadeIn();
    $("body").addClass("not-scroll");
  })
  $("#msc-close-gallery").click(function(){
    $(".msc-modal-image").fadeOut().removeClass('show-gallery');
    $("body").removeClass("not-scroll");
  })
  $("#msc-prev").click(function(){
    if(currIndex > 0){
      currIndex--;
      $(".msc-modal-img").attr('src', imgArray[currIndex]);
    }
  })
  $("#msc-next").click(function(){
    if(currIndex < imgArray.length){
      currIndex++;
      $(".msc-modal-img").attr('src', imgArray[currIndex]);
    }
  })
})

$(document).ready(function(){
  $(window).scroll(function(){
    let scrollTop = $(this).scrollTop();
    if(scrollTop > 150){
      $(".msc-section-sticky-section-scroll").addClass("msc-show-scroll");
    }else{
      $(".msc-section-sticky-section-scroll").removeClass("msc-show-scroll");
    }
  })
});

$(document).ready(function(){
  $(".hamburger").click(function(e){
    e.preventDefault();
    $(".msc-bar-1").toggleClass("bar-active-1");
    $(".msc-bar-2").toggleClass("bar-active-2");
    $(".msc-bar-3").toggleClass("bar-active-3");
    $(".msc-header-navbar").toggleClass("navbar-active");
    $("body").toggleClass("msc-navbar-scroll");
  });

  $("form").submit(function(e){
    e.preventDefault();
    const frm = $(this);
    const btnTxt = frm.find(".btn-submit").html();
    $.ajax({
      type: "POST",
      url: $(this).attr("action"),
      data: $(this).serializeArray(),
      beforeSend: function(){
        if(frm.find(".response").length == 0){
          frm.find(".btn-submit").html("Please Wait...");
        }else{
          frm.find(".response").html("Please Wait...");
        }
      },
      success: function (response) {
        if (response.status == "success") {
          frm.trigger("reset");
        }
        if(frm.find(".response").length == 0){
          frm.find(".btn-submit").html(response.msg)
          setTimeout(() => {
            frm.find(".btn-submit").html(btnTxt)
          }, 3000);
        }else{
          frm.find(".response").addClass("animate__animated animate__fadeInLeft").html(response.msg)
          setTimeout(() => {
            frm.find(".response").removeClass("animate__animated animate__fadeInLeft").html("")
          }, 3000);
        }
      }
    });
  })
})