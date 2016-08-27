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
</style>	
</head>
<body>
	<div style="position:absolute;top:-10;left:-40"><img width="780" height="1100" src= "img/member_app_template.jpg" ALT="Bad link">
	</div>
	@if($membership_type == 1)
	<div id="individual" style="position:absolute;top:170px;left:5px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if($membership_type == 2)
	<div id="household" style="position:absolute;top:170px;left:220px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if($membership_type == 3)
	<div id="associate" style="position:absolute;top:170px;left:440px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif

	<div id="name" style="position:absolute;top:300px;left:120px"><span class="ft1">{{$first_name . ' ' . $last_name}}</span></div>
	<div id="street" style="position:absolute;top:325px;left:120px"><span class="ft1">{{$street_address}}</span></div>
	<div id="city" style="position:absolute;top:352px;left:120px"><span class="ft1">{{$city}}</span></div>
	<div id="state" style="position:absolute;top:352px;left:460px"><span class="ft1">{{$state}}</span></div>
	<div id="zip" style="position:absolute;top:352px;left:580px"><span class="ft1">{{$zip}}</span></div>


	<div id="email" style="position:absolute;top:300px;left:460px"><span class="ft2">{{$email}}</span></div>
	<div id="phone" style="position:absolute;top:325px;left:460px"><span class="ft1">{{$phone_number}}</span></div>

	@if ($willing_to_work == "yes")
	<div id="will-to-wrk-y" style="position:absolute;top:545px;left:330px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@else
	<div id="will-to-wrk-n" style="position:absolute;top:545px;left:495px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	
	@if(isset($interests))
	@if (in_array(1, $interests))
	<div id="publicity" style="position:absolute;top:579px;left:5px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(2, $interests))
	<div id="newsletter" style="position:absolute;top:579px;left:165px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(3, $interests))
	<div id="hospitality" style="position:absolute;top:579px;left:330px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(4, $interests))
	<div id="show-match" style="position:absolute;top:579px;left:495px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(5, $interests))
	<div id="membership" style="position:absolute;top:595px;left:5px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(6, $interests))
	<div id="sunshine" style="position:absolute;top:595px;left:165px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(7, $interests))
	<div id="fundraising" style="position:absolute;top:595px;left:330px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(8, $interests))
	<div id="education" style="position:absolute;top:595px;left:495px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(9, $interests))
	<div id="class-instructor" style="position:absolute;top:615px;left:5px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(10, $interests))
	<div id="class-assistant" style="position:absolute;top:615px;left:165px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@if (in_array(11, $interests))
	<div id="other" style="position:absolute;top:615px;left:330px"><img  src= "img/checkmark.png" ALT="Bad link"></div>
	@endif
	@endif
	<div id="other-fill" style="position:absolute;top:637px;left:440px"><span class="ft1"></span></div>

	<?php
	$sp_skills_ln_1 = null;
	$sp_skills_ln_2 = null;
	$sp_skills_ln_3 = null;

	$sp_skills_expld = explode(" ", $special_skills);
	$char_count = 0;
 	foreach ($sp_skills_expld as $word) {   // fill each line, limit by length
 		$char_count += strlen($word) + 1;
 		if ($char_count < 54) {
			$sp_skills_ln_1 .= $word . " ";
 		} elseif($char_count > 53 and $char_count < 163) {
			$sp_skills_ln_2 .= $word . " ";
 		} else {
			$sp_skills_ln_3 .= $word . " ";
 		}
 	}
 	?>

 	<!-- Max. Char 54-->
 	@if ($sp_skills_ln_1 != null)
 	<div id="special-skills-1" style="position:absolute;top:657px;left:337px"><span class="ft1">{{$sp_skills_ln_1}}</span></div>
 	@endif
 	<!-- Max. Char 110-->
 	@if ($sp_skills_ln_2 != null)
 	<div id="special-skills-2" style="position:absolute;top:683px;left:12px"><span class="ft1">{{$sp_skills_ln_2}}</span></div>
 	@endif
 	<!-- Max. Char 110-->
 	@if ($sp_skills_ln_3 != null)
 	<div id="special-skills-3" style="position:absolute;top:710px;left:12px"><span class="ft1">{{$sp_skills_ln_3}}</span></div>
 	@endif

 	@if(isset($sponsor1))
 	<div id="sponsor-1" style="position:absolute;top:775px;left:340px"><span class="ft1">
 		{{$sponsor1}}
 	</span></div>
 	@endif
 	@if(isset($sponsor2))
 	<div id="sponsor-2" style="position:absolute;top:813px;left:340px"><span class="ft1">{{$sponsor2}}</span></div>
 	@endif


 </body>

 </html>