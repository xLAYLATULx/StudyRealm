<!-- resources/views/livewire/goal.blade.php -->

<div class="goals">
    <h1>Goals</h1>
    @include('livewire.goal.modalform')
    <div class="goalsTable mt-5">
        <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addGoalModal">Add Goal</a>
        <table class="table table-striped border rounded">
            <tr class="">
                <th scope="col" class="bg-secondary text-white">Goal</th>
                <th scope="col" class="bg-secondary text-white">Description</th>
                <th scope="col" class="bg-secondary text-white">Deadline</th>
                <th scope="col" class="bg-secondary text-white">Actions</th>
            </tr>
            @foreach($goals as $goal)
            <tr>
                <td>{{$goal->goalName}}</td>
                <td>{{$goal->description}}</td>
                <td>{{$goal->deadline}}</td>
                <td>
                    <a href="" wire:click="editGoalFields({{ $goal->id }})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editGoalModal">Edit</a>
                    <a href="" wire:click="deleteGoalButton({{ $goal->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGoalModal">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{$goals->links()}}
    </div>

</div>