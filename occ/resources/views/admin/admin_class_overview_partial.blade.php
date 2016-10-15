<div class="col-md-8">
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<select class='selectpicker'>
				@for($i = 1; $i <= $max_session; $i++)
						<Option value={{$i}}>Session {{$i}}</Option>
				@endfor
			</select>
		</div>
		<div class="col-md-4">
			<select class='selectpicker'>
				@for($i = 2012; $i <= $max_year; $i++)
						<Option value="{{$i}}" {{Carbon::now()->year == $i ? 'selected=selected' : ''}}>{{$i}}</Option>
				@endfor
			</select>
	</div>
	<div class="row">
	<div id="class-enroll"></div>
	</div>
</div>


<script src="{{ asset('js/raphael.min.js') }}"></script>
<script src="{{ asset('js/morris.min.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		Morris.Bar({
			element: 'class-enroll',
			data: [
			{ y: '2006', a: 100, b: 90 , c:60},
			{ y: '2007', a: 75,  b: 65 , c:50},
			{ y: '2008', a: 50,  b: 40 , c:40},
			{ y: '2009', a: 75,  b: 65 , c:30},
			{ y: '2010', a: 50,  b: 40 , c:20},
			{ y: '2011', a: 75,  b: 65 , c:10},
			{ y: '2012', a: 100, b: 90 , c:90}
			],
			xkey: 'y',
			ykeys: ['a', 'b', 'c'],
			labels: ['Series A', 'Series B', 'Series C']
		});

	});

</script>