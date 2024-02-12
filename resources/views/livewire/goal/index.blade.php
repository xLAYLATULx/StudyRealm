<!-- resources/views/livewire/goal.blade.php -->

<div class="goals">
    <h1>Goals</h1>
    @include('livewire.goal.modalform')
    <div class="goalsList">
        <div class="actions">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalModal" id="blue-colour">Add Goal</a>
            {{$goals->links()}}
    </div>
        @foreach($goals as $goal)
        <div class="goal mt-3 p-3 {{ $goal->completed ? 'completed' : '' }}" id="goal">
            <div class="row">
                <div class="col-md-1">
                    <input wire:click="completedGoal({{ $goal->id }})" type="checkbox" id="myCheckbox" {{
                        $goal->completed ? 'checked' : '' }}>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <h5>{{$goal->goalName}}</h5>
                        <p>Description: {{$goal->description}} </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="goalDeadline">
                        <p class="ml-4">Due Date: {{$goal->deadline}}</p>
                    </div>
                    <div class="float-end mt-3">
                        <a href="" wire:click="editGoalFields({{ $goal->id }})" class="edit btn text-white"
                            data-bs-toggle="modal" data-bs-target="#editGoalModal" id="pink-colour">Edit</a>
                        <a href="" wire:click="deleteGoalButton({{ $goal->id }})" class="delete btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#deleteGoalModal">Delete</a>
                    </div>
        
                </div>
            </div>
        
        
        </div>
        @endforeach


    </div>