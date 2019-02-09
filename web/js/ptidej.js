$(document).ready(function() {
    $('.detailsDynamique').hide();
    $('.entreprise').css('margin-top','158px' );
});


$("#inscription_etape1_nature").change(function() {
    $(".detailsDynamique").hide();
    var radioValue = $("input[name='inscription_etape1[nature]']:checked").val();
    if(radioValue){
        $('.entreprise').css('margin-top','30px' );
        $("."+radioValue+"Dynamique").show();
    }

});




