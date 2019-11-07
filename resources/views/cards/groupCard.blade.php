<div class="card mb-2">
	<div class="d-flex justify-content-between p-2">
		<a href="/home/{{ $group->id }}">{{ strToUpper($group->name) }}</a>
		@component('components/itemTools')
		{{ 'home/' . $group -> id }}
		@endcomponent
	</div>
</div>