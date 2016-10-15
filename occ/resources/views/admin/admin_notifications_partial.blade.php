<div class="col-md-3">
<h3 class='text-primary center'><b>Notifications</b></h3>
<ul class="nav nav-pills nav-stacked" role="tablist">
  <li role="presentation" class="active"><a href="{{ url('/volunteer') }}">New Volunteer Hours<span class="badge pull-right">{{$notification['unverified_vol_hours_cnt']}}</span></a>
  </li>
  <li role="presentation" class="active"><a href="{{ url('members/1/expired_membership') }}">Expired Memberships<span class="badge pull-right">{{$notification['membership_expire_cnt']}}</span></a>
  </li>
  <li role="presentation" class="active"><a href="{{ url('medical_records/1/expired') }}">Expired Medical Records<span class="badge pull-right">{{$notification['unverified_med_recs']}}</span></a>
  </li>    
  </ul>
</div>