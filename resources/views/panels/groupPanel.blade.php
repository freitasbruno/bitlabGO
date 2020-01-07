<div class="card-deck">
	<div class="deck-title">
		<div class="filter">
			<i class="material-icons-outlined filter-link">folder</i>
		</div>
		<div class="deck-title-text">
			GROUPS			
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newGroupBtn" data-type="cash">
				<i class="material-icons">add_circle</i>
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.groupCard', $groups, 'group')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>