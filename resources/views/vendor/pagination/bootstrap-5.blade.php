@if ($paginator->hasPages())
<div class="th-pagination text-center mt-5 mb-0">
    <ul>

        @foreach ($elements as $element)
        @if (is_string($element))
        <span class="page-item disabled" aria-disabled="true">
            <span class="page-link fw-medium text-secondary d-none d-md-inline">
                {{ $element }}
            </span>
        </span>
        @else

        @if (is_array($element))
        @foreach ($element as $page => $url)
        <li>
            <a href="{{ $url }}"> {{ $page }}</a>
        </li>
        @endforeach
        @endif
        @endif
        @endforeach

    </ul>
</div>
@endif