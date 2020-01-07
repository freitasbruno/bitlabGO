<div class="group-card group-list-card" data-id="{{ $group->id }}" data-type="groups">	
	<div class="group-card-grid">			
	@if ($group->children->count() > 0)
		<i class="material-icons group-card-action" data-action="expand">arrow_right</i>
		@else
		<div></div>
	@endif

	<p class="card-text-s">
		{{ strToUpper($group->name) }}
	</p>
	</div>
</div>
@if ($group->children->count() > 0)
	<div class="nestedGroup" id="nestedListGroup-{{ $group->id }}">
		@each('cards.groupListCard', $group->groups, 'group')
	</div>
@endif