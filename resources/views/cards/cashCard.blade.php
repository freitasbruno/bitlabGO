<div class="card mb-2">
	<div class="card-body d-flex justify-content-between">
		<div class="col-sm-6 text-truncate p-0">{{ $item->name }}</div>
		<div class="col-sm-6 text-right p-0">{{ ($item -> type == 'expense' ? '-' : '+') . $item->amount . " " . $item->currency }}</div>			
	</div>
</div>
