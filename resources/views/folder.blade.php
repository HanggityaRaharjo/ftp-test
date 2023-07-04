<!-- resources/views/folder.blade.php -->

@foreach ($children as $item)
    <li>
        @if ($item['type'] === 'folder')
            <span class="folder"></span>
            {{ $item['name'] }}
            <ul>
                @include('folder', ['children' => $item['children']])
            </ul>
        @else
            <span class="file"></span>
            {{ $item['name'] }}
        @endif
    </li>
@endforeach
