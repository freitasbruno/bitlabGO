<div class="itemForm cashForm cash-form-grid">
	<div class="form-group row">
		<input type="text" name="name" value="{{ $item->name ?? '' }}" data-field="name" autocomplete="off" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Name</label>
	</div>
	<div class="form-group">		
		<select name="type" data-field="type" required>			
			<option value="" disabled selected></option>
			<option value="expense" @isset($cashItem) {{ $cashItem->type == 'expense' ? 'selected' : '' }} @endisset>
				Expense</option>
			<option value="income" @isset($cashItem) {{ $cashItem->type == 'income' ? 'selected' : '' }} @endisset>
				Income</option>
		</select>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Type</label>
	</div>
	<div class="form-group">
		<select name="id_account" data-field="account" required>
			<option value="" disabled selected></option>
			@foreach ($accounts as $account)
			<option value="{{ $account->group->id }}">{{ $account->group->name }}</option>
			@endforeach
		</select>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Account</label>
	</div>
	<div class="form-group">
		<input type="number" step=".01" name="amount" value="{{ $cashItem->amount ?? '' }}" data-field="amount" required>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Amount</label>
	</div>
	<div class="form-group">
		<select name="currency" data-field="currency" required>
			@isset($cashItem)
			<option value="{{ $cashItem->currency }}" selected>{{ $cashItem->currency }}</option>
			@endisset
			<option value="EUR">EUR</option>
			<option value="USD">USD</option>
		</select>
		<span class="highlight"></span><span class="bar"></span>
		<label class="label">Currency</label>
	</div>
	<input type="hidden" name="group" value="{{ session()->get('currentGroup')->id }}">
	<input type="hidden" name="itemType" value="cash">
</div>