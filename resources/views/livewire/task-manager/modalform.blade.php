<!-- Create Category Modal -->
<div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="exampleModalLabel"><strong>Add Project</strong></h5>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="storeCategory">
                <div class="mb-3">
                    <label>Project Name: </label>
                    <input type="text" class="form-control" wire:model.defer="categoryName" placeholder="Enter Project Name..." required>
                    @error ('categoryName') <small class="text-danger">{{$message}}</small>@enderror
                </div>
            </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn text-white" id="pink-colour"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Edit Category Modal -->
  <div wire:ignore.self class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Edit Project</strong></h1>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border" role="status">
            </div>
            <span class="">Loading...</span>
        </div>
        <div wire:loading.remove>
        <div class="modal-body">
            <form wire:submit.prevent="editCategory">
                <div class="mb-3">
                    <label>Project Name: </label>
                    <input type="text" class="form-control" wire:model.defer="categoryName" placeholder="Enter Project Name..." required>
                    @error ('categoryName') <small class="text-danger">{{$message}}</small>@enderror
                </div>
            </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn text-white" id="pink-colour"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Category Modal -->
<div wire:ignore.self class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editGoalModal"><strong>Delete Project</strong></h5>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border" role="status">
            </div>
            <span class="">Loading...</span>
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="deleteCategory">
                <div class="modal-body">
                    <p>Are you sure you want to delete this project? All tasks within this project will be deleted. </p>
                </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn" wire:click="closeModal" data-bs-dismiss="modal"
                        id="lightBlue-colour"><i class="fa fa-close"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!------------------------------------------------------------TASK MODALS------------------------------------------------------------>

<!-- Create Task Modal -->
<div wire:ignore.self class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><strong>Add Task</strong></h5>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeTask">
                    <div class="mb-3">
                        <label>Task Name: </label>
                        <input type="text" class="form-control" name="taskName" wire:model.defer="taskName" placeholder="Enter Task Name..." required>
                        @error('taskName') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Project: </label>
                        <select name="project" id="project" wire:model.defer="categoryID" class="form-select" aria-label="Default select example" required>
                            <option value="" selected>Select Project</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                            @endforeach
                        </select>
                        @error('categoryID') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>                
                    <div class="mb-3">
                        <label>Priority: </label>
                        <select name="priority" id="priority" wire:model.defer="priority" class="form-select" aria-label="Default select example" required>
                            <option value="" selected>Select Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                        @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Task Description: </label>
                        <input type="text" class="form-control" wire:model.defer="description" placeholder="Enter Task Description..." required>
                        @error ('description') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label>Progress: </label>
                        <div class="d-flex text-secondary">
                            <p>0%</p>
                            <input type="range" wire:model.defer="progress" class="form-range" id="progress" name="progress" min="0" max="100" default="50" required>
                            @error ('progress') <small class="text-danger">{{$message}}</small>@enderror
                            <p>100%</p>
                        </div>
                        <div class="text-center">
                            <output for="progress" id="progressOutput" name="progress" wire:model.defer="progress" default="50">50</output>%
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Due Date: </label>
                        <input type="date" class="form-control" wire:model.defer="dueDate" id="datepicker" required>
                        @error ('dueDate') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="actions mx-3 my-2">
                        <button type="submit" class="btn text-white" id="pink-colour"><i class="fa fa-check"></i> Save</button>
                        <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour" wire:click="closeModal"><i class="fa fa-close"></i> Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <!-- Edit Task Modal -->
  <div wire:ignore.self class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fs-5" id="exampleModalLabel"><strong>Edit Task</strong></h5>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="editTask">
                <div class="mb-3">
                    <label>Task Name: </label>
                    <input type="text" class="form-control" wire:model.defer="taskName" placeholder="Enter Task Name..." required>
                    @error ('taskName') <small class="text-danger">{{$message}}</small>@enderror
                </div>
                <div class="mb-3">
                    <label>Project: </label>
                    <select name="project" id="project" wire:model.defer="categoryID" class="form-select" aria-label="Default select example" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>Priority: </label>
                    <select name="priority" id="priority" wire:model.defer="priority" class="form-select" aria-label="Default select example" required>
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                      </select>
                </div>
                <div class="mb-3">
                    <label>Task Description: </label>
                    <input type="text" class="form-control" wire:model.defer="description" placeholder="Enter Task Description..." required>
                </div>
                <div class="mb-3">
                    <label>Progress: </label>
                    <div class="d-flex text-secondary">
                        <p>0%</p>
                        <input type="range" wire:model.defer="progress" class="form-range" id="progress" name="progress" min="0" max="100" required>
                        @error ('progress') <small class="text-danger">{{$message}}</small>@enderror
                        <p>100%</p>
                    </div>
                    <div class="text-center">
                        <output for="progress" id="progressOutput" name="progress" wire:model.defer="progress"></output>%
                    </div>
                </div>
                <div class="mb-3">
                    <label>Due Date: </label>
                    <input type="date" class="form-control" wire:model.defer="dueDate" id="datepicker2" required>
                    @error ('dueDate') <small class="text-danger">{{$message}}</small>@enderror
                </div>
                
            </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn text-white" id="pink-colour"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour" wire:click="closeModal"><i class="fa fa-close"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Delete Task Modal -->
<div wire:ignore.self class="modal fade" id="deleteTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editGoalModal"><strong>Delete Project</strong></h5>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border" role="status">
            </div>
            <span class="">Loading...</span>
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="deleteTask">
                <div class="modal-body">
                    <p>Are you sure you want to delete this task?  This action cannot be undone.</p>
                </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <button type="button" class="btn" wire:click="closeModal" data-bs-dismiss="modal"
                        id="lightBlue-colour"><i class="fa fa-close"></i> Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


<script>
    /* Slider */
    var slider = document.getElementById("progress");
    var output = document.getElementById("progressOutput");
    output.innerHTML = slider.value;
    slider.oninput = function() {
         output.innerHTML = this.value;
         };
    
    /* Date Picker */
    function todayDate(){
        var date = new Date(); /* 2024-02-14 */
    console.log(date);
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (day < 10){
        day = "0" + day;
    }
    if (month < 10){
        month = "0" + month;
    }
    var today = year + "-" + month + "-" + day;
    console.log(today);
    document.getElementById("datepicker").min = today;
    document.getElementById("datepicker2").min = today;
    }
    todayDate();
    document.getElementById("datepicker").addEventListener("focus", todayDate);
    document.getElementById("datepicker2").addEventListener("focus", todayDate);

</script>