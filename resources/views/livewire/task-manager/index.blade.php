<div class="task-manager">
    <h1>Task Manager</h1>
    <p>Add projects to the task manager or click on created projects to add and manage tasks!</p>
    @include('livewire.task-manager.modalform')
    <div class="row">
        <div class="col-md-9">
        <div class="categories mt-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" id="lightBlue-colour" href="#" data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal"><i class="fa fa-plus"></i> Add Project</a>
                </li>
                @if(!$categories->isEmpty())
                @foreach($categories as $category)
                <li class="nav-item dropdown">
                    <a class="nav-link @if($categoryTasks == $category->id) active @endif" href="#"
                        wire:model.defer="categoryTasks"
                        wire:click="ct({{ $category->id }})">{{$category->categoryName}} <i class="dropbtn ml-4 mr-3 fa fa-ellipsis-v"></i></a>
                    <ul class="dropdown-content" @if(!$categoryTasks == $category->id) style="display: none;"@endif>
                        <a class="btn" href="#" wire:click="editCategoryFields({{ $category->id }})"
                            data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fa fa-pencil"></i> Edit</a>
                        <a class="btn" href="#" wire:click="deleteCategoryButton({{ $category->id }})"
                            data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"><i class="fa fa-trash"></i> Delete</a>
                        </ul>
                </li>
                @endforeach
            </ul>
        </div>
        </div>
        @endif
    </div>
    <div class="taskslist mt-5" @if(!$categoryTasks) style="display: none;" @endif>
        <div class="actions">
            <a class="btn" id="lightBlue-colour" wire:click="showTasksButton">{{$showTasks ?
                'Show Not Completed Tasks' : ' Show Completed Tasks'}}</a>
            <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i
                    class="fa fa-plus"></i> Add Task</a>
        </div>
        @if(!$tasks->isEmpty())
        @foreach($tasks as $task)
        <div class="task shadow mt-4 p-3 {{ $task->completed ? 'completed' : '' }}" id="task">
            <div class="row">
                <div class="col-md-1">
                    <input wire:click="completedTask({{ $task->id }})" type="checkbox" id="myCheckbox"
                        {{$task->completed ? 'checked' : '' }} />
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="progress">
                                        <div class="{{$task->progress == 100.00 ? 'bg-success' : 'pink-colour'}}" role="progressbar" style="width: {{$task->progress}}%;"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="progressBarText">
                                        <p>{{$task->progress}}% Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div
                                class="taskPriority @if($task->priority == 'medium') bg-warning @elseif($task->priority == 'high') bg-danger @elseif($task->priority == 'low') bg-success @endif">
                                <p class="">
                                    Priority:
                                    @if($task->priority == 'medium')
                                    Medium
                                    @elseif($task->priority == 'high')
                                    High
                                    @elseif($task->priority == 'low')
                                    Low
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5>{{$task->taskName}}</h5>
                        <p>Description: {{$task->description}}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="taskDeadline">
                        <p class="ml-4">Due Date: {{$task->dueDate}}</p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 mx-3">
                        <a href="" wire:click="editTaskFields({{ $task->id }})" class="edit btn text-white"
                            data-bs-toggle="modal" data-bs-target="#editTaskModal" id="blue-colour"><i
                                class="fa fa-pencil"></i> Edit</a>
                        <a class="btn btn-danger" href="#" wire:click="deleteTaskButton({{ $task->id }})"
                            data-bs-toggle="modal" data-bs-target="#deleteTaskModal"><i class="fa fa-trash"></i>
                            Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="noTasks mt-3">
            <p>No Tasks...</p>
        </div>
        @endif
        <div class="paginationlinks mt-3">
            {{$tasks->links()}}
        </div>
    </div>
</div>