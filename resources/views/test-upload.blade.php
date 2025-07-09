<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test File Upload</h1>
    
    @if ($errors->any())
        <div style="color: red;">
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div style="color: green;">
            <h3>Success:</h3>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div style="color: red;">
            <h3>Error:</h3>
            <p>{{ session('error') }}</p>
        </div>
    @endif
    
    <form action="{{ route('test.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="test_file">Select File:</label>
            <input type="file" name="test_file" id="test_file" accept="image/*" required>
        </div>
        <div>
            <label for="test_name">Name:</label>
            <input type="text" name="test_name" id="test_name" value="Test User" required>
        </div>
        <div>
            <button type="submit">Upload Test File</button>
        </div>
    </form>

    <script>
        document.getElementById('test_file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                console.log('File selected:', {
                    name: file.name,
                    size: file.size,
                    type: file.type
                });
            }
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            const file = document.getElementById('test_file').files[0];
            console.log('Form submitted with file:', file);
        });
    </script>
</body>
</html>