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
  border-bottom: 1px solid $color-gray;;
}

.table td {
  border-top: 1px solid $color-gray;
}
</style>

<img src="{{ public_path('logo-full.png') }}" class="school-logo" />

<h1>{{ $user->name }}'s Schedule</h1>

@foreach($groups as $day => $schedules)
  <h3>{{ $schedules->first()->day_name }}</h3>

  <table class="table">
    <thead>
      <tr>
        <th>Schedule</th>
        <th>Room</th>
        <th>Block</th>
        <th>Department</th>
        <th>Subject</th>
      </tr>
    </thead>

    <tbody>
      @foreach($schedules as $schedule)
        <tr>
          <td>{{ $schedule->formatted_time }}</td>
          <td>{{ $schedule->room->name }}</td>
          <td>{{ $schedule->block->name }}</td>
          <td>{{ $schedule->room->department->name }}</td>
          <td>{{ $schedule->subject->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endforeach