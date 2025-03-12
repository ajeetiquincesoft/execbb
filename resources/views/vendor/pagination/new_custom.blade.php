<!-- resources/views/vendor/pagination/custom.blade.php -->
@if ($paginator->hasPages())
    <div class="pagination-wrapper">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    &lsaquo; Previous <!-- Left arrow (Previous) -->
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="{{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a href="{{ $url }}" class="rounded">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="{{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                   Next &rsaquo; <!-- Right arrow (Next) -->
                </a>
            </li>
        </ul>
    </div>
@endif
