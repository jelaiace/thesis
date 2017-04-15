@extends('layout')

@section('title')
  View Assigned Schedules
@endsection

@section('content')
  <div class="container">
    <ul class="nav nav-tabs u-spacer">
      <li role="presentation" {{ $day === 'm' ? 'class=active' : '' }}>
        <a href="/">Monday</a>
      </li>
      <li role="presentation" {{ $day === 't' ? 'class=active' : '' }}>
        <a href="/?day=t">Tuesday</a>
      </li>
      <li role="presentation" {{ $day === 'w' ? 'class=active' : '' }}>
        <a href="/?day=w">Wednesday</a>
      </li>
      <li role="presentation" {{ $day === 'th' ? 'class=active' : '' }}>
        <a href="/?day=th">Thursday</a>
      </li>
      <li role="presentation" {{ $day === 'f' ? 'class=active' : '' }}>
        <a href="/?day=f">Friday</a>
      </li>
      <li role="presentation" {{ $day === 's' ? 'class=active' : '' }}>
        <a href="/?day=s">Saturday</a>
      </li>
      <li role="presentation" class="pull-right">
        <a href="/report">Reports</a>
      </li>
    </ul>

    <div id="calendar-mount" class="calendar-container"></div>
  </div>
@stop

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/react-select.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/react-timesheet.css') }}">
@stop

@section('scripts')
  <script src="{{ asset('assets/lodash.js') }}"></script>
  <script src="{{ asset('assets/react.js') }}"></script>
  <script src="{{ asset('assets/react-dom.js') }}"></script>
  <script src="{{ asset('assets/moment.js') }}"></script>
  <script src="{{ asset('assets/axios.js') }}"></script>
  <script src="{{ asset('assets/react-timesheet.js') }}"></script>

  <script>
    ;(function() {
      var rooms = {!! $rooms->toJson() !!};
      var Timesheet = React.createFactory(ReactTimesheet.default);

      var App = React.createFactory(class extends React.Component {
        constructor() {
          super();

          this.state = {
            schedules: _.mapValues(
              _.keyBy(rooms, 'name'),
              function(room, key) {
                return room.schedules.map((schedule) => {
                  return {
                    start: moment(schedule.start_time, 'hh:mm a'),
                    end: moment(schedule.end_time, 'hh:mm a'),
                    data: {
                      id: schedule.id,
                      section: schedule.block,
                      professor: schedule.professor,
                      subject: {
                        id: schedule.subject,
                        name: schedule.subject.name + ' (' + schedule.subject.course_code + ')'
                      }
                    }
                  };
                });
              }
            )
          };
        }

        render() {
          return (
            Timesheet({
              corny: true,
              schedules: this.state.schedules,
              time: {
                start: '7:30 AM',
                end: '9:00 PM',
                increment: { hours: 1, minutes: 30 }
              },
              professors: [],
              subjects: [],
              sections: [],
              disabled: true
            }, null)
          )
        }
      });

      ReactDOM.render(
        App(),
        document.getElementById('calendar-mount')
      );
    })();
  </script>
@stop