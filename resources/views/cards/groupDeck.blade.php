<div class="uk-card uk-card-hover group-deck">

	<!-- CARD HEADER -->
	<div class="card-header uk-grid">
		<a class="uk-width-expand uk-text-truncate" href="/home/{{ $group->id }}">{{ $group->name }}</a>
		<div class="uk-width-auto">
			@component('components/groupTools', ['id' => $group->id])
				{{ 'home/' . $group->id }}
			@endcomponent
		</div>
	</div>
	<!-- CARD HEADER -->

	<!-- CARD BODY -->
	<div class="uk-card-body">
		<div class="scrollbar cardScrollbar">
			<p class="mb-0">Totals</p>		
			<div class="d-flex justify-content-between mb-3">
				<div>{{ $group->cashTotals['expense'] }}</div>
				<div>{{ $group->cashTotals['income'] }}</div>
				<div>{{ $group->cashTotals['balance'] }}</div>
			</div>	
			
			@if($group->children)
				<h5>Groups: {{ $group->children ? $group->children->count() : 0 }}</h5>
				@each('cards.groupCard', $group->children, 'group')
			@endif
			
			@if($group->tasks()->isNotEmpty())
				<h5>Tasks . {{ $group->tasks()->count()}} items</h5>
				@each('cards.taskCard', $group->tasks(), 'item')
			@endif
			
			@if($group->timers()->isNotEmpty())
				<h5>Timers . {{ $group->timers()->count()}} items</h5>
				@each('cards.timerCard', $group->timers(), 'item')
			@endif
	
			@if($group->cash()->isNotEmpty())
				<h5>Expenses . {{ $group->cash()->count()}} items</h5>
				@each('cards.cashCard', $group->cash(), 'item')
			@endif
	
			@if($group->bookmarks()->isNotEmpty())
				<h5>Bookmarks . {{ $group->bookmarks()->count()}} items</h5>
				@each('cards.bookmarkCard', $group->bookmarks(), 'item')
			@endif

			<div class="force-overflow"></div>
		</div>
	</div>
	<!-- CARD BODY -->

</div>