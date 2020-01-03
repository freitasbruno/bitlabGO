<div class="group-card"  data-id="{{ $group->id }}" data-type="groups">
	<div class="group-card-grid">
		@if ($group->children->count() > 0)
			<i class="material-icons group-card-action" data-action="expand">arrow_right</i>
		@else
			<div></div>
		@endif

		<p class="card-text-s">
			{{ strToUpper($group->name) }}
		</p>
		<div class="groupTools">
			<i class="material-icons-outlined group-card-action" data-action="delete">delete</i>					
			{{-- <i class="material-icons-outlined group-card-action" data-action="move">file_copy</i>					 --}}
			{{-- <i class="material-icons-outlined group-card-action" data-action="share">share</i>					 --}}
			<i class="material-icons-outlined group-card-action" data-action="open">visibility</i>
		</div>
		@if ($group->children->count() > 0)
			<div class="count-label">{{ $group->groups->count() }}</div>
		@endif
	</div>
</div>
@if ($group->children->count() > 0)
<div class="nestedGroup" id="nestedGroup-{{ $group->id }}">
		@each('cards.groupCard', $group->groups, 'group')
	</div>
@endif