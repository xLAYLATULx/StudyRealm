<!-- resources/views/livewire/goal.blade.php -->

<div class="goals">
    <h1>Goals</h1>
    @include('livewire.goal.modalform')
    <div class="goalsList mt-5">
        <div class="actions">
            <a class="btn" id="lightBlue-colour" wire:click="showGoalsButton">{{$showGoals ?
                'Show Not Completed Goals' : ' Show Completed Goals'}}</a>
            <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addGoalModal"><i class="fa fa-plus"></i> Add Goal</a>
        </div>
        @if($goals->isEmpty())
        <div class="noGoals mt-3">
            <p>No Goals...</p>
        </div>
        @else
        @foreach($goals as $goal)
        <div class="goal shadow mt-4 p-3 {{ $goal->completed ? 'completed' : '' }}" id="goal">
            <div class="row">
                <div class="col-md-1">
                    <input wire:click="completedGoal({{ $goal->id }})" type="checkbox" id="myCheckbox"
                        {{$goal->completed ? 'checked' : '' }}/>
                </div>
                <div class="col-md-8">
                    <div class="row">
                    <div class="col-md-7">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="progress">
                                    <div class="{{$goal->progress == 100.00 ? 'bg-success' : 'pink-colour'}}" role="progressbar" style="width: {{$goal->progress}}%;"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="progressBarText">
                                    <p>{{$goal->progress}}% Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    <div class="row">
                        <h5>{{$goal->goalName}}</h5>
                        <p>Description: {{$goal->description}} </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="goalDeadline">
                        <p class="ml-4">Due Date: {{$goal->deadline}}</p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 mx-3">
                        <a href="" wire:click="editGoalFields({{ $goal->id }})" class="edit btn text-white"
                            data-bs-toggle="modal" data-bs-target="#editGoalModal" id="blue-colour"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="" wire:click="deleteGoalButton({{ $goal->id }})" class="delete btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#deleteGoalModal"><i class="fa fa-trash"></i> Delete</a>
                    </div>

                </div>
            </div>


        </div>
        @endforeach
        @endif
        <div class="paginationlinks mt-3">
            {{$goals->links()}}
        </div>

    </div>
</div>