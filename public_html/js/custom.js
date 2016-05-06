
/*=======================================================================
=            				Document Ready                              =
========================================================================*/
$(document).ready(function(){

	// test where we are at
	/*var loc = window.location.pathname;
	var dir = loc.substring(0, loc.lastIndexOf('/'));
	console.log(dir);*/
	
	//---------- url to retrieve appointments data
	var url = '/appointments/getAppointmentsByClass/';

	//---------- global vars
	var all_classes_and_dates;
	var class_dates = [];	// holds the dates of a particular class
	var min_date = new Date(1970, 01, 01);  // used to restrict selectable dates
	var max_date = new Date(1970, 01, 01);  // used to restrict selectable dates
	var a_class =  $("#appointment_name option:selected").text();
	isAsync = false;

	//----------- initialize form fields
	$.ajax({
		type: 'GET',
		async: isAsync,
		url: url + "all",
		dataType: 'json',
		cache: false,
		success: function(result) {
			all_classes_and_dates = result;
			console.log("all_classes_and_dates =>" + all_classes_and_dates);
		},
	});
	updateDatePicker();

    $('.select-picker').selectpicker({  //bootstrap dropdown
    	style: 'btn-default',
    	size: 4
	});

	//----------  persistent functionality
    $(".date_pick").change(function() {
    	alert($(this).datepicker('getDate'));
    });

	$("#appointment_name").change(function() {  // appointment_name change event
		a_class = $("#appointment_name option:selected").text();
		updateDatePicker();
	});

	/****************************
	 * Updates the datepicker according to the value in the appointment_name list
	 */
	function updateDatePicker() {	
	
		// date picker: set maximum date
	    $(".date_pick").each(function() {  // init date picker
			getAppointmentsPerClass(class_dates, a_class, all_classes_and_dates);

	        $(this).datepicker({
	        	dateFormat: "mm-dd-yy",
	        	//add date constraints
	        	maxDate: getMaxDate(class_dates, max_date),
	        	minDate: 0,  // set min date to today's date
	        	// highlight only those days that belong to an appointment
	        	beforeShowDay: function(d) {
        			var mdy = (d.getMonth() + 1);
        			if(d.getMonth()<9) 
        			    mdy = "0" + mdy; 
        			mdy+= "-"; 
        			if(d.getDate()<10) mdy+="0";
        			mdy+=d.getDate() + "-";  
	        		mdy += d.getFullYear();
        			
        			if ($.inArray(mdy, class_dates) != -1) {
        			    return [true, "css-class-to-highlight","Available"]; 
        			} else{
        			     return [false,"","unAvailable"]; 
        			}
    			}
	        });
	    });
	}
});
/*=======================  End of Document Ready  ========================*/


/**
 * Gets the dates of classes from the total appointments, then parses these string
 * dates into javascript Date Objects.
 *
 * @param      {Array}   dates         The dates beloning to aClass
 * @param      {String}  aClass        The Class of interest
 * @param      {JSONList}  appointments  The jsonList pulled from /appointments
 */
function getAppointmentsPerClass(dates, aClass, appointments) {
	console.log("a_class =>" + aClass);
	dates.length = 0;  // clear array
	for (var app in appointments) {
		if (aClass == "all" || appointments[app].appointment_name == aClass.trim()) {
			dates.push(extractDateHelper("mm-dd-yy", appointments[app].appointment_date));
		} 
	}
}

// Date helper. Extract date_string in the format of yyyy-mm-dd hh:mm:ss
function extractDateHelper(toFormat, string_date) {
	var year = string_date.substring(0,4);
	var month = string_date.substring(5,7);
	var day = string_date.substring(8,10);
	//todo complete swith case
	switch (toFormat) {
		case "mm-dd-yy":
			return month + "-" + day + "-" + year;
			break;
		default:
			return month + "-" + day + "-" + year;
			break;
	}
}

// TimeStamp helper.  Extract time from DateTime
function extractTimeStampHelper(string_date) {


}
// todo add different format functionality
function toDateHelper(current_format, string_date) {
	var year;
	var month;
	var day;
	switch (current_format) {
		case "yy-mm-dd":
			year =  parseInt(string_date.substring(0,4));
			month = parseInt(string_date.substring(5,7));
			day =   parseInt(string_date.substring(8,10));
			break;
		case "mm-dd-yy":
			year = parseInt(string_date.substring(6,10));
			month = parseInt(string_date.substring(0,2));
			day = parseInt(string_date.substring(3,5));
			break;
		default:
			year = string_date.substring(0,4);
			month = string_date.substring(5,7);
			day = string_date.substring(8,10);
			break;	
	}
	return new Date(year, month-1, day);
}

function getMaxDate(arr_of_dates, max_date) {
	var temp;
	
		console.log("arr_of_dates" + arr_of_dates);
	for (var i = 0; i < arr_of_dates.length; i++) {
		temp = toDateHelper("mm-dd-yy", arr_of_dates[i]);
		console.log("temp =>" + temp);
		if ( temp.getTime() > max_date.getTime()) {
			max_date = new Date(+temp); 
		}
	}
	return dateToStringHelper(max_date);
}

function dateToStringHelper(a_date) {
	var year = a_date.getFullYear();
	var month = a_date.getMonth() + 1;
	var day = a_date.getDate();
	if(month < 10) { month = "0" + month};
	if(day < 10) { day = "0" + day};

	return year + "-" + month + "-" + day;
}


/**
 * DatePicker functions
 * refresh()
 */
