<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>درجاتي</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background-color: #f5f7fa; }
        .table { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
<div class="container mt-5">
    <h2 class="text-center mb-4">درجاتي</h2>

    @if($grades->count())
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>المقرر</th>
                    <th>درجة نصف الفصل</th>
                    <th>درجة النهائي</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $index => $grade)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $grade->course->name }}</td>
                        <td>{{ $grade->mid_term }}</td>
                        <td>{{ $grade->final_term }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">لا توجد درجات حتى الآن.</p>
    @endif
</div>
</body>
</html>
