<div class="card" id="questions">
    <div class="card-header">
        Questions
        <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateQuestion" data-id="0" data-mode="add">Add</a>
    </div>
    <div class="card-body">
        <table class="table questions-table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($questions))
                    @foreach ($questions as $question)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $question->name }}</td>
                        <td>
                            <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateQuestion" style="margin-right: 5px;"  data-id="{{ $question->id }}" data-mode="edit">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" style="text-align: center;">No data found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
