$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('#loader').addClass('hide-loader');
    retraso();
    $('form ~ section > form').detach()
});

function retraso() {
    setTimeout($('#loader').hide(), 5000);
}
