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
			<button type="button" class="btn btn-link p-0 newItemBtn" data-value="group" data-toggle="modal" data-target="#itemModal"><i
					class="fas fa-plus dark"></i>New Group</button>
		</li>
	</ul>
	<div  class="uk-container">
		<div class="uk-grid">
			<div class="uk-width-1-3@m">
				<h4>GROUP TOTALS</h4>
				<div>Total Expense: {{ $totals['expense'] }}</div>
				<div>Total Income: {{ $totals['income'] }}</div>
				<div>Balance: {{ $totals['income'] - $totals['expense'] }}</div>
			</div>
			<div class="uk-width-1-3@m">
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
			<div class="uk-width-1-3@m">
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
</div>
<div class="container">
	

	@if($groups)
	<h1>GROUPS</h1>
	<div class="row">
		@foreach($groups as $group)
		<div class="col-lg-4 col-md-6 mb-3">
			@include('includes/groupCard')
		</div>
		@endforeach
		<div class="col-lg-4 col-md-6 mb-3">
			<div class="mdc-card card">
					<div class="mdc-form-field">
							<div class="mdc-checkbox">
							  <input type="checkbox"
									 class="mdc-checkbox__native-control"
									 id="checkbox-1"/>
							  <div class="mdc-checkbox__background">
								<svg class="mdc-checkbox__checkmark"
									 viewBox="0 0 24 24">
								  <path class="mdc-checkbox__checkmark-path"
										fill="none"
										d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
								</svg>
								<div class="mdc-checkbox__mixedmark"></div>
							  </div>
							  <div class="mdc-checkbox__ripple"></div>
							</div>
							<label for="checkbox-1">Checkbox 1</label>
						  </div>
				My MDC card
			</div>
		</div>
		<div class="mdc-card">
				<div class="mdc-card__primary-action">
				  <div class="mdc-card__media mdc-card__media--square">
					<div class="mdc-card__media-content">Title</div>
				  </div>
				  <!-- ... additional primary action content ... -->
				</div>
				<div class="mdc-card__actions">
				  <div class="mdc-card__action-buttons">
					<button class="mdc-button mdc-card__action mdc-card__action--button">
					  <span class="mdc-button__label">Action 1</span>
					</button>
					<button class="mdc-button mdc-card__action mdc-card__action--button">
					  <span class="mdc-button__label">Action 2</span>
					</button>
				  </div>
				  <div class="mdc-card__action-icons">
					<button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="Share">share</button>
					<button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="More options">more_vert</button>
				  </div>
				</div>
			  </div>
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