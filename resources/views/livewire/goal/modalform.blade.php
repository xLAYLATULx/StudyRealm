    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoalModal">Add Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="storeGoal">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Goal Name: </label>
                            <input  type="text" wire:model.defer="goalName" class="form-control" placeholder="Enter Goal Name...">
                            @error ('goalName') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label>Goal Description: </label>
                            <input  type="text" wire:model.defer="description" class="form-control" placeholder="Enter Goal Description...">
                            @error ('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="mb-3">
                            <label>Deadline: </label>
                            <input  type="date" wire:model.defer="deadline" class="form-control" placeholder="Enter Deadline...">
                            @error ('deadline') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>