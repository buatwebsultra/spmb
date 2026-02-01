<div>
    <nav aria-label="breadcrumb">
        <div class="container">
            <div class="card card-body my-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"><span class="badge text-bg-secondary"><i class="bi bi-house"></i></span></a></li>
                    @foreach ($urls as $value)
                        <li class="breadcrumb-item {{Route::currentRouteName()==$value['name'] ? 'active' : ''}}"><a href="{{$value['route']}}"><span class="badge {{Route::currentRouteName()==$value['name'] ? 'text-bg-info' : 'text-bg-secondary'}}">{{$value['label']}}</span></a></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </nav>
</div>
