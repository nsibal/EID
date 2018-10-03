/**
 * 
 */

/*Loading the navbar from header.html*/
$(document).ready(function(){
  $('.header').load("header.html");
});

$(document).ready(function(){
  $('.header2').load("header2.html");
});




/*For changing the active class*/


/*$(function() {
  $('nav a[href^="/' + location.pathname.split("/")[1] + '"]').addClass('active');
});*/

/*$(function(){
    $('#navbar a').click(function () {
        $('#navbar a').css('text-decoration', 'none');//don't forget to reset other inactive links
     $(this).css('text-decoration', 'underline');
     });
 });*/

/*$(function() {
  $('nav a[href^="#' + location.pathname.split(".")[1] + '"]').addClass('active');
});*/

/*$(function(){
    $('#navbar li a').click(function () {
        $('#navbar li a').removeClass('active');
        $(this).addClass('active');
     });
 });*/

/*nav.find('a').on('click', function () {
  var $el = $(this)
    , id = $el.attr('href');
 
  $('html, body').animate({
    scrollTop: $(id).offset().top - nav_height
  }, 500);
 
  return false;
});*/

/*For changing the current navbar button
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});*/

/*$('#monitor').html($(window).width());

    $(window).resize(function() {
    var viewportWidth = $(window).width();
$('#monitor').html(viewportWidth);
});*/

/*$('.nav.navbar-nav > li').on('click', function (e) {
    e.preventDefault();
    $('.nav.navbar-nav > li').removeClass('active');
    $(this).addClass('active');
});*/

/*$('.nav.navbar-nav li a').click(function(e) {
  var $this = $(this);
  if (!$this.hasClass('active')) {
    $this.addClass('active');
  }
  e.preventDefault();
});*/

 /*$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});*/

/*function HeaderController($scope, $location) { 
    $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
}*/

/*$(function(){*/
    /*var url = window.location;
$('ul.nav a').filter(function() {
    return this.href == url;
}).parent().addClass('active');*/
    
   /* $('.nav.navbar-nav > li').click(function(e) {
  var $this = $(this);
  if (!$this.hasClass('active')) {
    $this.addClass('active');
  }
  e.preventDefault();
});*/
    
   
    
/*})*/


