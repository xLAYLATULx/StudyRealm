<div class="task-manager">
    <h1>Task Manager</h1>
    <p>Add projects to the task manager or click on created projects to add and manage tasks!</p>
    @include('livewire.task-manager.modalform')
    <div class="row">
        <div class="col-md-9">
            <div class="categories mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" id="charcoal" href="#" data-bs-toggle="modal"
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
        <div class="row">
            <div class="col-md-8 d-flex">
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="allTasks" id="allTasks" wire:model="filter"
                        value="all" wire:click="showAllTasksButton">
                    <label class="form-check-label" for="allTasks">
                        Show All Tasks
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="completedTasks" id="completedTasks"
                        wire:model="filter" value="completed" wire:click="showCompletedTasksButton">
                    <label class="form-check-label" for="completedTasks">
                        Show Completed Tasks
                    </label>
                </div>
                <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="notCompletedTasks" id="notCompletedTasks"
                        wire:model="filter" value="notCompleted" wire:click="showNotCompletedTasksButton">
                    <label class="form-check-label" for="notCompletedTasks">
                        Show Not Completed Tasks
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="sortBy float-end">
                        <a class="btn mr-5" id="purple" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i
                            class="fa fa-plus"></i> Task</a>
                        <a class="btn" id="sort" wire:click="sortByDateButton">{{$sortByAsc ?
                            'Date Desc ↓' : 'Date Asc ↑'}}</a>
                        <a class="btn ml-3" id="sort" wire:click="sortByPriorityButton">{{$sortByPriority ?
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
        <div class="card task shadow mt-4 p-3" >
            <div class="card-header" id="lightIndianred">
                <div class="row" >
                    <div class="col-md-4">
                        @foreach($goals as $goal)
                        @if($task->goalID == $goal->id)
                        <h6><i class="fa fa-check pink-text"></i> <strong>{{$task->taskName}} ({{$goal->goalName}}) 
                            </strong> <i class="fa fa-flag" style="@if($task->priority == 'medium') color: orange @elseif($task->priority == 'high') color: red @elseif($task->priority == 'low') color: green @endif"></i>
                        </h6>
                        @endif
                        @endforeach
                        @if($task->goalID == NULL)
                        <h6><i class="fa fa-check pink-text"></i> <strong>{{$task->taskName}} </strong> <i class="fa fa-flag" style="@if($task->priority == 'medium') color: orange @elseif($task->priority == 'high') color: red @elseif($task->priority == 'low') color: green @endif"></i></h6>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <div class="progress">
                                    <div class="progress-bar {{$task->progress == 100.00 ? 'bg-success' : ''}}"
                                        role="progressbar"
                                        style="width: {{$task->progress}}%; background-color: #0D98BA"></div>
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
                            <p class="card-title">Due: {{$task->dueDate}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">{{$task->description}}</p>
                <div class="position-absolute bottom-0 end-0 m-3">
                    <a href="text-white" wire:click="editTaskFields({{ $task->id }})" class="edit btn text-white"
                        data-bs-toggle="modal" data-bs-target="#editTaskModal" id="lightBlue"><i
                            class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger text-white" href="#" wire:click="deleteTaskButton({{ $task->id }})"
                        data-bs-toggle="modal" data-bs-target="#deleteTaskModal" id="lightRed"><i class="fa fa-trash"></i></a>
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
