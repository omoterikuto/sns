@if ($paginator->hasPages())
<ul class="pagination mt-3 ml-auto" role="navigation">
  <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
    <a class="page-link border" href="{{ $paginator->url(1) }}">&laquo;</a>
  </li>
  <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
    <a class="page-link border" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
  </li>
  @foreach ($elements as $element)
  @if (is_string($element))
  <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
  @endif
  @if (is_array($element))
  @foreach ($element as $page => $url)
  @if ($page == $paginator->currentPage())
  <li class="active" aria-current="page"><span class="mt-2 ml-1 d-block">&nbsp;{{ $page }}</span></li>
  <li class="mt-2 d-block">&nbsp;/&nbsp;</li>
  <li class="active" aria-current="page"><span class="mt-2 mr-1 d-block">{{ $paginator->lastPage() }}&nbsp;</span></li>
  @endif
  @endforeach
  @endif
  @endforeach
  <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
    <a class="page-link border" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
  </li>
  <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
    <a class="page-link border" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
  </li>
</ul>
@endif