@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<strong>@lang('strings.backend.dashboard.welcome') {{ $logged_in_user->name }}!</strong>
			</div><!--card-header-->

			<div class="card-body">
				<div class="light-red">
					<label class="h1">بيانات مالية</label>
				</div>
				<hr />
				<div>
					<label class="h2">الايرادات الاجمالية: </label> <label class="h2" id="total_income">{{$income}} </label>
				</div>
				<div>
					<label class="h2">المصاريف الاجمالية: </label> <label class="h2" id="total_cost">{{$costs}} </label>
				</div>
				<hr />
				<div class="col-5 color-a">
					<div>
						<label class="h1">البيانات ضمن فترة محددة</label>
					</div>
					<div class="form-group row">
						<div class="col-md-3">
							من تاريخ:
						</div>
						<div class="col-md-3">
							<input type="date" name="from" id="from_date">
						</div>
						<!--col-->
					</div>
					<!--form-group-->
					<div class="form-group row">
						<div class="col-md-3">
							<label>الى تاريخ:</label>
						</div>
						<div class="col-md-3">
							<input type="date" name="to" id="to_date">
						</div>
						<!--col-->
					</div>
					<!--form-group-->
					<button calss="btn btn-success btn-sm pull-right" onclick="getMoney()">موافق</button>
					<div class="spinner-border text-primary" role="status" id="spinner">
						<span class="sr-only">Loading...</span>
					</div>
					<div>
						<label class="h2">الايرادات : </label> <label class="h2" id="income">{{$income}} </label>
					</div>
					<div>
						<label class="h2">المصاريف : </label> <label class="h2" id="cost">{{$costs}} </label>
					</div>
				</div>
			</div><!--card-body-->

		</div><!--card-->
	</div><!--col-->
</div><!--row-->
@endsection