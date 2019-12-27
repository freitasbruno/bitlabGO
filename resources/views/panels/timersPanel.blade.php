<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			TIMERS
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newItemBtn" data-type="timers">
				<i class="material-icons">add_circle</i>
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