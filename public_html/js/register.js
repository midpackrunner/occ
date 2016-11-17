
/*=======================================================================
=            				Document Ready                              =
========================================================================*/
$(document).ready(function(){
    var curr_mem_type = $("input:radio[name='membership_type']:checked").val();
    // if student, then no member vouching needed
    if(curr_mem_type == 4) {
        $(".sponsors").hide("slow");
    } 

    var curr_val = $("#rev-resource option:selected").text();
    if(curr_val == "Other" || curr_val == "Vet") {
        $(".hear-about-us-details").show();
    } else {
        $(".hear-about-us-details").hide();
    }

    //phone masker
    $("#primary-phone-number").inputmask({"mask": "(999) 999-9999"}); //specifying options



    $(".memberships").change(function() {
        var curr_mem_type = $("input:radio[name='membership_type']:checked").val();
        // if student, then no member vouching needed

        if(curr_mem_type != 4) {
            $(".sponsors").show("slow");
        } else {
            $(".sponsors").hide("slow");
        }
    });

    $("#rev-resource").change(function() {
        var curr_val = $("#rev-resource option:selected").text();
        console.log(curr_val);
        if(curr_val == "Other") {
            $("#rev-resource-lbl").text("Other Source:");
            $(".hear-about-us-details").show("slow");
        } else if(curr_val == "Vet") {
            $("#rev-resource-lbl").text("Which Vet?");
            $(".hear-about-us-details").show("slow");
        } else {
            $(".hear-about-us-details").hide("slow");
        }
    });

});
/*=======================  End of Document Ready  ========================*/

