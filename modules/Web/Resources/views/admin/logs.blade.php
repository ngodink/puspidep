@extends('web::layouts.admin')

@section('title', 'User log - ')

@php($user = \Auth::user())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-account-outline"></i> User log</strong>
	</h5>
</div>
<div class="card border-0 mb-4">
	<div class="card-header bg-gray-200">
		<i class="mdi mdi-view-list-outline"></i> User log ({{ $logs->total() }})
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover mb-0">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Log</th>
					<th>Tanggal</th>
				</tr>
			</thead>
			<tbody>
				@forelse($logs as $log)
					<tr>
						<td>{{ $logs->firstItem() + $loop->iteration - 1 }}</td>
						<td><strong>{{ $log->user->profile->name }}</strong></td>
						<td>{!! $log->log !!}</td>
						<td>{{ $log->created_at }}</td>
					</tr>
				@empty
					<tr>
						<td class="text-center" colspan="4">Tidak ada data</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="card-body">
		{{ $logs->appends(request()->all())->links() }}
	</div>
</div>
@endsection