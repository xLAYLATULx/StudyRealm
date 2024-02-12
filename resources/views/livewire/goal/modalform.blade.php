<!-- Create Goal Modal -->
<div wire:ignore.self class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGoalModal"><strong>Add Goal</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="storeGoal">
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
                        <label>Deadline: </label>
                        <input type="date" id="datepicker" wire:model.defer="deadline" class="form-control"
                            placeholder="Enter Deadline...">
                        @error ('deadline') <small class="text-danger">{{$message}}</small>@enderror
                    </div>
                </div>
                <div class="actions mx-3 my-2">
                    <button type="submit" class="btn text-white" id="pink-colour">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <label>Deadline: </label>
                            <input type="date" id="datepicker" wire:model.defer="deadline" class="form-control"
                                placeholder="Enter Deadline...">
                            @error ('deadline') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="actions mx-3 my-2">
                        <button type="submit" class="btn text-white" id="pink-colour">Save</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
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
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>