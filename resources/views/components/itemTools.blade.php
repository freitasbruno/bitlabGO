<!-- /resources/views/components/itemTools.blade.php -->
<a href="" class="uk-icon-link uk-align-right" uk-icon="menu"></a>
<div uk-dropdown="mode: click">
	<p class="uk-text-center">Edit Group</p>			
    <ul class="uk-nav uk-dropdown-nav">
		<li class="uk-nav-divider"></li>
		<li><a>Rename</a></li>
        <li>
			<a class="itemTools">Group settings</a>		
			<form method="post" action="/{{ $slot }}/edit">
				@csrf
				@method('GET')
			</form>
		</li>
		<li><a>Move group</a></li>
		<li><a>Share group</a></li>
		<li class="uk-nav-divider"></li>
        <li>
			<a class="itemTools">Delete</a>
			<form method="post" action="/{{ $slot }}">
				@csrf
				@method('DELETE')
			</form>
		</li>
    </ul>
</div>