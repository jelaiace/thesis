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

<h1>Blocks</h1>

@foreach($blocks as $block)
  <h4>{{ $block->name }} ({{ $block->course->department->name }})</h4>

  <table class="table">
    <thead>
      <tr>
        <th>Schedule</th>
        <th>Room</th>
        <th>Subject</th>
        <th>Department</th>
        <th>Professor</th>
      </tr>
    </thead>

    <tbody>
      @foreach($block->schedules as $schedule)
        <tr>
          <td>{{ $schedule->formatted_time }}</td>
          <td>{{ $schedule->room->name }}</td>
          <td>{{ $schedule->subject->name }}</td>
          <td>{{ $schedule->room->department->name }}</td>
          <td>{{ $schedule->professor->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endforeach