<div class="container" data-id="{{ $group->id }}" data-type="group">

	<div class="main-card-detail-grid">
		<div class="group-card-grid">
			<p class="card-text-s">
				{{ strToUpper($group->name) }}
			</p>
			@if ($group->children->count() > 0)
				<div class="count-label">{{ $group->children->count() }}</div>
			@endif
		</div>
		<div></div>
		<div>
			<p class="card-text-s">{{ $group->name }}</p>	
			<br>		
			<p class="card-text-xs">{{ $group->description }}</p>
		</div>
	</div>

	@include('cards.groupCardDetails', ['item' => $group])
	
</div>