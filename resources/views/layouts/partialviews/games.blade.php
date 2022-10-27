<div class="card" id="games">
    <div class="card-header">
        Games
        <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateGame" data-id="0" data-mode="add">Add</a>
    </div>
    <div class="card-body">
        <table class="table games-table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($games))
                    @foreach ($games as $game)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $game->name }}</td>
                        <td>
                            <a href="javascript:void(0)" type="button" class="btn btn-primary btn-sm addOrUpdateGame" style="margin-right: 5px;"  data-id="{{ $game->id }}" data-mode="edit">Edit</a>
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
