@if ($products->hasPages())
    <nav>
			<ul>
            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <li>
                    <a href="{{ $products->nextPageUrl() }}" rel="next" aria-label="@lang('products.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('products.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
