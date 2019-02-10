$(document).ready(function() {
    $('.detailsDynamique').hide();
});


$("#inscription_etape1_nature").on('change', function() {
    $(".detailsDynamique").hide();
    var radioValue = $("input[name='inscription_etape1[nature]']:checked").val();
    $(".defaultDynamique").hide();
    $("."+radioValue+"Dynamique").show();

});



