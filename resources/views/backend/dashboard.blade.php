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
                    <div class="col-5 alert ">
					<div>
						<label class="h1">الصندوق</label>
					</div>
					<hr/>
					
					<div>
						<label class="h2">الموجودات الاجمالية: </label>
					</div>
					<div>
						<label class="h2">المطاليب: </label>
					</div>
					<div>
						<label class="h2">راس المال: </label>
					</div>
					</div>
                </div><!--card-body-->
				
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection
