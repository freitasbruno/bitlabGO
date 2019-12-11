<div id="cash-modal-{{ $cash->id }}" class="uk-flex-top" uk-modal>
	<div class="uk-modal-dialog uk-margin-auto-vertical">

		<!-- Main Card -->
		<div class="cash-modal">
			<div class="uk-grid-small" uk-grid>
				<div class="uk-width-expand">
					<p class="card-text-l">{{ $cash->item->name }}</p>
				</div>
				<div class="uk-width-auto uk-flex-middle">
					<a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: more"></span>
					</a>
				</div>
			</div>
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					@if ($cash->type == 'expense')
					<span class="icon-expense" uk-icon="icon: arrow-down; ratio: 2"></span>
					@else
					<span class="icon-income" uk-icon="icon: arrow-up; ratio: 2"></span>
					@endif
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<p class="card-text-l">€{{ $cash->amount }}</p>
					<p class="card-text-s">{{ $cash->item->description }}</p>
					<br>
					<p class="card-text-s"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>
				</div>
			</div>
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					<span uk-icon="tag"></span>
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<span class="uk-badge">HOUSE</span>
					<span class="uk-badge">MIEKE</span>
				</div>
			</div>
			@if ($cash->item->parent)
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					<span uk-icon="folder"></span>
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<p class="card-text-m">{{ $cash->item->parent->name }}</p>
				</div>
			</div>
			@endif
			<br>
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					<span uk-icon="social"></span>
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<img class="share-avatar" src="/images/prototype/boy.svg" alt="My SVG Icon">
					<img class="share-avatar" src="/images/prototype/girl-1.svg" alt="My SVG Icon">
				</div>
			</div>
		</div>

		<!-- Linked Items Card -->
		<div class="cash-modal">	
			<div class="uk-grid-small" uk-grid>
				<div class="uk-width-expand">
				</div>
				<div class="uk-width-auto uk-flex-middle">
					<a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
						<img class="share-avatar" src="/images/prototype/plus.svg" alt="My SVG Icon">
					</a>
				</div>
			</div>		
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					<span uk-icon="download"></span>
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<p class="card-text-m">file_1.jpg</p>
					<p class="card-text-xs"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>
				</div>
			</div>
			<div class="uk-grid-small" uk-grid>
				<div class="cash-card-icon-col">
					<span uk-icon="download"></span>
				</div>
				<div class="uk-width-expand uk-flex-middle">
					<p class="card-text-m">file_2.jpg</p>
					<p class="card-text-xs"><time datetime="2016-04-01T19:00">{{ $cash->created_at }}</time></p>
				</div>
			</div>
		</div>
	</div>
</div>