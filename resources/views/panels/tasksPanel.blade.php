<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			TASKS
		</div>
		<div class="deck-title-btn">
			<a class="newItemBtn" data-value="task">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.taskCard', $tasks, 'task')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>