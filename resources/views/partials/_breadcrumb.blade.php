<div class="row mb-2">
    <div class="col-sm-6">
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
            @php $title; $url ; $icon @endphp
            @for($i = 0; $i < count($title); $i++)
                <li class="breadcrumb-item {{ $i == (count($title) - 1) ? 'active' : '' }}"><a href="{{ $url[$i] }}"><i class="fa"></i> {{ __($title[$i]) }} </a></li>
            @endfor
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->