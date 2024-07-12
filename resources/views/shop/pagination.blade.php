@if ($paginator->hasPages())
    <p class="showing-info mb-2 mb-sm-0">
        Showing
        <span>{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }}</span>
        Products
    </p>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="prev disabled">
                <a href="javascript:void(0)" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="w-icon-long-arrow-left"></i>
                    Prev
                </a>
            </li>
        @else
            <li class="prev">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="w-icon-long-arrow-left"></i>
                    Prev
                </a>
            </li>
        @endif
        
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif
            
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    Next
                    <i class="w-icon-long-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="next disabled">
                <a href="javascript:void(0)" rel="next" aria-label="@lang('pagination.next')">
                    Next
                    <i class="w-icon-long-arrow-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
