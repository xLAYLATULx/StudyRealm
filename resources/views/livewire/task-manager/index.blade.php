<div class="task-manager">
        <h1>Task Manager</h1>
        @include('livewire.task-manager.modalform')
        <div class="categories mt-5">
            <ul class="nav nav-tabs">
                @if($categories->isEmpty())
                <li class="nav-item">
                    <a class="nav-link" id="lightBlue-colour" href="#"><i class="fa fa-plus"></i> Add Project</a>
                  </li>
                @else
                @foreach($categories as $category)
                <li class="nav-item">
                  <a class="nav-link active" href="#">{{$category->categoryName}} </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="lightBlue-colour" href="#"><i class="fa fa-plus"></i> Add Project</a>
                </li>
              </ul>
        </div>
        <div class="categoryActions mt-3">
            <a class="btn" id="blue-colour" href="#"><i class="fa fa-pencil"></i> Edit Project</a>
              <a class="btn btn-danger" href="#"><i class="fa fa-trash"></i> Delete Project</a>
        </div>
        <div class="taskslist mt-5">
            <div class="actions">
                <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i class="fa fa-plus"></i> Add Task</a>
            </div>
            <div class="noTasks mt-3">
                <p>No Tasks...</p>
            </div>
            <div class="task shadow mt-4 p-3" id="task">
                <div class="row">
                    <div class="col-md-1">
                        <input type="checkbox" id="myCheckbox"/>
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
                    </div>
                        
                        
                        <div class="row">
                            <h5>Task Name</h5>
                            <p>Description: </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="taskDeadline">
                            <p class="ml-4">Due Date:</p>
                        </div>
                        <div class="position-absolute bottom-0 end-0 mx-3">
                            <a href=""  class="edit btn text-white"
                                data-bs-toggle="modal" data-bs-target="#editTasklModal" id="blue-colour"><i class="fa fa-pencil"></i> Edit</a>
                            <a href=""  class="delete btn btn-danger"
                                data-bs-toggle="modal" data-bs-target="#deleteTaskModal"><i class="fa fa-trash"></i> Delete</a>
                        </div>
    
                    </div>
                </div>
    
    
            </div>
            <div class="paginationlinks mt-3">
            </div>
    
        </div>
        @endforeach
        @endif
    
</div>
