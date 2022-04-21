<form action="{{route('save-files')}}" method="post">
    @csrf
    <button>Save Files</button>
</form>

@if(session('process'))
    <p>Synchronization is in process</p>
@endif
