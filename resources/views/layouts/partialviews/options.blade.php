<div class="card" id="options">
    <div class="card-header">
        Options
        <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateOption" data-id="0" data-mode="add">Add</a>
    </div>
    <div class="card-body">
        <table class="table options-table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Point</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($options))
                    @foreach ($options as $option)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $option->name }}</td>
                        <td>{{ $option->points }}</td>
                        <td>
                            <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateOption" style="margin-right: 5px;"  data-id="{{ $option->id }}" data-mode="edit">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" style="text-align: center;">No data found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
