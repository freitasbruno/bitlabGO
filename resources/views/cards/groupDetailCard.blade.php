<div class="container" data-id="{{ $group->id }}" data-type="group">

	<div class="main-card-detail-grid">
		<div></div>			
		<p class="card-text-s">
			{{ strToUpper($group->name) }}
		</p>
		<div></div>
		<div>		
			<p class="card-text-xs">{{ $group->description }}</p>
		</div>
	</div>

	@include('cards.groupCardDetails', ['item' => $group])
	
</div>