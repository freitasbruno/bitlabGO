<div id="filter-nav">
	<div class="nav-left">
		<i class="material-icons-outlined filter-link white {{ $type == 'groups' ? 'selected' : null }}" data-type="groups">folder</i>
		<i class="material-icons-outlined filter-link white {{ $type == 'accounts' ? 'selected' : null }}" data-type="accounts">credit_card</i>
	</div>
	<div class="nav-center">
		{{ $type }}			
	</div>
	<div class="nav-right">
		<a href="#" class="newFilterBtn">
			<i class="material-icons white">add_circle</i>
		</a>
	</div>
</div>	
<div class="filter-container card-container" data-type="{{ $type }}">
	<div class="cardScrollbar">
		@include('forms.formCard', ['type' => $type, 'formName' => rtrim($type,"s") . 'Form'])
		@each('cards.' . rtrim($type,"s") . 'Card', $filters, rtrim($type,"s"))
		<div class="force-overflow"></div>	
	</div>
</div>