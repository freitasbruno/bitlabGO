<div class="group-card"  data-id="{{ $group->id }}" data-type="groups">
	<div class="group-card-grid">
		<p class="card-text-s">
			{{ strToUpper($group->name) }}
		</p>
		<div class="groupTools">
			<i class="material-icons-outlined group-card-action" data-action="delete">delete</i>					
			<i class="material-icons-outlined group-card-action" data-action="move">file_copy</i>					
			<i class="material-icons-outlined group-card-action" data-action="share">share</i>					
			<i class="material-icons-outlined group-card-action" data-action="open">visibility</i>
			<i class="material-icons-outlined group-card-action" data-action="expand">expand_more</i>
		</div>
		@if ($group->children->count() > 0)
			<div class="count-label">{{ $group->children->count() }}</div>
		@endif
	</div>
</div>