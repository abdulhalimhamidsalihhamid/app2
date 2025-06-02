<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إضافة طلاب</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
  <div class="container bg-white p-4 rounded shadow">
    <h4 class="mb-4">إضافة طالب</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('students.store') }}">
      @csrf
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <label class="form-label">اسم الطالب</label>
          <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">المقرر الدراسي</label>
          <select name="course_id" class="form-select" required>
            <option selected disabled>اختر مقررًا</option>
            @foreach($courses as $course)
              <option value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">إضافة</button>
    </form>

    <hr>

    <h5 class="mt-4">قائمة الطلاب:</h5>
    <table class="table table-striped mt-3 text-center">
      <thead>
        <tr>
          <th>#</th>
          <th>اسم الطالب</th>
          <th>المقرر</th>
          <th>إجراء</th>
        </tr>
      </thead>
      <tbody>
        @foreach($students as $student)
          <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->course->name }}</td>
            <td>
              <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">حذف</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
