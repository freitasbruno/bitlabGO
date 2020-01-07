@extends('layouts.app')

@section('content')
<div id="main-container">
	<div id="filter-container"></div>	
	<div id="item-container"></div>	
</div>

<!-- Modals -->
@include('modals.itemModal')
@include('modals.groupModal')
@include('modals.groupSelectModal')

@endsection