<div class="panel panel-primary">
	<div class="panel-heading">
		Announcements
	</div>
	<div class="panel-body">
		@foreach ($announcements as $announcement)
		<h3 class="text-primary">{{ $announcement->title }}</h3>
		<blockquote>{!! nl2br($announcement->description) !!}</blockquote> 
		@endforeach
	</div>
</div>