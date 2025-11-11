@if(count($elements[0]) > 1)
    <ul id="ul-paginate" class="pagination pagination-sm no-margin pull-right">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
            <span class="page-link no-border">
                  <svg width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M24.5 44C35.5457 44 44.5 35.0457 44.5 24C44.5 12.9543 35.5457 4 24.5 4C13.4543 4 4.5 12.9543 4.5 24C4.5 35.0457 13.4543 44 24.5 44Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M31.5 24H19.5" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M23.5 18L17.5 24L23.5 30" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
            </span>
            </li>
        @else
            <li class="page-item no-border btn-prev">
                <a class="page-link no-border" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <svg width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.5 44C35.5457 44 44.5 35.0457 44.5 24C44.5 12.9543 35.5457 4 24.5 4C13.4543 4 4.5 12.9543 4.5 24C4.5 35.0457 13.4543 44 24.5 44Z" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 24H29.5" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.5 30L31.5 24L25.5 18" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
        @endif
             <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="page-item disabled show-desktop"><span class="page-link">{{ $element }}</span></li>
                @endif

            <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active show-desktop"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item show-desktop"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        {{-- Danh sách các trang --}}
        @php
            $lastPage = $paginator->lastPage(); // Tổng số trang
            $currentPage = $paginator->currentPage(); // Trang hiện tại
        @endphp

    <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link no-border" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <svg width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.5 44C35.5457 44 44.5 35.0457 44.5 24C44.5 12.9543 35.5457 4 24.5 4C13.4543 4 4.5 12.9543 4.5 24C4.5 35.0457 13.4543 44 24.5 44Z" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.5 24H29.5" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25.5 30L31.5 24L25.5 18" stroke="#BB2C26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </li>
        @else
            <li class="page-item disabled next-disable">
            <span class="page-link no-border">
             <svg width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M24.5 44C35.5457 44 44.5 35.0457 44.5 24C44.5 12.9543 35.5457 4 24.5 4C13.4543 4 4.5 12.9543 4.5 24C4.5 35.0457 13.4543 44 24.5 44Z" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M31.5 24H19.5" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M23.5 18L17.5 24L23.5 30" stroke="#999999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
            </span>
            </li>
        @endif
    </ul>
@endif
