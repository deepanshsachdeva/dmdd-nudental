<html>
    <head>
        <title>Drug Information</title>
    </head>
    <body>
        <h1>{{ $drug['name'] }}</h1>
        <p>Code: {{ $drug['drug_code'] }}</p>
        <p>Available: {{ ($drug['is_active']) ? 'Yes' : 'No' }}</p>
    </body>
</html>