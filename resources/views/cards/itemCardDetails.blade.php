<div class="card-detail-grid">
	<div></div>
	<p class="card-text-xs"><time datetime="2016-04-01T19:00">{{ $item->created_at }}</time></p>

	<i class="material-icons-outlined">folder</i>
	<p class="card-text-s">
		{{ $item->group->name }}
	</p>

	<i class="material-icons-outlined">label</i>
	<p class="card-text-s">
		<span class="card-tag">HOUSE</span>
		<span class="card-tag">ESTORIL</span>
	</p>

	<i class="material-icons">share</i>
	<p class="card-text-s">
		<span class="card-avatar"><img class="icon-25" src="/images/prototype/boy.svg" alt=""></a></span>
		<span class="card-avatar"><img class="icon-25" src="/images/prototype/girl.svg" alt=""></a></span>
	</p>
</div>