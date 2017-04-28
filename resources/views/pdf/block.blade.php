<style>
* {
  box-sizing: border-box;

}
body {
  font-family: 'Helvetica'; 
}

.doc-heading {
  font-weight: 300;
}

.table-container {
  margin-bottom: 80px;
  border: 1px solid #dedfe5;
}

.table-heading {
  margin-top: 0;
  margin-bottom: 0;
  padding: 8px 16px;
  background: #f3f3f7;
  border-bottom: 1px solid #dedfe5;
}
  
.table {
  width: 100%;
  border-spacing: 0px;
}

.table th,
.table td {
  padding: 8px 16px;
  text-align: left;
  margin: 0;
}

.table th {
  border-top: 1px solid #ffffff;
  text-transform: uppercase;
  font-size: 12px;
  color: #777e95;
  background: #f3f3f7;
  border-bottom: 1px solid #dedfe5;
}

.table td {
  background: #fff;
  /*border: 1px solid #dedfe5;*/
}

.empty-panel {
  margin-top: 0;
  margin-bottom: 0;
  padding: 8px 16px;
  color: #777e95;
  border: 1px dashed #f3f3f7;
}
</style>

<h1 class="doc-heading">Blocks ({{ $user->department->name }})</h1>

@foreach($blocks as $block)
  <h4 style="margin-top: 0; margin-bottom: 16px">
    {{ $block->name }} ({{ $block->full_ordinal_year_level }})
  </h4>

  @if (count($block->days))
    @foreach($block->days as $day => $schedules)
      <div class="table-container">
        <h6 class="table-heading">
          {{ $day }}
        </h6>

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
            @foreach($schedules as $schedule)
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
      </div>
    @endforeach
  @else
    <h6 class="empty-panel">
      This block doesn't have any assigned schedule yet.
    </h6>
  @endif
@endforeach