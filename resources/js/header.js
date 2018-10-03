/*$(document).ready(function(){
  $('.navbar ul li').click(function(){
    $('li').removeClass("active");
    $(this).addClass("active");
});
});*/

/*The below written code is for active class selection in the pages*/

$(function() {
     var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    console.log(pgurl);
    /*console.log(this.attr);*/
     $(".navbar ul li").each(function(){
         $(this).removeClass("active");
          if($(this).children("a").attr("href") == pgurl || $(this).children("a").attr("href") == '' ) {
              $(this).addClass("active");
          }
     })
});

/*The below written code is for scrolling and active class selection*/

$(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('.navbar li a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('.navbar li').each(function () {
            $(this).removeClass('active');
        })
        $(this).parent("li").addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.navbar li a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.navbar li').removeClass('active');
            currLink.parent("li").addClass('active');
        }
        else{
            currLink.parent("li").removeClass('active');
        }
    });
}

/*$(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('.navbar-nav li').each(function () {
            $('li').removeClass('active');
            $(this).addClass('active');
        })
        /*$(this).addClass('active');*/
      
        /*var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.navbar-nav li').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('li').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}*/

/*$(document).ready(function () {
		$(document).on("scroll", onScroll);

		$('.navbar ul li a[href^="#"]').on('click', function (e) {
			e.preventDefault();
			$(document).off("scroll");

			$('li').each(function () {
				$(this).removeClass('active');
			})
			$(this).addClass('active');

			var target = this.hash;
			$target = $(target);
			$('html, body').stop().animate({
				'scrollTop': $target.offset().top+2
			}, 500, 'swing', function () {
				window.location.hash = target;
				$(document).on("scroll", onScroll);
			});
		});
	});

	function onScroll(event){
		var scrollPosition = $(document).scrollTop();
		$('.navbar ul li').each(function () {
			var currentLink = $(this);
			var refElement = $(currentLink.attr("href"));
			if (refElement.position().top <= scrollPosition && refElement.position().top + refElement.height() > scrollPosition) {
				$('.navbar ul li').removeClass("active");
				currentLink.addClass("active");
			}
			else{
				currentLink.removeClass("active");
			}
		});
	}*/


/*$(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('#menu-center a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu-center ul li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}*/
