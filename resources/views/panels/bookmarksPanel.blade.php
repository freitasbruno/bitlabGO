<div class="card-deck">
	<div class="deck-title">
		<div class="deck-title-text">
			BOOKMARKS
		</div>
		<div class="deck-title-btn">
			<a class="newItemBtn" data-value="bookmark">
				<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
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