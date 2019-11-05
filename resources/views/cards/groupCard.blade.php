<div class="card mb-2">
	<div class="card-body d-flex justify-content-between">
		<a href="/home/{{ $group->id }}">{{ strToUpper($group->name) }}</a>
		@component('components/itemTools')
			{{ 'home/' . $group -> id }}
		@endcomponent
	</div>
</div>
