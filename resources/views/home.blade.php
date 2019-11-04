@extends('layouts.app')

@section('content')
<div class="container">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			@if (session('currentGroup'))
				@foreach ($groupHierarchy as $group)
					@if($group != end($groupHierarchy))
						<li class="breadcrumb-item"><a href="/home/{{ $group -> id }}">{{ $group -> name }}</a></li>
					@else
						<li class="breadcrumb-item active">{{ $group -> name }}</li>
					@endif
				@endforeach
			@endif
			<li class="breadcrumb-item">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#groupModal"><i class="fas fa-plus dark"></i>New Group</button>
			</li>
		</ol>			
	</nav>
	<div class="row">
		<div class="col-4">
			<h4>GROUP TOTALS</h4>
			<div>Total Expense: {{ $totals['expense'] }}</div>
			<div>Total Income: {{ $totals['income'] }}</div>
			<div>Balance: {{ $totals['income'] - $totals['expense'] }}</div>	
		</div>
		<div class="col-4">
			<h4>USER TOTALS</h4>
			<div>Total Expense: {{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}</div>
			<div>Total Income: {{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') }} </div>
			<div>Balance: {{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') - App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}</div>	
		</div>		
		<div class="col-4">
			<h4 >USER ACCOUNTS</h4>
			@foreach ($accounts as $account)
				<div>
				<a href="/accounts/{{ $account->id }}">{{ $account['name'] }}</a> : {{ $account['balance'] }} {{ $account['currency'] }}				
				</div>
			@endforeach
		</div>	
	</div>	

	<h1>GROUPS</h1>
	<div class="row">
		@if($groups)
			@foreach($groups as $group)
			<div class="col-lg-4 col-md-6 mb-3">
				@include('includes/groupCard')
			</div>
			@endforeach
		@endif
	</div>

	<div class="row mx-0 table-responsive">
		<h1>EXPENSES</h1>

		@if($cashItems)
			<table class="table">
				<tbody>
					@foreach($cashItems as $cashItem)
					<tr>
						<td>{{ $cashItem->name }}</td>
						<td>{{ $cashItem->account->name }}</td>
						<td class="text-right">{{ ($cashItem->type == 'expense' ? '-' : '+') . number_format((float)($cashItem->amount), 2, '.', '') }}</td>
						<td>{{ $cashItem -> currency }}</td>
						<td class="text-center">{{ $cashItem->created_at->format("Y-m-d") }}</td>
						<td class="text-right">
							@component('components/itemTools')
								{{ 'cashItems/' . $cashItem -> id }}
							@endcomponent
						</td>						
					</tr>
					@endforeach
				</tbody>
			</table>
		@endif
		
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cashItemModal">
			New Transaction
		</button>

		<!-- Modals -->
		@include('includes.newCashItemModal')
		@include('includes.newGroupModal')

	</div>
</div>
@endsection