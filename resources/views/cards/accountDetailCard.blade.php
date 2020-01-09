<div class="container" data-id="{{ $account->id }}" data-type="accounts">

	<div class="main-card-detail-grid">
		<div></div>			
		<p class="card-text-s editable" data-field="name">
			{{ strToUpper($account->group->name) }}
		</p>
		<div></div>
		<div>		
			<p class="card-text-xs editable" data-field="description">
				{{ $account->group->description }}
			</p>
		</div>
	</div>

	{{-- @include('cards.groupCardDetails', ['group' => $account->group]) --}}
	
</div>