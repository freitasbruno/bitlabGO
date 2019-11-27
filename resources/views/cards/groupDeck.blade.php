<div class="uk-card uk-card-hover group-deck">
	<div class="uk-card-header">
		<a href="/home/{{ $group->id }}">{{ $group->name }}</a>
		@component('components/itemTools')
			{{ 'home/' . $group->id }}
		@endcomponent
	</div>
	<div class="uk-card-body">
		<span>Show details</span>
		<a href="" 
		    uk-icon="chevron-down" 
			uk-toggle="target: .group-description-{{ $group->id }}; animation: uk-animation-fade; queued: true">
		</a>		
		<p class="group-description-{{ $group->id }}" hidden>{{ $group->description }}</p>
		<hr>
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
	</div>
</div>