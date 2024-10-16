{{-- <div class="ibox-tools d-flex justify-content-end align-items-center">
    <a class="collapse-link me-2" title="Collapse"><i class="fa fa-chevron-up"></i></a>
    <a class="dropdown-toggle me-2" data-toggle="dropdown" href="javascript:void(0);" title="Settings"><i class="fa fa-wrench"></i></a>
    <ul class="dropdown-menu dropdown-user">
        <li>
            <a href="#" class="dropdown-item changeStatusAllOn" data-value="1" data-field="active" data-model="User">Config option 1</a>
        </li>
        <li>
            <a href="#" class="dropdown-item changeStatusAllOn" data-value="0" data-field="active" data-model="User">Config option 2</a>
        </li>
    </ul>
    <a class="close-link" title="Close"><i class="fa fa-times"></i></a>
</div> --}}

<div class="dropdown-center d-flex justify-content-end align-items-center">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Centered dropdown
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item changeStatusAllOn" href="#" data-value="2" data-field="active"
                data-model="{{$model}}">Config option 1</a>
        </li>
        <li>
            <a class="dropdown-item changeStatusAllOn" href="#" data-value="1" data-field="active"
                data-model="{{$model}}">Config option 2</a>
        </li>
    </ul>
</div>
