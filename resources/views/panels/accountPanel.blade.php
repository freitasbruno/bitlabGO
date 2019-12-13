<div id="cash-container-{{ $account->id }}" data-id="{{ $account->id }}" class="card-deck">
	<div class="uk-grid-small deck-title" uk-grid>
		<div class="uk-width-expand">
			{{ $account->group->name }}
		</div>
		<div class="uk-width-auto">
			<a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
			</a>
		</div>
	</div>
	<div class="scrollbar cardScrollbar">
		<div class="card-container">
			@each('cards.cashCard', $account->cash, 'cash')
		</div>
	</div>
	<div class="force-overflow"></div>	
</div>