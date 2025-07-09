<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>كتب الطالب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body { background-color: #f5f7fa; }
        .card { transition: 0.3s; box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">الكتب التعليمية</h2>

    <!-- اختيار المدرس -->
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-10">
                <select name="faculty_id" class="form-select">
                    <option value="">اختر المدرس</option>
                    @foreach($facultyMembers as $faculty)
                        <option value="{{ $faculty->id }}" {{ $facultyId == $faculty->id ? 'selected' : '' }}>
                            {{ Crypt::decryptString($faculty->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">عرض</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($books as $book)
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>{{ $book->name }}</h5>
                    <p><strong>المؤلف:</strong> {{ $book->author }}</p>
                    <p><strong>التصنيف:</strong> {{ $book->category }}</p>
                    <p>{{ $book->description }}</p>
                    <p><strong>المدرس:</strong> {{ Crypt::decryptString($book->facultyMember->name) }}</p>
                    <a href="{{ route('books.download', $book->id) }}" target="_blank" class="btn btn-success w-100">تحميل الكتاب</a>
                </div>
            </div>
        @empty
            <p class="text-center">لا توجد كتب متاحة.</p>
        @endforelse
    </div>
</div>
</body>
</html>
