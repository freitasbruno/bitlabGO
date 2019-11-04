@extends('layouts.app')

@section('content')
<div class="container">
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

	</div>
</div>
@endsection