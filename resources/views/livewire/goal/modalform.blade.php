<!-- Create Goal Modal -->
<div wire:ignore.self class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoalModal"><strong>Add Goal</strong></h5>
            </div>
            <form wire:submit.prevent="storeGoal">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Goal Name: </label>
                        <input type="text" wire:model.defer="goalName" class="form-control"
                            placeholder="Enter Goal Name..." required>
                        @error ('goalName') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label>Goal Description: </label>
                        <input type="text" wire:model.defer="description" class="form-control"
                            placeholder="Enter Goal Description..." required>
                        @error ('description') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="progress"class="form-label">Progress:</label>
                        <div class="d-flex text-secondary">
                            <p>0%</p>
                            <input type="range" wire:model.defer="progress" class="form-range" id="progress" name="progress" min="0" max="100" default="0">
                            <p>100%</p>
                        </div>
                        <div class="text-center">
                            <output for="progress" id="progressOutput" name="progress">0</output>%
                        </div>
                        @error ('progress') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label>Deadline: </label>
                        <input type="date" id="datepicker" wire:model.defer="deadline" class="form-control"
                            placeholder="Enter Deadline..." required>
                        @error ('deadline') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn text-white" id="pink-colour">Save</button>
                    <button type="button" class="btn" data-bs-dismiss="modal" id="lightBlue-colour">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Goal Modal -->
<div wire:ignore.self class="modal fade" id="editGoalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGoalModal"><strong>Edit Goal</strong></h5>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border" role="status">
                </div>
                <span class="">Loading...</span>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="editGoal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Goal Name: </label>
                            <input type="text" wire:model.defer="goalName" class="form-control"
                                placeholder="Enter Goal Name...">
                            @error ('goalName') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label>Goal Description: </label>
                            <input type="text" wire:model.defer="description" class="form-control"
                                placeholder="Enter Goal Description...">
                            @error ('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="progress"class="form-label">Progress:</label>
                            <div class="d-flex text-secondary">
                                <p>0%</p>
                                <input type="range" wire:model.defer="progress" class="form-range" id="progress" name="progress" min="0" max="100">
                                <p>100%</p>
                            </div>
                            <div class="text-center">
                                <output for="progress" id="progressOutput" name="progress" wire:model.defer="progress">0</output>%
                            </div>
                            @error ('progress') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3 mt-3">
                            <label>Deadline: </label>
                            <input type="date" id="datepicker" wire:model.defer="deadline" class="form-control"
                                placeholder="Enter Deadline...">
                            @error ('deadline') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        
                    </div>
                    <div class="actions mx-3 my-2">
                        <button type="submit" class="btn text-white" id="pink-colour">Save</button>
                        <button type="button" class="btn" wire:click="closeModal" data-bs-dismiss="modal"
                            id="lightBlue-colour">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Goal Modal -->
<div wire:ignore.self class="modal fade" id="deleteGoalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGoalModal"><strong>Delete Goal</strong></h5>
            </div>
            <div wire:loading class="p-2">
                <div class="spinner-border" role="status">
                </div>
                <span class="">Loading...</span>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="deleteGoal">
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this goal?</h5>
                    </div>
                    <div class="actions mx-3 my-2">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn" wire:click="closeModal" data-bs-dismiss="modal"
                            id="lightBlue-colour">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var slider = document.getElementById("progress");
var output = document.getElementById("progressOutput");
output.innerHTML = slider.value;
slider.oninput = function() {
  output.innerHTML = this.value;
};
</script>