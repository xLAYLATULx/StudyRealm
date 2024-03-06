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
        <div class="card goal shadow mt-4 p-3" id="goal">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="card-title"><i class="fa fa-bullseye pink-text"></i> <strong>{{$goal->goalName}}</strong></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <div class="progress">
                                    <div class="progress-bar {{ $goal->progress == 100 ? 'bg-success' : '' }}" role="progressbar" style="width: {{ $goal->progress }}%; background-color: #FF6060" aria-valuenow="{{ $goal->overallProgress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="progressBarText">
                                    <p>{{$goal->progress}}% Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="text-end mb-3">
                        <h6 class="card-title">Due: {{$goal->deadline}}</h6>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
              <p class="card-text">{{$goal->description}}</p>
              @if ($goal->tasks->isEmpty())
              @else
              <details>
                <summary>Tasks:</summary>
                 @foreach($goal->tasks as $task)
                            <p> <i class="fa fa-check pink-text"></i> {{$task->taskName}}: {{$task->progress}}% Completed</p>
                    @endforeach
              </details>
                @endif
                <div class="position-absolute bottom-0 end-0 m-3">
                    <a href="" wire:click="editGoalFields({{ $goal->id }})" class="edit btn text-white"
                        data-bs-toggle="modal" data-bs-target="#editGoalModal" id="blue-colour"><i class="fa fa-pencil"></i></a>
                    <a href="" wire:click="deleteGoalButton({{ $goal->id }})" class="delete btn btn-danger"
                        data-bs-toggle="modal" data-bs-target="#deleteGoalModal"><i class="fa fa-trash"></i></a>
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