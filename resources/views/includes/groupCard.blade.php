<div class="card h-100">
	<div class="card-header d-flex justify-content-between">
		<a href="/home/{{ $group->id }}">{{ $group->name }}</a>
		@component('components/itemTools')
			{{ 'home/' . $group -> id }}
		@endcomponent
	</div>
	<div class="card-body p-2">
		<p>{{ $group->description }}</p>

		<p class="mb-0">Totals</p>		
		<div class="d-flex justify-content-between mb-3">
			<div>{{ $group->cashTotals['expense'] }}</div>
			<div>{{ $group->cashTotals['income'] }}</div>
			<div>{{ $group->cashTotals['balance'] }}</div>
		</div>	
		
		@if($group->children)
			<h5>Groups: {{ $group->children ? $group->children->count() : 0 }}</h5>
			@each('cards.groupCard', $group->children, 'group')
		@else
			<p>No groups found</p>
		@endif
		
		@if($group->tasks->isNotEmpty())
			<h5>Tasks . {{ $group->tasks->count()}} items</h5>
			@each('cards.taskCard', $group->tasks, 'item')			
		@else
			<p>No tasks found</p>
		@endif

		@if($group->cashItems->isNotEmpty())
			<h5>Expenses . {{ $group->cashItems->count()}} items</h5>
			@each('cards.cashCard', $group->cashItems, 'item')			
		@else
			<p>No expenses found</p>
		@endif
	</div>
</div>