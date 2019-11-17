@extends('layouts.app')

@section('content')
<div class="container">
	<?php //dd($cash) ?>
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
				<button type="button" class="btn btn-link p-0 newItemBtn" data-value="group" data-toggle="modal" data-target="#itemModal"><i
						class="fas fa-plus dark"></i>New Group</button>
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
			{{-- <div>Total Expense:
				{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}
			</div>
			<div>Total Income:
				{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') }}
			</div>
			<div>Balance:
				{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') - App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}
			</div> --}}
		</div>
		<div class="col-4">
			<h4>USER ACCOUNTS</h4>
			@foreach ($accounts as $account)
			<div>
				<a href="/accounts/{{ $account->id }}">{{ $account['name'] }}</a> : {{ $account->account['balance'] }}
				{{ $account->account['currency'] }}
			</div>
			@endforeach
		</div>
	</div>

	@if($groups)
	<h1>GROUPS</h1>
	<div class="row">
		@foreach($groups as $group)
		<div class="col-lg-4 col-md-6 mb-3">
			@include('includes/groupCard')
		</div>
		@endforeach
	</div>
	@endif

	@if($bookmarks)
	<div class="row mx-0 table-responsive">
		<h1>BOOKMARKS</h1>
		<table class="table">
			<tbody>
				@foreach($bookmarks as $bookmark)
				<tr>
					<td>{!! $bookmark->name !!}</td>
					<td class="text-left">{{ $bookmark->bookmark->url }}</td>
					<td class="text-right">
						@component('components/itemTools')
						{{ 'bookmarks/' . $bookmark->bookmark->id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="bookmark" data-toggle="modal" data-target="#itemModal">
		New Bookmark
	</button>

	@if($tasks)
	<div class="row mx-0 table-responsive">
		<h1>TASKS</h1>
		<table class="table">
			<tbody>
				@foreach($tasks as $task)
				<tr>
					<td>{{ $task->name }}</td>
					<td class="text-center">{{ $task->created_at->format("Y-m-d") }}</td>
					<td class="text-right">
						@component('components/itemTools')
						{{ 'tasks/' . $task -> id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="task" data-toggle="modal" data-target="#itemModal">
		New Task
	</button>

	@if($timers)
	<div class="row mx-0 table-responsive">
		<h1>TIMERS</h1>
		<table class="table">
			<tbody>
				@foreach($timers as $timer)
				<tr>
					<td>{{ $timer->name }}</td>
					<td class="text-center">{{ $timer->start }}</td>
					@if($timer->stop)
						<td class="text-center">{{ $timer->stop }}</td>
					@else
						<td class="text-center">
							<button type="button" class="btn btn-link timerStopBtn" value="{{ $timer->id }}">Stop</button>
						</td>
					@endif
					<td class="text-right">
						@component('components/itemTools')
						{{ 'tasks/' . $timer->id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="timer" data-toggle="modal" data-target="#itemModal">
		New Timer
	</button>

	@if($cash)
	<div class="row mx-0 table-responsive">
		<h1>EXPENSES</h1>
		<table class="table">
			<tbody>
				@foreach($cash as $item)
				<tr>
					<td>{{ $item->name }}</td>
					{{-- <td>{{ $item->account()->name }}</td> --}}
					<td class="text-right">
						{{ ($item->cash->type == 'expense' ? '-' : '+') . number_format((float)($item->cash->amount), 2, '.', '') }}
					</td>
					<td>{{ $item->cash->currency }}</td>
					<td class="text-center">{{ $item->cash->created_at->format("Y-m-d") }}</td>
					<td class="text-right">
						{{ $item->cash->id }}
						@component('components/itemTools')
						{{ 'cash/' . $item->cash->id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="cash" data-toggle="modal" data-target="#itemModal">
		New Transaction
	</button>

	<!-- Modals -->
	@include('forms.newItemModal')
	
</div>
@endsection