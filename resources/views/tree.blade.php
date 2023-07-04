<!-- resources/views/tree.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Folder and File Tree</title>
    <style>
        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        .folder:before {
            content: "\f114";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 5px;
            color: #777;
        }

        .file:before {
            content: "\f15b";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            margin-right: 5px;
            color: #777;
        }

        .folder>ul {
            display: none;
        }

        .folder.open>ul {
            display: block;
        }
    </style>
</head>

<body>
    <h2>Folder and File Tree</h2>
    <ul>
        @foreach ($tree as $item)
            <li>
                @if ($item['type'] === 'folder')
                    <span class="folder" onclick="toggleFolder(this)"></span>
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
    </ul>

    <script>
        function toggleFolder(element) {
            element.parentElement.classList.toggle('open');
        }
    </script>
</body>

</html>
