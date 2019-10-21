<div class="card h-100">
	<div class="card-header d-flex justify-content-between">
		<a href="/home/{{ $group->id }}">{{ $group->name }}</a>
		@component('components/itemTools')
			{{ 'home/' . $group -> id }}
		@endcomponent
	</div>
	<div class="card-body">
		<p>{{ $group->description }}</p>
		@if($group->children)
			<h5>Groups: {{ $group->children ? $group->children->count() : 0 }}</h5>
			<ul>
				@foreach($group->children as $child)
					<li><a href="/home/{{ $child -> id }}">{{ $child->name }}</a></li>			
				@endforeach
			</ul>
		@else
			<p>No groups found</p>
		@endif
		
		@if($group->cashItems)
			<h5>Expenses . {{ $group->cashItems ? $group->cashItems->count() : 0 }} items</h5>
			<hr class="px-0">
			<dl class="row">
			<dd class="col-sm-6 text-truncate">Name</dt>
			<dd class="col-sm-6 text-right">Amount</dd>
			@foreach($group->cashItems as $cash)
				<hr class="w-100 mt-0">
				<dt class="col-sm-6 text-truncate">{{ $cash->name }}</dt>
				<dd class="col-sm-6 text-right">{{ $cash->amount . " " . $cash->currency }}</dd>
			@endforeach
		@else
			<p>No expenses found</p>
		@endif
	</div>
</div>