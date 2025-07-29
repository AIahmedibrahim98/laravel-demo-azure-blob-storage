<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Azure Blob Storage Laravel Demo</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Azure Blob Storage - Laravel Demo</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('azure.upload') }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-center mb-3">
                        @csrf
                        <div class="col-auto">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-success" type="submit">Upload</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-lg">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Uploaded Files</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>File Name</th>
                            <th style="width: 170px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($files as $key => $file)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-break">{{ $file }}</td>
                                <td>
                                    <a href="{{ route('azure.download', ['file' => $file]) }}" class="btn btn-primary btn-sm" target="_blank">Download</a>
                                    <form action="{{ route('azure.delete', ['file' => $file]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">No files found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mt-3 text-muted small">
                <span>&copy; {{ date('Y') }} Azure Blob Storage Demo - Laravel</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
