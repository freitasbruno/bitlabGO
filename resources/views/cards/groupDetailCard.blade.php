<div class="container" data-id="{{ $group->id }}" data-type="groups">

	<div class="main-card-detail-grid">
		<div></div>			
		<p class="card-text-s editable" data-field="name">
			{{ strToUpper($group->name) }}
		</p>
		<div></div>
		<div>		
			<p class="card-text-xs editable" data-field="description">
				{{ $group->description }}
			</p>
		</div>
	</div>

	@include('cards.groupCardDetails', ['item' => $group])
	
</div>