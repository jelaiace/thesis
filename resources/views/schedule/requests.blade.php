@extends('layout')

@section('title')
  Manage {{ $type === 'incoming' ? 'Incoming' : 'My' }} Requests
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="list-group">
          @foreach($departments as $department)
            <a href="/schedule/{{ $department->id }}" class="list-group-item">
              {{ $department->name }}
            </a>
          @endforeach
        </div>

        <div class="list-group">
          <a href="/schedule/requests" class="list-group-item {{ $type === 'requests' ? 'active': '' }}">
            My Requests
          </a>

          <a href="/schedule/incoming" class="list-group-item {{ $type === 'incoming' ? 'active': '' }}">
            Incoming Requests
          </a>
        </div>
      </div>

      <div class="col-md-9">
        <ul class="nav nav-tabs u-spacer">
          <li role="presentation" {{ $status === 'all' ? 'class=active' : '' }}>
            <a href="/schedule/{{ $type === 'incoming' ? 'incoming' : 'requests' }}">All</a>
          </li>
          <li role="presentation" {{ $status === 'pending' ? 'class=active' : '' }}>
            <a href="/schedule/{{ $type === 'incoming' ? 'incoming' : 'requests' }}?status=pending">
              Pending
              @if ($pending->count())
                <span class="badge">{{ $pending->count() }}</span>
              @endif
            </a>
          </li>
          <li role="presentation" {{ $status === 'approved' ? 'class=active' : '' }}>
            <a href="/schedule/{{ $type === 'incoming' ? 'incoming' : 'requests' }}?status=approved">Approved</a>
          </li>
          <li role="presentation" {{ $status === 'declined' ? 'class=active' : '' }}>
            <a href="/schedule/{{ $type === 'incoming' ? 'incoming' : 'requests' }}?status=declined">Declined</a>
          </li>
        </ul>

        <table class="table">
          <thead>
            <tr>
              <th width="175">Schedule</th>
              <th width="100">Department</th>
              <th>Room</th>
              <th>Subject</th>
              <th>Professor</th>
              <th>Block</th>
              @if($status === 'all')
                <th width="75">
                  Status
                </th>
              @endif
              @if ($type === 'incoming' && ($status === 'pending' || $status === 'all'))
                <th width="75">Action</th>
              @endif
            </tr>
          </thead>

          <tbody>
            @foreach($requests as $request)
              <tr>
                <td>
                  {{ $request->formatted_time }}
                </td>
                <td>
                  {{ $request->room->department->name }}
                </td>
                <td>
                  {{ $request->room->name }}
                </td>
                <td>
                  {{ $request->subject->name }}
                </td>
                <td>
                  {{ $request->professor->name }}
                </td>
                <td>
                  {{ $request->block->name }}
                </td>

                @if ($status === 'all')
                  <th width="75">
                    @if ($request->status === 'pending')
                      <span class="label label-default">Pending</span>
                    @elseif ($request->status === 'approved')
                      <span class="label label-success">Approved</span>
                    @elseif ($request->status === 'declined')
                      <span class="label label-danger">Declined</span>
                    @endif
                  </th>
                @endif

                @if ($type === 'incoming' && ($status === 'pending' || $status === 'all'))
                  <td>
                    @if ($request->status === 'pending')
                      <form action="/schedule/{{ $request->id }}/action" method="POST">
                        {{ method_field('PATCH') }}
                        <div class="btn-group btn-group-xs" role="group">
                          <button class="btn btn-primary" data-toggle="tooltip" title="Approve" name="is_approved" value="1">
                            <i class="glyphicon glyphicon-ok"></i>
                          </button>
                          <button class="btn btn-danger" data-toggle="tooltip" title="Decline" name="is_approved" value="0">
                            <i class="glyphicon glyphicon-remove"></i>
                          </button>
                        </div>
                      </form>
                    @endif
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop