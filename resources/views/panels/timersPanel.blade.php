<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			TIMERS
		</div>
		<div class="deck-title-btn">
			<a class="newItemBtn" data-value="timer">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.timerCard', $timers, 'timer')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>