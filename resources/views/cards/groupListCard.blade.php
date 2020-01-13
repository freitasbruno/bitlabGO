<div class="card filter-card filter-list-card white-40-card" data-id="{{ $group->id }}" data-type="groups">	
	@if ($group->children->count() > 0)
		<i class="material-icons filter-card-action" data-action="expand">arrow_right</i>
		@else
		<div></div>
	@endif

	<p class="card-text-s">
		{{ strToUpper($group->name) }}
	</p>
</div>
@if ($group->children->count() > 0)
	<div class="nestedGroup" id="nestedListGroup-{{ $group->id }}">
		@each('cards.groupListCard', $group->groups, 'group')
	</div>
@endif