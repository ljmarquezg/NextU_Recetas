$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('#loader').addClass('hide-loader');
    retraso();
});

function retraso() {
    setTimeout($('#loader').hide(), 5000);
}
