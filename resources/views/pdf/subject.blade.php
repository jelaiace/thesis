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

<h1>Subjects</h1>

<table class="table">
  <thead>
    <tr>
      <th>Course Code</th>
      <th>Subject Name</th>
      <th>Units</th>
    </tr>
  </thead>

  <tbody>
    @foreach($subjects as $subject)
      <tr>
        <td>{{ $subject->course_code}}</td>
        <td>{{ $subject->name }}</td>
        <td>{{ $subject->units }}</td>
      </tr>
    @endforeach
  </tbody>
</table>