<div class="card-deck" data-type="{{ $type }}">
	<div class="deck-title">
		<div class="filter">
			<i class="material-icons-outlined filter-link white {{ $type == 'groups' ? 'selected' : null }}" data-type="groups">folder</i>
			<i class="material-icons-outlined filter-link white {{ $type == 'accounts' ? 'selected' : null }}" data-type="accounts">credit_card</i>
		</div>
		<div class="deck-title-text">
			{{ $type }}			
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newGroupBtn" data-type="cash">
				<i class="material-icons white">add_circle</i>
			</a>
		</div>
	</div>	
	<div class="cardScrollbar">
		<div class="card-container">
			@include('forms.formCard', ['type' => $type, 'formName' => rtrim($type,"s") . 'Form'])
			@each('cards.' . rtrim($type,"s") . 'Card', $filters, rtrim($type,"s"))
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>