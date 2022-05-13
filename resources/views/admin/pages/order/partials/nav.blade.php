<div class="mt-4 mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.order') || Request::routeIs('admin.order-search')) ? 'active' : ''}}" href="{{route('admin.order')}}">@lang('All')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.awaiting') ? 'active' : '')}}" href="{{ route('admin.awaiting') }}">@lang('Awaiting')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.pending') ? 'active' : '')}}" href="{{ route('admin.pending') }}">@lang('Pending')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.processing') ? 'active' : '')}}" href="{{ route('admin.processing') }}">@lang('Processing')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.progress') ? 'active' : '')}}" href="{{ route('admin.progress') }}">@lang('In progress')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.completed') ? 'active' : '')}}" href="{{ route('admin.completed') }}">@lang('Completed')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.partial') ? 'active' : '')}}" href="{{ route('admin.partial') }}">@lang('Partial')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.canceled') ? 'active' : '')}}" href="{{ route('admin.canceled') }}">@lang('Canceled')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{(Request::routeIs('admin.refunded') ? 'active' : '')}}" href="{{ route('admin.refunded') }}">@lang('Refunded')</a>
        </li>
    </ul>
</div>
