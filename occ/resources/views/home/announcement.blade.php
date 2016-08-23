<div class="panel panel-primary">
	<div class="panel-heading">
		Announcements
	</div>
	<div class="panel-body">
		@foreach ($announcements as $announcement)
		<h4>{{ $announcement->title }}</h4>
		<blockquote> {{ $announcement->description }} </blockquote>
		@endforeach
	</div>
</div>