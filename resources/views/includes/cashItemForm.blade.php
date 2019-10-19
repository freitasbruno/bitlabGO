<div class="modal-body">
	<div class="form-group">
		<label for="id_group">Type</label>
		<select name="type" class="form-control" id="type">
			<option value="expense" @isset($item) {{ $item->type == 'expense' ? 'selected' : '' }} @endisset >Expense</option>
			<option value="income" @isset($item) {{ $item->type == 'income' ? 'selected' : '' }} @endisset >Income</option>
		</select>
	</div>
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" name="name" value="{{ $item->name ?? '' }}" class="form-control" id="name" placeholder="Coffee and biscuits..." autocomplete="off" required>
	</div>
	<div class="form-group">
		<label for="id_group">Group</label>
		<select name="group" class="form-control" id="id_group">
			<option value="session()->get('currentGroup')->id">{{ session()->get('currentGroup')->name ?? 'NONE' }}</option>
		</select>
	</div>
	<div class="form-row">
		<div class="form-group col-8">
			<label for="name">Amount</label>
			<input type="number" step=".01" name="amount" value="{{ $item->amount ?? '' }}" class="form-control" id="amount" placeholder="eg. 5.60" required>
		</div>
		<div class="form-group col-4">
			<label for="currency">Currency</label>
			<select name="currency" class="form-control" id="currency">
				@isset($item)
					<option value="{{ $item->currency }}" selected>{{ $item->currency }}</option>
				@endisset
				<option value="EUR">EUR</option>
				<option value="USD">USD</option>
			</select>
		</div>
	</div>
</div>