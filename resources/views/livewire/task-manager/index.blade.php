<div class="task-manager">
    <h1>Task Manager</h1>
    @include('livewire.task-manager.modalform')
    <div class="categories mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" id="lightBlue-colour" href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fa fa-plus"></i> Add Project</a>
            </li>
            @if(!$categories->isEmpty())
            @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link @if($categoryTasks == $category->id) active @endif" href="#" wire:model.defer = "categoryTasks" wire:click="categoryTasks({{ $category->id }})">{{$category->categoryName}} </a>

            </li>
            @endforeach
            @endif
        </ul>
    </div>
    <div class="categoryActions mt-3">
        <a class="btn" id="blue-colour" href="#" wire:click="editCategoryFields({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><i class="fa fa-pencil"></i> Edit Project</a>
        <a class="btn btn-danger" href="#" wire:click="deleteCategoryButton({{ $category->id }})" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"><i class="fa fa-trash"></i> Delete Project</a>
    </div>
    <div class="taskslist mt-5">
        <div class="actions">
            <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i
                    class="fa fa-plus"></i> Add Task</a>
        </div>
        @if(!$tasks->isEmpty())
        @foreach($tasks as $task)
        <div class="task shadow mt-4 p-3" id="task">
            <div class="row">
                <div class="col-md-1">
                    <input type="checkbox" id="myCheckbox" />
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="progress">
                                        <div class="" role="progressbar"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="progressBarText">
                                        <p>% Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="taskPriority @if($task->priority == 'medium') bg-warning @elseif($task->priority == 'high') bg-danger @elseif($task->priority == 'low') bg-success @endif">

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
                            data-bs-toggle="modal" data-bs-target="#editTaskModal" id="blue-colour"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="" wire:click="deleteTaskButton({{ $task->id }})" class="delete btn btn-danger"
                             data-bs-toggle="modal" data-bs-target="#deleteTaskModal"><i class="fa fa-trash"></i> Delete</a>
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
        </div>

    </div>

</div>