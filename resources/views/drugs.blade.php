<html>
    <head>
        <title>List of Drugs</title>
    </head>
    <body>
        <h1>List of Drugs</h1>

        @if(session('info'))
        <h2><{{ session('info') }}</h2>
        @endif

        <table border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Code</th>
                <th>Available</th>
            </tr>
            @foreach($drugs as $drug)
            <tr>
                <td>{{ $drug['drug_id'] }}</td>
                <td><a href="{{route('drugs.find', $drug)}}">{{ $drug['name'] }}</a></td>
                <td>{{ $drug['drug_code'] }}</td>
                <td>{{ ($drug['is_active']) ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </table>
        <a href="{{route('drugs.new')}}">Create</a>
    </body>
</html>