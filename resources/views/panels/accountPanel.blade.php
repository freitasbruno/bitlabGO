<div id="cash-container-{{ $account->id }}" data-id="{{ $account->id }}" class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			{{ $account->group->name }}
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newItemBtn" data-type="cash">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="New item">
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