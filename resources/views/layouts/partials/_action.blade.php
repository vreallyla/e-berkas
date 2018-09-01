@if($show == 1 && $edit == 1 && $delete == 1)
    <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="showForm({{ $id }})">Lihat</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                >
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><a data-id="{{$id}}" data-method="2" onclick="editForm(this)">Edit</a></li>
            <li><a data-id="{{$id}}" data-method="2" onclick="deleteData(this)">Hapus</a></li>
            <li role="separator" class="divider"></li>
            @foreach($data as $row)
            <li><a href="{{url($row->name)}}" target="_blank">{{substr($row->name,21)}}</a></li>
                @endforeach
        </ul>
    </div>


@elseif($show == 0 && $edit == 1 && $delete == 1)
    <a onclick="editForm({{ $id }})" class="btn btn-primary btn-xs"><i class='glyphicon glyphicon-edit'></i> Edit</a>
    <a onclick="deleteData({{ $id }})" class="btn btn-danger btn-xs"><i class='glyphicon glyphicon-trash'></i> Delete</a>

@elseif($show == 1 && $edit == 0 && $delete == 1)
    <a onclick="showForm({{ $id }})" class="btn btn-info btn-xs"><i class='glyphicon glyphicon-eye-open'></i> Show</a>
    <a onclick="deleteData({{ $id }})" class="btn btn-danger btn-xs"><i class='glyphicon glyphicon-trash'></i> Delete</a>

@elseif($show == 1 && $edit == 1 && $delete == 0)
    <a onclick="showForm({{ $id }})" class="btn btn-info btn-xs"><i class='glyphicon glyphicon-eye-open'></i> Show</a>
    <a onclick="editForm({{ $id }})" class="btn btn-primary btn-xs"><i class='glyphicon glyphicon-edit'></i> Edit</a>

@elseif($show == 1 && $edit == 0 && $delete == 0)
    <a onclick="showForm({{ $id }})" class="btn btn-info btn-xs"><i class='glyphicon glyphicon-eye-open'></i> Show</a>

@elseif($show == 0 && $edit == 1 && $delete == 0)
    <a onclick="editForm({{ $id }})" class="btn btn-primary btn-xs"><i class='glyphicon glyphicon-edit'></i> Edit</a>

@elseif($show == 0 && $edit == 0 && $delete == 1)
    <a onclick="deleteData({{ $id }})" class="btn btn-danger btn-xs"><i class='glyphicon glyphicon-trash'></i> Delete</a>
@endif