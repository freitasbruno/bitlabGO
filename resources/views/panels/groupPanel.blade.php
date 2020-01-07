<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			FILTERS
			{{-- @foreach ($breadcrumbs as $group)
				@if($loop->last)
					{{ $group->name }}
				@else
					{{ $group->name }} > 
				@endif				
			@endforeach --}}
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newGroupBtn" data-type="cash">
				<i class="material-icons">add_circle</i>
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.groupCard', $groups, 'group')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>