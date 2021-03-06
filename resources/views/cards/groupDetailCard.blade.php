<div class="container" data-id="{{ $group->id }}" data-type="groups">

	<div class="card-detail-grid">
		<div></div>			
		<p class="card-text-s editable" data-field="name">
			{{ strToUpper($group->name) }}
		</p>
		<div></div>
		
		<div>	
			@if ($group->description)		
				<p class="card-text-xs editable" data-field="description">{{ $group->description }}</p>
			@else
				<p class="card-text-xs editable" data-field="description">Enter a description...</p>
			@endif
		</div>
		@include('cards.groupCardDetails', ['type' => 'group', 'filter' => $group])
	</div>
	
</div>