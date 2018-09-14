$(document).ready(function () {
    $('ul li.nav-item.dropdown').hover(function () {
        $(this).find('.dropdown-menu, .mega-menu, .card-dropdown').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu, .mega-menu, .card-dropdown').stop(true, true).delay(200).fadeOut(500);
    });
});
