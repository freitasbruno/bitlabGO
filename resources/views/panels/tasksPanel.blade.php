<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			TASKS
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newItemBtn" data-type="tasks">
				<i class="material-icons">add_circle</i>
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.taskCard', $items, 'item')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>