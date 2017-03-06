@extends('layout')

@section('content')
	<div class="container">
		<div id="calendar-mount"></div>
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
										data: {
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
				}

				render() {
					return (
						Timesheet({
							schedules: this.state.schedules,
							time: {
								start: '7:30 AM',
								end: '9:00 PM',
								increment: { hours: 1, minutes: 30 }
							},
							professors: professors,
							subjects: subjects,
							sections: blocks,
							onStore: this.handleStore,
							onUpdate: this.handleUpdate
						}, null)
					)
				}

				handleStore(room, schedule) {
					axios.post('/schedules', {
						professor_id: schedule.data.professor.id,
						block_id: schedule.data.section.id,
						subject: schedule.data.subject.id,
						start_time: schedule.start.format('HH:mm:ss'),
						end_time: schedule.end.format('HH:mm:ss'),
						room: room
					}).then((res) => {
						var schedules = Object.assign({}, this.state.schedules);
						schedules[room] = schedules[room].concat([Object.assign(schedule), { id: res.data.id }]);
						this.setState({ schedules: schedules });
					});
				}

				handleUpdate(opt, schedule) {
					var room = opt.day;
					var index = opt.index;
					var endpoint = ['schedules', schedule.id].join('/');

					axios.put(endpoint, {
						professor_id: schedule.data.professor.id,
						block_id: schedule.data.section.id,
						subject: schedule.data.subject.id,
						start_time: schedule.start.format('HH:mm:ss'),
						end_time: schedule.end.format('HH:mm:ss'),
						room: room
					}).then((res) => {
						var schedules = Object.assign({}, this.state.schedules);
						schedules[room] = schedule;
						this.setState({ schedules: schedules });
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