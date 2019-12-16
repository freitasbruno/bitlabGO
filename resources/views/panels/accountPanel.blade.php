<div id="cash-container-{{ $account->id }}" data-id="{{ $account->id }}" class="card-deck">
	<div class="deck-title" uk-grid>
		<div class="deck-title-text">
			{{ $account->group->name }}
		</div>
		<div class="deck-title-btn">
			<a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.cashCard', $account->cash, 'cash')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>