@extends('layouts.app')

@section('content')
    <!-- START CONTENT FRAME -->
    <div class="content-frame" id="app">
        <!-- START CONTENT FRAME TOP -->
        <div class="content-frame-top">
            <div class="page-title">
                <h2><span class="fa fa-arrow-circle-o-left"></span> {{ $currentGroup->title }}</h2>
            </div>
            <div class="pull-right">
                <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
            </div>
            <div class=" pull-right">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#create_task_modal">Create new task</button>

            </div>
        </div>
        <div class="content-frame-left">
            <div class="form-group">
                <h4>Task groups:</h4>
                <div class="list-group border-bottom">
                    @foreach($groups as $group)
                        <a href="{{ route('home', $group->url_slug) }}" class="list-group-item"><span class="fa fa-circle text-primary"></span> {{ $group->title }}</a>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#create_group_modal">Create new group</button>
                {{--<a href="#" class="btn btn-primary btn-block">Create new group</a>--}}
            </div>
        </div>
        <!-- END CONTENT FRAME TOP -->

        <!-- START CONTENT FRAME BODY -->
        <div class="content-frame-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    {{ session('status') }}
                </div>
            @endif
            <div class="row push-up-10">
                <div class="col-md-6">

                    <h3>To-do List</h3>

                    <div class="tasks" id="tasks">
                        @if($incompleteTasks->count() > 0)
                            @foreach($incompleteTasks as $task)
                                <div class="task-item task-{{ $priorityClasses[$task->priority] }}">
                                    <div class="row push-up-15">
                                        <div class="col-md-12 text-right">
                                            <span class="label label-{{ $priorityClasses[$task->priority] }}">{{ $priorities[$task->priority] }}</span>
                                        </div>
                                    </div>
                                    <div class="task-text">{{ $task->details }}</div>
                                    <div class="task-footer">
                                        <div class="pull-left">
                                            <span class="fa fa-clock-o"></span> {{ $task->created_at->diffForHumans() }}
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('markComplete', [$task->id, $urlSlug]) }}"><span class="fa fa-check"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="task-drop push-down-10">
                                <span class="fa fa-exclamation-triangle"></span>
                                No task found. Click add to add some new ones.
                            </div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <h3>Completed</h3>
                    <div class="tasks" id="tasks_completed">
                        @if($completeTasks->count() > 0)
                            @foreach($completeTasks as $task)
                                <div class="task-item task-success task-complete">
                                    <div class="row push-up-15">
                                        <div class="col-md-12 text-right">
                                            <span class="label label-{{ $priorityClasses[$task->priority] }}">{{ $priorities[$task->priority] }}</span>
                                        </div>
                                    </div>
                                    <div class="task-text">{{ $task->details }}</div>
                                    <div class="task-footer">
                                        <div class="pull-left"><span class="fa fa-clock-o"></span> Completed: {{ $task->updated_at->diffForHumans() }}</div>
                                        <div class="pull-right">
                                            <a href="{{ route('markIncomplete', [$task->id, $urlSlug]) }}"><span class="fa fa-plus"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="task-drop push-down-10">
                                <span class="fa fa-exclamation-triangle"></span>
                                No task found. Click add to add some new ones.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT FRAME BODY -->

    </div>
    <!-- END CONTENT FRAME -->

    {{--BEGIN CREATE GROUP MODAL--}}
    <div class="modal" id="create_group_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="post" action="{{ route('group.create') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="largeModalHead">Create new group</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title">Group Title</label>
                            <input class="form-control" id="title" name="title" type="text" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--END CREATE GROUP MODAL--}}

    {{--BEGIN CREATE TASK MODAL--}}
    <div class="modal" id="create_task_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="post" action="{{ route('task.create', $urlSlug) }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="largeModalHead">Create new task</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="details">Task Details</label>
                            <textarea class="form-control" id="details" name="details" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="check text-primary">
                                <input type="radio" class="icheckbox" name="priority" value="0" /> Low
                            </label>
                            <label class="check text-warning">
                                <input type="radio" class="icheckbox" name="priority" value="1" checked="checked"/> Normal
                            </label>
                            <label class="check text-danger">
                                <input type="radio" class="icheckbox" name="priority" value="2" /> High
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input id="title" type="text" class="form-control datepicker" name="due_date" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--END CREATE TASK MODAL--}}

@endsection

@section('page_scripts')
    <script type="text/javascript" src="{{ asset('js/plugins/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-select.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/demo_tasks.js') }}"></script>
@endsection

