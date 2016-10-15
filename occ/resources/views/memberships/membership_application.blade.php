<!DOCTYPE html>
<html>
<head>
	<title>Membership Application</title>
	<style type="text/css">
		<!--
		.ft0{font-style:normal;font-weight:bold;font-size:27px;font-family:Times New Roman;color:#000000;}
		.ft1{font-style:normal;font-weight:normal;font-size:14px;font-family:Times New Roman;color:#000000;}
		.ft2{font-style:normal;font-weight:normal;font-size:11px;font-family:Times New Roman;color:#000000;}
		.ft3{font-style:normal;font-weight:normal;font-size:9px;font-family:Times New Roman;color:#000000;}
		.ft4{font-style:normal;font-weight:normal;font-size:13px;font-family:Times New Roman;color:#000000;}
		.ft5{font-style:italic;font-weight:normal;font-size:11px;font-family:Times New Roman;color:#000000;}
		.ft6{font-style:normal;font-weight:normal;font-size:11px;font-family:Verdana;color:#000000;}
	-->
	.page-break {
    page-break-after: always;
	}
</style>	
</head>
<body>
	<div style="position:absolute;top:-10;left:-40"><img width="780" height="1100" src= "img/membership_application/MembershipApp-page-001.jpg" ALT="Bad link">
	</div>
	@if($membership_type == 1)
	<div id="individual" style="position:absolute;top:225px;left:20px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if($membership_type == 2)
	<div id="household" style="position:absolute;top:225px;left:240px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if($membership_type == 3)
	<div id="associate" style="position:absolute;top:225px;left:443px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif




	<div id="name" style="position:absolute;top:355px;left:125px"><span class="ft1">{{$first_name . ' ' . $last_name}}</span></div>
	<div id="street" style="position:absolute;top:385px;left:125px"><span class="ft1">{{$street_address}}</span></div>
	<div id="city" style="position:absolute;top:412px;left:125px"><span class="ft1">{{$city}}</span></div>
	<div id="state" style="position:absolute;top:412px;left:460px"><span class="ft1">{{$state}}</span></div>
	<div id="zip" style="position:absolute;top:412px;left:580px"><span class="ft1">{{$zip}}</span></div>


	<div id="email" style="position:absolute;top:355px;left:460px"><span class="ft2">{{$email}}</span></div>
	<div id="phone" style="position:absolute;top:385px;left:460px"><span class="ft1">{{$phone_number}}</span></div>

	@if ($willing_to_work == "yes")
	<div id="will-to-wrk-y" style="position:absolute;top:635px;left:270px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@else
	<div id="will-to-wrk-n" style="position:absolute;top:635px;left:350px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	
	@if(isset($interests))
	@if (in_array(1, $interests))
	<div id="publicity" style="position:absolute;top:710px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(2, $interests))
	<div id="newsletter" style="position:absolute;top:750px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(3, $interests))
	<div id="hospitality" style="position:absolute;top:790px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(4, $interests))
	<div id="show-match" style="position:absolute;top:820px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(5, $interests))
	<div id="membership" style="position:absolute;top:855px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(6, $interests))
	<div id="sunshine" style="position:absolute;top:890px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(7, $interests))
	<div id="fundraising" style="position:absolute;top:920px;left:190px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(8, $interests))
	<div id="education" style="position:absolute;top:710px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(9, $interests))
	<div id="class-instructor" style="position:absolute;top:750px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(10, $interests))
	<div id="class-assistant" style="position:absolute;top:790px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(11, $interests))
	<div id="other" style="position:absolute;top:820px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif

	@if (in_array(12, $interests))
	<div id="other" style="position:absolute;top:855px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(13, $interests))
	<div id="other" style="position:absolute;top:890px;left:608px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif

	@endif
	<div id="other-fill" style="position:absolute;top:637px;left:440px"><span class="ft1"></span></div>
	
	<div class="page-break"></div>
	<div style=""><img width="760" height="1100" src= "img/membership_application/MembershipApp-page-002.jpg" ALT="Bad link">
	</div>

 </body>

 </html>