'use strict';   // Mode strict du JavaScript
$(document).ready(function(){
    
    // Menu fixe au scroll
    var navOffset= $("#nav3").offset().top;
    $("#nav3").wrapInner('<div class="nav-inner"</div>');
    $(".nav-inner").wrapInner('<div class="nav-inner-most"</div>');
    $(window).scroll(function(){
        var scrollPos =$(window).scrollTop();
        
        if (scrollPos >= navOffset){
            $("#nav3").addClass("fixed");
        }else{
            $("#nav3").removeClass("fixed");
        }
    });
    
 // datepicker pour la reservation
    var dateToday = new Date();
    $( function() {
        $( "#arrive" ).datepicker({
        showAnim:'drop',
        minDate: dateToday,
        numberOfMonth:1,
        dateFormat:'dd/mm/yy',
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mars", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ],

        onClose:function(selectedDate){
            $('#depart').datepicker("option","minDate",selectedDate);
            }
        })
  
    $( "#depart" ).datepicker({
        showAnim:'drop',
        minDate: dateToday,
        numberOfMonth:1,
        dateFormat:'dd/mm/yy',
        dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
        monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mars", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ], 
        })
    });


//POP UP LORS DE LA CONFIRMATION DE RESERVATION
    $(".confirme").hide();

    $('button.reserver').click(function() { 
        var chambre = $(this).attr("value");
        
        $('strong').append(chambre);
        $("input[name=chambre]" ).val(chambre);
        $(".confirme").toggle();
        $(".opacity").css("opacity","0.5");
        return false;
    }); 

    $('button.fermer').click(function() { 
        $('strong').empty();
        $(".confirme").hide();
    
    });


});

// MENU ACCORDEON LORS DU PASSAGE EN MODE TABLETTE (Un peu de js)
function openNav() {
    document.getElementById("accordeon").style.width = "100%";
}

function closeNav() {
    document.getElementById("accordeon").style.width = "0%";
}
  











