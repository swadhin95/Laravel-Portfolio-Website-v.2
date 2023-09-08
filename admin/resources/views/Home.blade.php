@extends('Layout.app')
@section('title','Home')
@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalVisitor}}</h4>
					<h4 class="count-card-text">Total Visitor</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalService}}</h4>
					<h4 class="count-card-text">Total Services</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalProject}}</h4>
					<h4 class="count-card-text">Total Projects</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalCourse}}</h4>
					<h4 class="count-card-text">Total Courses</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalContact}}</h4>
					<h4 class="count-card-text">Total Contacts</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h4 class="count-card-title">{{$TotalReview}}</h4>
					<h4 class="count-card-text">Total Reviews</h4>
				</div>
			</div>
		</div>

	</div>
</div>	

@endsection