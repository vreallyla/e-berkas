@if($restore == 1 && $delete == 1)
    {{--<a data-id="{{$id}}" data-method="2" onclick="restoreData(this)" class="btn btn-success"><i class='glyphicon glyphicon-edit'></i>Restore</a>--}}
    {{--<a data-id="{{$id}}" data-method="2" onclick="deletePermData(this)" class="btn btn-danger"><i class='glyphicon glyphicon-trash'></i> Delete</a>--}}
    <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="showForm({{ $id }})">Lihat</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><a data-id="{{$id}}" data-method="2" onclick="restoreData(this)">Pulihkan</a></li>
            <li><a data-id="{{$id}}" data-method="2" onclick="deleteData(this)">Hapus permanen</a></li>
            <li role="separator" class="divider"></li>
            @foreach($data as $row)
                <li><a href="{{url($row->name)}}" target="_blank">{{substr($row->name,21)}}</a></li>
            @endforeach
        </ul>
    </div>

@elseif($restore == 0 && $delete == 1)
    <a onclick="restoreData({{ $id }})" class="btn btn-info btn-xs"><i class='glyphicon glyphicon-eye-open'></i>
        Restore</a>
    <a onclick="deletePermData({{ $id }})" class="btn btn-danger btn-xs"><i class='glyphicon glyphicon-trash'></i>
        Delete</a>

@elseif($restore == 1 && $delete == 0)
    <a onclick="restoreData({{ $id }})" class="btn btn-info btn-xs"><i class='glyphicon glyphicon-eye-open'></i>
        Restore</a>
    <a onclick="deletePermData({{ $id }})" class="btn btn-primary btn-xs"><i class='glyphicon glyphicon-edit'></i>
        Delete</a>

@endif