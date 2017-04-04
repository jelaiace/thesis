@extends('layout')

@section('title')
	Manage Schedules of {{ $department->name }}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="list-group">
					@foreach($departments as $dept)
						<a href="/schedule/{{ $dept->id }}" class="list-group-item {{ $dept->id === $department->id ? 'active' : '' }}">
							{{ $dept->name }}
						</a>
					@endforeach
				</div>
			</div>

			<div class="col-md-9">
				<h1>{{ $department->name }}</h1>
				<ul class="nav nav-tabs u-spacer">
				  <li role="presentation" {{ $day !== 'tf' && $day !== 'ws' ? 'class=active' : '' }}>
				  	<a href="/schedule/{{ $department->id }}">MTH</a>
				  </li>
				  <li role="presentation" {{ $day === 'tf' ? 'class=active' : '' }}>
				  	<a href="/schedule/{{ $department->id }}?day=tf">TF</a>
				  </li>
				  <li role="presentation" {{ $day === 'ws' ? 'class=active' : '' }}>
				  	<a href="/schedule/{{ $department->id }}?day=ws">WS</a>
				  </li>
				</ul>

				<div id="calendar-mount" class="calendar-container"></div>
			</div>
		</div>
	</div>
@stop

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/react-select.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/rc-tooltip.css') }}">
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
			var subjects = selectify({!! $subjects->toJson() !!});
			var professors = selectify({!! $professors->toJson() !!});
			var blocks = selectify({!! $blocks->toJson() !!});
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
										request: schedule.is_requested,
										requester: schedule.is_requested ? {
											id: schedule.requester.id,
											department: {
												id: schedule.requester.department.id,
												name: schedule.requester.department.name
											},
											user: {
												id: schedule.requester.id,
												name: schedule.requester.name
											}
										} : {},
										data: {
											id: schedule.id,
											section: schedule.block,
											professor: schedule.professor,
											subject: schedule.subject
										}
									};
								});
							}
						)
					};

					this.handleStore = this.handleStore.bind(this);
					this.handleUpdate = this.handleUpdate.bind(this);
					this.handleRequestAction = this.handleRequestAction.bind(this);
				}

				render() {
					return (
						Timesheet({
							corny: true,
							schedules: this.state.schedules,
							request: {{ Auth::user()->department->id !== $department->id ? 'true' : 'false' }},
							requester: {
								id: {{ Auth::user()->id }},
								department: {
									id: {{ Auth::user()->department->id }},
									name: '{{ Auth::user()->department->name }}'
								},
								user: {
									id: {{ Auth::user()->id }},
									name: '{{ Auth::user()->name }}'
								}
							},
							time: {
								start: '7:30 AM',
								end: '9:00 PM',
								increment: { hours: 1, minutes: 30 }
							},
							professors: professors,
							subjects: subjects,
							sections: blocks,
							onStore: this.handleStore,
							onUpdate: this.handleUpdate,
							onRequestAction: this.handleRequestAction
						}, null)
					)
				}

				handleStore(room, schedule) {
					axios.post('/schedule', {
						professor_id: schedule.data.professor.id,
						block_id: schedule.data.section.id,
						subject_id: schedule.data.subject.id,
						start_time: schedule.start.format('HH:mm:ss'),
						end_time: schedule.end.format('HH:mm:ss'),
						room: room,
						day: '{{ $day }}',
						is_requested: schedule.request
					}).then((res) => {						
						var schedules = Object.assign({}, this.state.schedules);
						schedule.data.id = res.data.id
						schedules[room] = schedules[room].concat([schedule]);
						this.setState({ schedules: schedules });
					});
				}

				handleUpdate(room, index, schedule, dest) {
					dest = dest || room;
					var endpoint = ['/schedule', schedule.data.id].join('/');

					axios.put(endpoint, {
						professor_id: schedule.data.professor.id,
						block_id: schedule.data.section.id,
						subject_id: schedule.data.subject.id,
						start_time: schedule.start.format('HH:mm:ss'),
						end_time: schedule.end.format('HH:mm:ss'),
						room: dest || room,
						day: '{{ $day }}'
					}).then((res) => {
						var schedules = Object.assign({}, this.state.schedules);

						if (room === dest) {
							schedules[room][index] = schedule;
						} else {
							schedules[room] = schedules[room].filter((_, i) => i !== index),
		          schedules[dest] = schedules[dest].concat([schedule]);
						}

						this.setState({ schedules: schedules });
					});
				}

				handleRequestAction(room, index, action) {
					var schedule = this.state.schedules[room][index];
					var endpoint = ['/schedule', schedule.data.id, 'action'].join('/');

					axios.patch(endpoint, { is_approved: action })
						.then((res) => {
							var schedules = Object.assign({}, this.state.schedules);

							if (action) {
								schedules[room] = schedules[room].map((schedule, i) => {
									return index === i ? Object.assign({}, schedule, {
										request: false,
										requester: {}
									}) : schedule;
								});
							} else {
								schedules[room] = schedules[room].filter((schedule, i) => {
									return index !== i
								});
							}

							this.setState({ schedules });
						});
				}
			});

			function selectify(collection) {
				return collection.map((item) => ({
					value: item.id,
					label: item.name
				}));
			}

			ReactDOM.render(
				App(),
				document.getElementById('calendar-mount')
			);
		})();
	</script>
@stop