<form class="fieldForm" action="#" method="post">
	<div class="formContent">
			@switch($field)
				@case('name')
					@include('forms.fields.name')
					@break
				@case('description')
				@include('forms.fields.description')
					@break
				@default				
			@endswitch	
	</div>
</form>