$(document).ready(function() {
    $('.detailsDynamique').hide();
});


$("#inscription_etape1_nature").on('change', function() {
    $(".detailsDynamique").hide();
    var radioValue = $("input[name='inscription_etape1[nature]']:checked").val();
    $('.entreprise').css('margin-top','30px' );
    $("."+radioValue+"Dynamique").show();

});



