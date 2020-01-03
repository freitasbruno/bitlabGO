<div class="group-card"  data-id="{{ $group->id }}" data-type="groups">
	<div class="group-card-grid">
		<p class="card-text-s">
			{{ strToUpper($group->name) }}
		</p>
		@if ($group->children->count() > 0)
			<div class="count-label">{{ $group->children->count() }}</div>
		@endif
	</div>
</div>