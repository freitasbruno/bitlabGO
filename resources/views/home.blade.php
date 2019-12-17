@extends('layouts.app')

@section('content')

<div id="main-container">
	
	@if(false)
	<div class="header-container" uk-grid>
		<div class="uk-width-expand">
			<ul class="uk-breadcrumb uk-padding-small uk-light">
				@if (session('currentGroup'))
					@foreach ($groupHierarchy as $group)
						@if($group != end($groupHierarchy))
							<li><a href="/home/{{ $group->id }}">{{ $group->name }}</a></li>
						@else
							<li><span>{{ $group->name }}</span></li>
						@endif
					@endforeach
				@endif			
			</ul>
		</div>
		
		<div class="uk-padding-small">
			<a href="" class="uk-icon-button" uk-icon="icon: plus"></a>
			<div uk-dropdown="pos: top-right; mode: click" class="uk-card uk-card-default uk-card-body">
				<ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
					<li class="uk-nav-header">Add new...</li>
					<li><a class="newItemBtn" data-value="group" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: folder"></span>Group</a>
					</li>
					<li class="uk-nav-divider"></li>
					<li><a class="newItemBtn" data-value="task" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: check"></span>Task</a>
					</li>
					<li><a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: credit-card"></span>Expense</a>
					</li>
					<li><a class="newItemBtn" data-value="timer" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: clock"></span>Timer</a>
					</li>
					<li><a class="newItemBtn" data-value="bookmark" uk-toggle="target: #itemModal">
						<span class="uk-margin-small-right" uk-icon="icon: bookmark"></span>Bookmark</a>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="uk-grid uk-child-width-1-3">
			<div>
				<h4>GROUP TOTALS</h4>
				<div>Total Expense: {{ $totals['expense'] }}</div>
				<div>Total Income: {{ $totals['income'] }}</div>
				<div>Balance: {{ $totals['income'] - $totals['expense'] }}</div>
			</div>
			<div>
				<h4>USER TOTALS</h4>
				<div>Total Expense:
					{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}
				</div>
				<div>Total Income:
					{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') }}
				</div>
				<div>Balance:
					{{ App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'income')->sum('amount') - App\Models\Items\CashItem::where('id_user', Auth::id())->where('type', 'expense')->sum('amount') }}
				</div>
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
	@endif

	@if (false)
		<ul id="item-display-area" uk-accordion="multiple: true">
			@if($groups)
			<li class="uk-open">
				<a class="uk-accordion-title uk-light" href="#">GROUPS</a>
				<div class="uk-accordion-content">
					<div class="uk-grid-collapse uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-child-width-1-6@l" uk-grid>
						@foreach($groups as $group)
						<div>
							@include('cards/groupDeck')
						</div>
						@endforeach		
					</div>
				</div>
			</li>
			@endif

			@if($bookmarks)
			<li>
				<a class="uk-accordion-title" href="#">BOOKMARKS</a>
				<div class="uk-accordion-content">
					<div class="item-container">					
						<div class="grid uk-grid-small uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-grid>					
							@each('panels.bookmarkPanel', $bookmarks, 'item')					
						</div>	
					</div>	
				</div>
			</li>
			@endif
			
			@if($tasks)
			<li>
				<a class="uk-accordion-title" href="#">TASKS</a>
				<div class="uk-accordion-content">
					<div class="item-container">					
						@each('panels.taskPanel', $tasks, 'item')					
					</div>	
				</div>
			</li>
			@endif

			@if($timers)
			<li>
				<a class="uk-accordion-title uk-light" href="#">TIMERS</a>
				<div class="uk-accordion-content">
					<div class="row mx-0 table-responsive">
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
				</div>
			</li>
			@endif
			
		</ul>
	

		@if($accounts)
			@foreach ($accounts as $account)
			<div id="cash-container-{{ $account->id }}" data-id="{{ $account->id }}" class="card-deck">
				<div class="uk-grid-small deck-title" uk-grid>
					<div class="uk-width-expand">
						{{ $account->group->name }}
					</div>
					<div class="uk-width-auto">
						<a class="newItemBtn" data-value="cash" uk-toggle="target: #itemModal">
							<img class="share-avatar" src="/images/prototype/plus-white.svg" alt="My SVG Icon">
						</a>
					</div>
				</div>
				<div class="scrollbar cardScrollbar">
					<div class="card-container">
						@each('cards.cashCard', $account->cash, 'cash')
						@each('cards.cashModal', $account->cash, 'cash')
					</div>
				</div>
				<div class="force-overflow"></div>	
			</div>
			@endforeach	
			<div class="bottom-nav uk-position-bottom-center uk-position-small">
				<ul class="uk-dotnav">
					@foreach ($accounts as $account)
						<li data-item="{{ $account->id }}"><a href="#">{{ $account->name }}</a></li>
					@endforeach
				</ul>
			</div>			
		@endif
	@endif
	
	
</div>
<!-- Modals -->
{{-- @include('forms.newItemModal') --}}
@include('cards.itemModal')

@endsection