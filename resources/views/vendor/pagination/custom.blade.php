@if ($paginator->hasPages())
    <div class="pagination-wrap mt-30">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if (!$paginator->hasMorePages())
                <li class="page-item disabled" aria-disabled="true">
                    <a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-double-right"></i></a>
                </li>
            @endif
        </ul>
    </div>
    {{--<div class="row">--}}
        {{--<div class="col-12">--}}
            {{--<div class="pagination-wrap mt-30">--}}
                {{--<ul>--}}
                    {{--<li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>--}}
                    {{--<li class="active"><a href="#"></a></li>--}}
                    {{--<li><a href="#">2</a></li>--}}
                    {{--<li><a href="#">..</a></li>--}}
                    {{--<li><a href="#">4</a></li>--}}
                    {{--<li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endif
