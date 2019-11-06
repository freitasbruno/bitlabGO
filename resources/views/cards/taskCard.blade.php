<div class="card mb-2">
	<div class="card-body d-flex justify-content-between">
		<form action="/tasks/toggleComplete/{{ $item->id }}" method="POST">			
			<p class="m-0">
			<input 
				class="form-check-input taskCheckbox {{ $item->complete ? 'taskComplete' : false}}" 
				type="checkbox" 
				value="{{ $item->id }}" 
				{{ $item->complete ? 'checked' : false}}>
				{{ $item->name }}
			</p>			
		</form>		
		@component('components/itemTools')
			{{ 'tasks/' . $item->id }}
		@endcomponent
	</div>
</div>
