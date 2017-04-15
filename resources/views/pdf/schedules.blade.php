<style>
body {
  font-family: 'Helvetica'; 
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

<h1>Schedules</h1>
<h4>{{ $user->name }}</h4>

<table class="table">
  <thead>
    <tr>
      <th>Day</th>
      <th>Room</th>
      <th>Block</th>
      <th>Department</th>
      <th>Subject</th>
      <th>Start</th>
      <th>End</th>
    </tr>
  </thead>

  <tbody>
    @foreach($user->schedules as $schedule)
      <tr>
        <td>{{ strtoupper($schedule->day) }}</td>
        <td>{{ $schedule->room->name }}</td>
        <td>{{ $schedule->block->name }}</td>
        <td>{{ $schedule->room->department->name }}</td>
        <td>{{ $schedule->subject->name }}</td>
        <td>{{ $schedule->formattedStartTime }}</td>
        <td>{{ $schedule->formattedEndTime }}</td>
      </tr>
    @endforeach
  </tbody>
</table>