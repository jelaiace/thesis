<style>
body {
  font-family: 'Helvetica'; 
}

.school-logo {
  text-align: center;
  margin-bottom: 20px;
}
  
.table {
  width: 100%;
  border-spacing: 0px;
}

.table th,
.table td {
  padding: 20px 10px;
  padding-left: 0;
  text-align: left;
  margin: 0;
  background: #fff;
}

.table th {
  border-bottom: 1px solid $color-gray;
}

.table td {
  border-top: 1px solid $color-gray;
}
</style>

<img src="{{ public_path('logo-full.png') }}" class="school-logo" />

<h1>Rooms</h1>

@foreach($rooms as $room)
  <h4>{{ $room->name }} ({{ $room->department->name }})</h4>

  <table class="table">
    <thead>
      <tr>
        <th>Schedule</th>
        <th>Subject</th>
        <th>Professor</th>
        <th>Block</th>
      </tr>
    </thead>

    <tbody>
      @foreach($room->schedules as $schedule)
        <tr>
          <td>{{ $schedule->formatted_time }}</td>
          <td>{{ $schedule->subject->name }}</td>
          <td>{{ $schedule->professor->name }}</td>
          <td>{{ $schedule->block->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endforeach