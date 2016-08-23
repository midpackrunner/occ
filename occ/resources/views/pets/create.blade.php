@extends('layouts.app')

@section('title', 'Pet Profile')

@section('content')
<h3>Create a new Pet Profile</h3>
<div class="row">
	<div class="col-md-5 col-md-offset-7">
		<a class="btn btn-primary btn-sm" href="{{ url('/profiles', Auth::user()->user_profile->id) }}" role="button">Back to Your Profile</a>
	</div>
</div>
<div class="spacer-sm"></div>

<div class="row">
	<div class="col-md-9 col-md-offset-1">
        {!! Form::open(['url' => 'pets', 'class' => 'form-horizontal', 'id' => 'create-pet-form', 'files'=>true]) !!}
        @include('pets.form', ['submitButtonLabel' => 'Create a new Pet Profile'])
        {!! Form::close() !!}
    </div>
</div>

<script type="text/javascript">
    function CheckBreed(val){
       var element=document.getElementById('breed');
       if(val=='Other')
         element.style.display='block';
     else  
         element.style.display='none';
 }
 $(function() {
   $('#create-pet-form').submit(function(){
      var breed_opt = $('#breed-select option:selected').text();
      if (breed_opt != 'Other') {
         $('#breed').val(breed_opt);
     }
     return true;
 });
});
</script> 

@endsection