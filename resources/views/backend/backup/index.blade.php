@extends('backend.layouts.app')

@section('title', app_name() . ' | ادراة companys')

@section('content')
<div class="card">
	<div class="card-body">

		<div class="row justify-content-between">
			<div class="col-sm-4">
				<h4 class="card-title mb-0">
					النسخ الاحتياطي
				</h4>
			</div>
		</div>
		<!--row-->
		<hr>
		<div class="col-sm-4">
			<h4 class="card-title mb-0">
				<a href="{{ route('admin.take.db.backup') }}" class="btn btn-success">انشاء نسخة احتياطية عن قاعدة البيانات</a>
			</h4>
		</div>
		<!--col-->

	</div>
	<!--card-body-->
</div>
<!--card-->
@endsection