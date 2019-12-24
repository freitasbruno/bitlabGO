<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			BOOKMARKS
		</div>
		<div class="deck-title-btn">
			<a href="#" class="newItemBtn" data-type="bookmarks">
				<i class="material-icons">add_circle</i>
			</a>
		</div>
	</div>
	<div class="cardScrollbar">
		<div class="card-container">
			@each('cards.bookmarkCard', $bookmarks, 'bookmark')
		</div>
		<div class="force-overflow"></div>	
	</div>
</div>