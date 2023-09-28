<nav {{ $attributes }}>
    <ul class="flex space-x-2">
        @foreach ($links as $lable => $link)
            <li>
                ->
            </li>
            <li>
                <a href="{{ $link }}">{{ $lable }}</a>
            </li>
        @endforeach
    </ul>
</nav>
