<html>
    <head>
        <title>Create Drug</title>
    </head>
    <body>
        <h1>Create Drug</h1>
        <p>Enter details:</p>
        <form action="{{ route('drugs.new') }}" method="post">
            @csrf
            <table>
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Code: </td>
                    <td><input type="text" name="code"></td>
                </tr>
                <tr>
                    <td>Available: </td>
                    <td><input type="checkbox" name="active" value="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit">Create</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>