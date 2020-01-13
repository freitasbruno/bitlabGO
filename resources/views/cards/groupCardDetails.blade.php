<div></div>
<p class="card-text-xs"><time datetime="2016-04-01T19:00">{{ $filter->created_at }}</time></p>

<i class="material-icons-outlined">label</i>
<div>
	<span class="card-tag">HOUSE</span>
	<span class="card-tag">ESTORIL</span>
</div>

@if ($type == 'group')
<i class="material-icons-outlined">folder</i>
<div>
	<p class="card-text-s selectGroupBtn">{{ $filter->parent->name }}</p>
</div>
@endif

<i class="material-icons">share</i>
<div>
	<span class="card-avatar"><img class="icon-25" src="/images/prototype/boy.svg" alt=""></a></span>
	<span class="card-avatar"><img class="icon-25" src="/images/prototype/girl.svg" alt=""></a></span>
</div>