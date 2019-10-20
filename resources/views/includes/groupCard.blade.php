<div class="card h-100">
	<div class="card-header d-flex justify-content-between">
		<a href="/home/{{ $group->id }}">{{ $group->name }}</a>
		@component('components/itemTools')
			{{ 'home/' . $group -> id }}
		@endcomponent
	</div>
	<div class="card-body">
		<p>{{ $group->description }}</p>
		
		<ul>
		@foreach($group->children as $child)
			<li><a href="/home/{{ $child -> id }}">{{ $child->name }}</a></li>
			
		@endforeach
		</ul>
		
		@if(($group->cashItems)->isNotEmpty())
			<dl class="row">
			<dd class="col-sm-6 text-truncate">Name</dt>
			<dd class="col-sm-6 text-right">Amount</dd>
			@foreach($group->cashItems as $cash)
				<hr class="w-100 mt-0">
				<dt class="col-sm-6 text-truncate">{{ $cash->name }}</dt>
				<dd class="col-sm-6 text-right">{{ $cash->amount . " " . $cash->currency }}</dd>
			@endforeach
		@endif
	</div>
</div>