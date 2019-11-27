@extends('layouts.app')

@section('content')

<div class="uk-background-primary uk-light pl-20 pr-20 pt-10 pb-10">
	<ul class="uk-breadcrumb">
		@if (session('currentGroup'))
			@foreach ($groupHierarchy as $group)
				@if($group != end($groupHierarchy))
					<li><a href="/home/{{ $group->id }}">{{ $group->name }}</a></li>
				@else
					<li><span>{{ $group->name }}</span></li>
				@endif
			@endforeach
		@endif
		<li>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-link p-0 newItemBtn" data-value="group" uk-toggle="target: #itemModal">
				<i class="fas fa-plus dark"></i>New Group</button>
		</li>
	</ul>

	<div class="uk-grid uk-child-width-1-3">
		<div>
			<h4>GROUP TOTALS</h4>
			<div>Total Expense: {{ $totals['expense'] }}</div>
			<div>Total Income: {{ $totals['income'] }}</div>
			<div>Balance: {{ $totals['income'] - $totals['expense'] }}</div>
		</div>
		<div>
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
		<div>
			<h4>USER ACCOUNTS</h4>
			@foreach ($accounts as $account)
			<div>
				<a href="/accounts/{{ $account->id }}">{{ $account['name'] }}</a> : {{ $account->account['balance'] }}
				{{ $account->account['currency'] }}
			</div>
			@endforeach
		</div>
	</div>
</div>

<div class="groups-container">
	@if($groups)
		<div class="row no-gutters">
			@foreach($groups as $group)
			<div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
				@include('cards/groupDeck')
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
	<button type="button" class="btn btn-primary newItemBtn" data-value="bookmark" uk-toggle="target: #itemModal">
		New Bookmark
	</button>

	<button class="mdc-button mdc-button--raised">
		<div class="mdc-button__ripple  mdc-ripple-surface--primary"></div>
		<span class="mdc-button__label">Button</span>
	</button>

	@if($tasks)
	<div class="row mx-0 table-responsive">
		<h1>TASKS</h1>
		<table class="table">
			<tbody>
				@foreach($tasks as $task)
				<tr>
					<td>{{ $task->name }}</td>
					<td class="text-center">{{ $task->task->created_at->format("Y-m-d") }}</td>
					<td class="text-right">
						@component('components/itemTools')
						{{ 'tasks/' . $task->task->id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="task" uk-toggle="target: #itemModal">
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
					<td class="text-center">{{ $timer->timer->start }}</td>
					@if($timer->timer->stop)
						<td class="text-center">{{ $timer->timer->stop }}</td>
					@else
						<td class="text-center">
							<button type="button" class="btn btn-link timerStopBtn" value="{{ $timer->timer->id }}">Stop</button>
						</td>
					@endif
					<td class="text-right">
						@component('components/itemTools')
						{{ 'tasks/' . $timer->timer->id }}
						@endcomponent
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endif
	
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary newItemBtn" data-value="timer" uk-toggle="target: #itemModal">
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
	<button type="button" class="btn btn-primary newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
		New Transaction
	</button>

	<!-- Modals -->
	@include('forms.newItemModal')
	
</div>
@endsection