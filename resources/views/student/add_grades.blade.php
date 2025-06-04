<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>درجات الطلاب</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

@include('home.navbar_user')

<div class="container bg-white p-4 mt-5 mb-5 rounded shadow">
  <h4 class="mb-4 text-center">إضافة درجات الطلاب</h4>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <form method="POST" action="{{ route('grades.store') }}" id="gradesForm">
    @csrf
    <div class="mb-3">
      <label class="form-label">اختر المقرر</label>
      <select class="form-select" name="course_id" id="courseSelect" required>
        <option disabled selected>اختر المقرر</option>
        @foreach($courses as $course)
          <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
      </select>
    </div>

    <div id="studentsContainer" style="display: none;">
      <table class="table table-bordered text-center">
        <thead class="table-primary">
          <tr>
            <th>#</th>
            <th>اسم الطالب</th>
            <th>درجة نصف الفصل</th>
            <th>درجة النهائي</th>
          </tr>
        </thead>
        <tbody id="studentsTableBody"></tbody>
      </table>
      <button type="submit" class="btn btn-success w-100">حفظ الدرجات</button>
    </div>
  </form>
</div>

<script>
document.getElementById('courseSelect').addEventListener('change', function () {
  const courseId = this.value;
  fetch(`/app2/public/students/grades/students/${courseId}`)
    .then(response => response.json())
    .then(students => {
      const container = document.getElementById('studentsContainer');
      const body = document.getElementById('studentsTableBody');
      body.innerHTML = '';
      students.forEach((student, index) => {
        // تعديل أسماء الحقول حسب البيانات
        const mid = student.grades?.[0]?.mid_term || '';
        const final = student.grades?.[0]?.final_term || '';

        const row = `
          <tr>
            <td>${index + 1}</td>
            <td>${student.name}</td>
            <td><input type="number" name="grades[${index}][mid]" class="form-control" value="${mid}" required></td>
            <td><input type="number" name="grades[${index}][final]" class="form-control" value="${final}" required></td>
            <input type="hidden" name="grades[${index}][student_id]" value="${student.id}">
          </tr>`;
        body.innerHTML += row;
      });
      container.style.display = 'block';
    });
});
</script>



</body>
</html>
