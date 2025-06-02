<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إضافة وعرض الكتب</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 30px;
    }

    .form-container {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }

    .table-container {
      background: white;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="container">

  <!-- نموذج إضافة كتاب -->
  <div class="form-container">
    <h4 class="mb-4">إضافة كتاب جديد</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">اسم الكتاب</label>
        <input type="text" class="form-control" name="name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">اسم المؤلف</label>
        <input type="text" class="form-control" name="author" required>
      </div>

      <div class="mb-3">
        <label class="form-label">وصف الكتاب</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">تصنيف الكتاب</label>
        <select class="form-select" name="category" required>
          <option selected disabled>اختر تصنيفًا</option>
          <option>رياضيات</option>
          <option>برمجة</option>
          <option>لغة عربية</option>
          <option>فيزياء</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">رفع ملف الكتاب (PDF)</label>
        <input class="form-control" type="file" name="file" accept=".pdf" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary">إضافة الكتاب</button>
      </div>
    </form>
  </div>

  <!-- جدول عرض الكتب -->
  <div class="table-container mt-5">
    <h5 class="mb-3">الكتب المضافة</h5>
    <table class="table table-striped">
      <thead class="table-light">
        <tr>
          <th>اسم الكتاب</th>
          <th>المؤلف</th>
          <th>التصنيف</th>
          <th>الوصف</th>
          <th>الملف</th>
          <th>حذف</th>
        </tr>
      </thead>
      <tbody>
        @foreach($books as $book)
        <tr>
          <td>{{ $book->name }}</td>
          <td>{{ $book->author }}</td>
          <td>{{ $book->category }}</td>
          <td>{{ $book->description }}</td>
          <td>
            <a href="{{ route('books.download', $book->id) }}" class="btn btn-sm btn-info">تنزيل</a>
          </td>
          <td>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الكتاب؟')">
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

</div>

</body>
</html>
