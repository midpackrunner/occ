
<div class="panel panel-primary">
	<div class="panel-heading">
		Announcements
	</div>
	<div class="panel-body">
		@foreach ($announcements as $announcement)
		<h2>{{ $announcement->title }}</h2>
		<blockquote> {{ $announcement->description }} </blockquote>
		@endforeach
	</div>
</div>