<!-- resources/views/livewire/goal.blade.php -->

<div class="goals">
    <h1>Goals</h1>
    @include('livewire.goal.modalform')
    <div class="goalsList mt-5">
        <div class="col-md-6 actions text-black">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="allGoals" id="allGoals" wire:model="filter" value="all" wire:click="showAllGoalsButton">
                <label class="form-check-label" for="allGoals">
                 Show All Goals
                </label>
              </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="completedGoals" id="completedGoals" wire:model="filter" value="completed" wire:click="showCompletedGoalsButton">
                <label class="form-check-label" for="completedGoals">
                 Show Completed Goals
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="notCompletedGoals" id="notCompletedGoals" wire:model="filter" value="notCompleted" wire:click="showNotCompletedGoalsButton">
                <label class="form-check-label" for="notCompletedGoals">
                 Show Not Completed Goals
                </label>
              </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-9">
                <a class="btn" id="lightBlue-colour" data-bs-toggle="modal" data-bs-target="#addGoalModal"><i class="fa fa-plus"></i> Add Goal</a>
            </div>
            <div class="col-md-3">
                <div class="sortBy float-end">
                    <a class="btn" id="lightGrey-colour" wire:click="sortByAscButton">{{$sortByAsc ?
                        'Sort By Date Desc ↓' : 'Sort By Date Asc ↑'}}</a>
                  </div>
            </div>
        </div>
        @if($goals->isEmpty())
        <div class="noGoals mt-3">
            <p>No Goals Here...</p>
        </div>
        @else
        @foreach($goals as $goal)
        <div class="goal shadow mt-4 p-3" id="goal">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-5">
                            <h5><strong>{{$goal->goalName}}</strong></h5>
                        </div>
                    <div class="col-md-7">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="progress">
                                    <div class="progress-bar {{ $goal->progress == 100 ? 'bg-success' : 'pink-colour' }}" role="progressbar" style="width: {{ $goal->progress }}%;" aria-valuenow="{{ $goal->overallProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
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
                <p>Description: {{$goal->description}} </p>
                @if ($goal->tasks->isEmpty())
                <p>No Tasks Here...</p>
                @else
                <p>Tasks:</p>
                <ul class="ml-5">
                @foreach($goal->tasks as $task)
                            <li>{{$task->taskName}}: Progress - {{$task->progress}}%</li>
                        
                    @endforeach
                </ul>
                @endif
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
    </div>
    <div class="col-md-3 mt-5">
        {{$goals->links()}}
    </div>
</div>