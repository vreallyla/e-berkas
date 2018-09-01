@if($status==0)
    <div class="dropdown">
        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" title="klik untuk eksekusi" aria-haspopup="true" style="width: 55`px" aria-expanded="false">
            Menunggu
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-id="{{$id}}" data-user="{{$user}}" data-action="true" onclick="actionData(this)">Terima</a>
            <a class="dropdown-item" href="#" data-id="{{$id}}" data-user="{{$user}}" data-action="false" onclick="actionData(this)">Tolak</a>
        </div>
    </div>
    @elseif($status==1)
    <div class="dropdown">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" title="klik untuk eksekusi" aria-haspopup="true" style="width: 55`px" aria-expanded="false">
            Diterima
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-id="{{$id}}" data-user="{{$user}}" data-action="false" onclick="actionData(this)">Tolak</a>
        </div>
    </div>
@else
    <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" title="klik untuk eksekusi" aria-haspopup="true" style="width: 55`px" aria-expanded="false">
            ditolak
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" data-id="{{$id}}" data-user="{{$user}}" data-action="true" onclick="actionData(this)">Terima</a>
        </div>
    </div>
@endif