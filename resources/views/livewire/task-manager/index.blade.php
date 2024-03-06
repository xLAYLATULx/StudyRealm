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
                            wire:click="ct({{ $category->id }})">{{$category->categoryName}} <i
                                class="dropbtn ml-4 mr-3 fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-content" @if(!$categoryTasks==$category->id) style="display: none;"@endif>
                            <a class="" href="#" wire:click="editCategoryFields({{ $category->id }})"
                                data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fa fa-pencil"></i>
                                Edit</a>
                            <a class="" href="#" wire:click="deleteCategoryButton({{ $category->id }})"
                                data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"><i class="fa fa-trash"></i>
                                Delete</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>
    <div class="taskslist mt-5" @if(!$categoryTasks) style="display: none;" @endif>
        <div class="col-md-6 actions text-black">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="allTasks" id="allTasks" wire:model="filter"
                    value="all" wire:click="showAllTasksButton">
                <label class="form-check-label" for="allTasks">
                    Show All Tasks
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="completedTasks" id="completedTasks"
                    wire:model="filter" value="completed" wire:click="showCompletedTasksButton">
                <label class="form-check-label" for="completedTasks">
                    Show Completed Tasks
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="notCompletedTasks" id="notCompletedTasks"
                    wire:model="filter" value="notCompleted" wire:click="showNotCompletedTasksButton">
                <label class="form-check-label" for="notCompletedTasks">
                    Show Not Completed Tasks
                </label>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-9">
                <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i
                        class="fa fa-plus"></i> Add Task</a>
            </div>
            <div class="col-md-3">
                <div class="sortBy float-end">
                    <a class="btn" id="lightGrey-colour" wire:click="sortByDateButton">{{$sortByAsc ?
                        'Date Desc ↓' : 'Date Asc ↑'}}</a>
                    <a class="btn ml-3" id="lightGrey-colour" wire:click="sortByPriorityButton">{{$sortByPriority ?
                        'Priority Desc ↓' : 'Priority Asc ↑'}}</a>
                </div>
            </div>
        </div>
        @if($tasks->isEmpty())
        <div class="noTasks mt-3">
            <p>No Tasks...</p>
        </div>
        @else
        @foreach($tasks as $task)
        <div class="card task shadow mt-4 p-3" id="task">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        @foreach($goals as $goal)
                        @if($task->goalID == $goal->id)
                        <h5><i class="fa fa-check pink-text"></i> <strong>{{$task->taskName}} ({{$goal->goalName}})
                            </strong></h5>
                        @endif
                        @endforeach
                        @if($task->goalID == NULL)
                        <h5><i class="fa fa-check pink-text"></i> <strong>{{$task->taskName}}</strong></h5>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <div class="progress">
                                    <div class="progress-bar {{$task->progress == 100.00 ? 'bg-success' : 'pink-colour'}}"
                                        role="progressbar"
                                        style="width: {{$task->progress}}%; background-color: #FF6060"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="progressBarText">
                                    <p>{{$task->progress}}% Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-end mb-3">
                            <h6 class="card-title">Due: {{$task->dueDate}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-subtitle"><i class="fa fa-flag" style="@if($task->priority == 'medium') color: orange @elseif($task->priority == 'high') color: red @elseif($task->priority == 'low') color: green @endif"></i>
                    @if($task->priority == 'medium')
                    Medium
                    @elseif($task->priority == 'high')
                    High
                    @elseif($task->priority == 'low')
                    Low
                    @endif Priority</p>
                <p class="card-text">{{$task->description}}</p>
                <div class="position-absolute bottom-0 end-0 m-3">
                    <a href="text-white" wire:click="editTaskFields({{ $task->id }})" class="edit btn text-white"
                        data-bs-toggle="modal" data-bs-target="#editTaskModal" id="blue-colour"><i
                            class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger text-white" href="#" wire:click="deleteTaskButton({{ $task->id }})"
                        data-bs-toggle="modal" data-bs-target="#deleteTaskModal"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
        <div class="col-md-3 mt-5">
            {{$tasks->links()}}
        </div>
    </div>
</div>
