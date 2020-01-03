<div class="nested-group-card"  data-id="{{ $group->id }}" data-type="groups">
	<p class="card-text-s">
		{{ strToUpper($group->name) }}
	</p>
	@if ($group->children->count() > 0)
		<div class="count-label">{{ $group->groups->count() }}</div>
		@each('cards.nestedGroupCard', $group->groups, 'group')
	@endif
</div>