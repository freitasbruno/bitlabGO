<div class="card white-40-card filter-card" data-id="{{ $account->id }}" data-type="accounts">
	<div></div>
	<p class="card-text-s">
		{{ strToUpper($account->group->name) }}
	</p>
	<div class="groupTools">
		<i class="material-icons-outlined filter-card-action" data-action="delete">delete</i>					
		<i class="material-icons-outlined filter-card-action" data-action="open">visibility</i>
	</div>
</div>