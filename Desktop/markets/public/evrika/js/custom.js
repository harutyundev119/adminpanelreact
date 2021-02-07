$(function() {
    var isClicked = false;
    $('.scrollTop').css("display","none");
    $(window).scroll(function() {
      if (isClicked == false){
          if ($(this).scrollTop() > 300) {$('.scrollTop').show();}
          else {$('.scrollTop').hide();}
      }
    });

    $('.scrollTop').click(function() {
      isClicked = true;
      $('.scrollTop').fadeOut(500);
      $('html, body').animate({
          scrollTop : 0
      }, 800, function(){
          isClicked = false;
      });
    });
    $('.scrollTop').on("mouseenter",function() {
      $('.scrollTop').css({opacity:'1.0'});
    });
    $('.scrollTop').on("mouseleave",function() {
      $('.scrollTop').css({opacity:'0.5'});
    });


    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-115890069-5');
});

$('input[name=pay]').click(function() {
    $(this).each(function() {
        if($(this).is(':checked')) {
            if($(this).val() == 'non_cash') {
                $('.payment-options ').fadeOut();
            } else {
                $('.payment-options ').fadeIn();
            }
        };
    });
});
//open and close tab menu
$('.nav-tabs-dropdown')
    .on("click", "li:not('.active') a", function(event) {  $(this).closest('ul').removeClass("open");
    })
    .on("click", "li.active a", function(event) {        $(this).closest('ul').toggleClass("open");
});
// '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
