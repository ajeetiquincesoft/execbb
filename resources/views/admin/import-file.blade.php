<!-- resources/views/upload.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>CSV Import</title>
</head>

<body>
    <form action="{{ route('data.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import CSV</button>
    </form>
</body>

</html>