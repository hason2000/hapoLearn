$(document).ready(function(){
  window.onload = function(){
    limitText(80);
    limitRvText(130);
  };

  $('#headerBtnIcon').click(function() {
    if ($('.header-content').hasClass('show')) {
      $('.navbar-toggler-icon').removeClass('hide');
      $('.fa-times').addClass('hide');
    } else {
      $('.navbar-toggler-icon').addClass('hide');
      $('.fa-times').removeClass('hide');
    }
  });

  if ($(window).width() > 1804 & $(window).width() < 1983) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '40px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '275px'});
    });
  }
  else if ($(window).width() > 1698 & $(window).width() < 1804) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '40px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '203px'});
    });
  }
  else if ($(window).width() > 1583 & $(window).width() < 1699) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '10px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '250px'});
    });
  }
  else if ($(window).width() > 1451 & $(window).width() < 1584) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '5px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '230px'});
    });
  }
  else if ($(window).width() > 1349 & $(window).width() < 1452) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '10px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '200px'});
    });
  }
  else if ($(window).width() >= 1083 & $(window).width() < 1350) {
    $('.footer-icon').mouseenter(function(){
      $('.footer-right').css({'margin-left' : '5px'});
    });
    $('.footer-icon').mouseleave(function(){
      $('.footer-right').css({'margin-left' : '165px'});
    });
  }

  $('.icon-img').click(function(){
    if ($('.mess-content').hasClass('mess-active')){
      $('.mess-content').removeClass('mess-active')
    }else {
      $('.mess-content').addClass('mess-active')
    }
  });

  $('.icon-close').click(function(){
    $('.mess-content').removeClass('mess-active')
  });

  // xu ly modal
  $('.modal-header-l').click(function(){
    $('.modal-header-l').addClass('modal-active-cus');
    $('.modal-header-r').removeClass('modal-active-cus');
    $('.form-l').addClass('d-block');
    $('.form-l').removeClass('d-none');
    $('.form-r').addClass('d-none');
    $('.form-r').removeClass('d-block');
  });

  $('.modal-header-r').click(function(){
    $('.modal-header-r').addClass('modal-active-cus');
    $('.modal-header-l').removeClass('modal-active-cus');
    $('.form-r').addClass('d-block');
    $('.form-r').removeClass('d-none');
    $('.form-l').addClass('d-none');
    $('.form-l').removeClass('d-block');
  });

  $('.modal-close').click(function(){
    if ($('.body-cus').hasClass('modal-open')) {
      $('.body-cus').removeClass('modal-open');
      $('.body-cus').css({'padding-right' : '0'});
      $('.modal').removeClass('show');
      $('.modal').css({'display' : 'none'});
      $('.modal-backdrop').css({'display' : 'none'})
    }
  });

  $('.header-lr-cus').click(function(){
    $('.body-cus').addClass('modal-open');
    $('.body-cus').css({'padding-right' : '0'});
    $('.modal').addClass('show');
    $('.modal').css({'display' : 'block'});
    $('.modal-backdrop').css({'display' : 'block'})
  });

  function limitText(textLenght){
    var tdList = document.getElementsByClassName("card-text");
    for (var i = 0; i< tdList.length; i++){
      if (tdList[i].innerHTML.length > textLenght){
        tdList[i].innerHTML = tdList[i].innerHTML.substr(0, textLenght - 4) +'...';
      }
    }
  }

  function limitRvText(textLenght){
    var tdList = document.getElementsByClassName("review-text");
    for (var i = 0; i< tdList.length; i++){
      if (tdList[i].innerHTML.length > textLenght ){
        tdList[i].innerHTML = tdList[i].innerHTML.substr(0, textLenght - 4) +'...';
      }
    }
  }

  $('.feedback-content').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 2,
    responsive: [
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
    ]
  });
});
