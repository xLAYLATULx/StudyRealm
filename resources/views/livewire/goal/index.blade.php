<!-- resources/views/livewire/goal.blade.php -->

<div class="goals">
    <h1>Goals</h1>
    @include('livewire.goal.modalform')
    <div class="goalsTable mt-5">
        <a class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addGoalModal">Add Goal</a>
        <table class="table">
            <tr>
                <th scope="col">Goal</th>
                <th scope="col">Description</th>
                <th scope="col">Deadline</th>
                <th scope="col">Actions</th>
            </tr>
            @foreach($goals as $goal)
            <tr>
                <td>{{$goal->goalName}}</td>
                <td>{{$goal->description}}</td>
                <td>{{$goal->deadline}}</td>
                <td>
                    <a href="" class="btn btn-primary">Edit</a>
                    <a href="" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>

@push('script')
<script>
    window.addEventListener('close-modal', event => {
        $('#addGoalModal').modal('hide');
    });
</script>
@endpush
