<!-- resources/views/courses/index.blade.php -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>إدارة المقررات الدراسية</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3 class="mb-4 text-center">المقررات الدراسية التي أدرسها</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('courses.store') }}" method="POST" class="d-flex gap-2 mb-4">
    @csrf
    <input type="text" name="name" class="form-control" placeholder="أدخل اسم المقرر الدراسي" required>
    <button type="submit" class="btn btn-primary">إضافة</button>
  </form>

  <ul class="list-group">
    @forelse ($courses as $course)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $course->name }}
        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger btn-sm">حذف</button>
        </form>
      </li>
    @empty
      <li class="list-group-item text-center text-muted">لا توجد مقررات حتى الآن</li>
    @endforelse
  </ul>
</div>

</body>
</html>
