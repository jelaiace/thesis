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
  border-bottom: 1px solid $color-gray;
}

.table td {
  border-top: 1px solid $color-gray;
}
</style>

<h1>Professors</h1>

@foreach($users as $user)
  <h4>{{ $user->name }}</h4>

  <table class="table">
    <thead>
      <tr>
        <th>Schedule</th>
        <th>Blocks</th>
        <th>Rooms</th>
        <th>Course</th>
        <th>Subjects</th>
      </tr>
    </thead>

    <tbody>
      @foreach($user->schedules as $schedule)
        <tr>
          <td>{{ $schedule->formatted_time }}</td>
          <td>{{ $schedule->block->name}}</td>
          <td>{{ $schedule->room->name }}</td>
          <td>{{ $schedule->block->course->name}}</td>
          <td>{{ $schedule->subject->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endforeach