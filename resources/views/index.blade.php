<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel Generate Barcode Examples</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4">
    <h1>Barcode</h1>
    @include('messages')
    <form action="{{ route('barcode.generate') }}" method="post">
        @csrf
        <input class="form-control" type="text" name="barcode" placeholder="enter text without special characters">
        <div class="mt-3">
            <button class="btn btn-success" type="submit">Generate barcode</button>
        </div>
    </form>
    <div class="mt-4">
        <table class="table table-border">
            <thead>
            <tr>
                <th>Id</th>
                <th>File name</th>
                <th>Barcode</th>
                <th>Text</th>
            </tr>
            </thead>
            @forelse($barcodes as $barcode)
                <tr>
                    <td>{{$barcode->id}}</td>
                    <td>{{$barcode->filename}}</td>
                    <td><a href="{{ url(asset($barcode->filepath)) }}"><img src="{{ asset($barcode->filepath) }}" width="500"></a></td>
                    <td>{{$barcode->text}}</td>
                </tr>
            @empty
                <tr>
                    <td>
                        <h6>no barcodes</h6>
                    </td>
                </tr>
            @endforelse
        </table>
    </div>

</div>
</body>
</html>