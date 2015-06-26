@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">@lang('panel.status')</div>

				<div class="panel-body">
					@lang('panel.loggedin')
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">@lang('panel.account')</div>

				<div class="panel-body">
					<table class="table table-striped">
						<tbody>
@foreach ($user as $key => $attribute)
							<tr>
								<th>@lang("panel.user-attributes.$key")</th>
								<td>{{ $attribute }}</td>
							</tr>
@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
