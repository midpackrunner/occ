
/*=======================================================================
=            				Document Ready                              =
========================================================================*/
$(document).ready(function(){
    $(".sponsors").hide();
    function fillStatesSelect() {
        var obj = ({"Data":{"Alabama": "AL","Alaska": "AK","Arizona": "AZ","Arkansas": "AR","California": "CA","Colorado": "CO","Connecticut": "CT","Delaware": "DE","Florida": "FL","Georgia": "GA","Hawaii": "HI","Idaho": "ID","Illinois": "IL","Indiana": "IN","Iowa": "IA","Kansas": "KS","Kentucky": "KY","Louisiana": "LA","Maine": "ME","Maryland": "MD","Massachusetts": "MA","Michigan": "MI","Minnesota": "MN","Mississippi": "MS","Missouri": "MO","Montana" : "MT","Nebraska" : "NE","Nevada" : "NV","New Hampshire" : "NH","New Jersey" : "NJ","New Mexico" : "NM","New York" : "NY","North Carolina" : "NC","North Dakota" : "ND","Ohio" : "OH","Oklahoma" : "OK","Oregon" : "OR","Pennsylvania" : "PA","Rhode Island" : "RI","South Carolina" : "SC","South Dakota" : "SD","Tennessee" : "TN","Texas" : "TX","Utah" : "UT","Vermont" : "VT","Virginia" : "VA","Washington" : "WA","West Virginia" : "WV","Wisconsin" : "WI","Wyoming" : "WY"}});
        var s = document.getElementById('state-selector');
        var i = 0;
        for(var propertyName in obj.Data) {
            s.options[i++] = new Option(propertyName, obj.Data[propertyName], true, false);
        }
    }

    fillStatesSelect();

    //phone masker
    $("#primary-phone-number").inputmask({"mask": "(999) 999-9999"}); //specifying options

    $(".memberships").change(function() {
        var current_selection = $("input:radio[name='membership_type']:checked").val();
        // if student, then no member vouching needed
        if(current_selection != 4) {
            $(".sponsors").show("slow");
        } else {
            $(".sponsors").hide("slow");
        }
    });



});
/*=======================  End of Document Ready  ========================*/

