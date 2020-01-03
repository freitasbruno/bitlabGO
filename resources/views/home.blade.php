@extends('layouts.app')

@section('content')
<div id="main-container">
	<div id="filter-container"></div>	
	<div id="item-container"></div>	
</div>

<!-- Modals -->
@include('cards.itemModal')
@include('cards.groupModal')

@endsection