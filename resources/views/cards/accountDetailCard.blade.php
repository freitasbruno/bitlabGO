<div class="container" data-id="{{ $account->id }}" data-type="accounts">

	<div class="main-card-detail-grid">
		<div></div>			
		<p class="card-text-s editable" data-field="name">
			{{ strToUpper($account->group->name) }}
		</p>
		<div></div>
		<div>		
			@if ($account->group->description)		
				<p class="card-text-xs editable" data-field="description">{{ $account->group->description }}</p>
			@else
				<p class="card-text-xs editable" data-field="description">Enter a description...</p>
			@endif
		</div>
	</div>

	{{-- @include('cards.groupCardDetails', ['group' => $account->group]) --}}
	
</div>