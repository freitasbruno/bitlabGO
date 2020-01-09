<div class="account-card"  data-id="{{ $account->id }}" data-type="accounts">
	<div class="group-card-grid">
		<div></div>
		<p class="card-text-s">
			{{ strToUpper($account->group->name) }}
		</p>
		<div class="groupTools">
			<i class="material-icons-outlined account-card-action" data-action="delete">delete</i>					
			{{-- <i class="material-icons-outlined group-card-action" data-action="move">file_copy</i>					 --}}
			{{-- <i class="material-icons-outlined group-card-action" data-action="share">share</i>					 --}}
			<i class="material-icons-outlined account-card-action" data-action="open">visibility</i>
		</div>
	</div>
</div>