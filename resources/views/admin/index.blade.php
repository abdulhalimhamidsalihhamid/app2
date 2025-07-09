<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إدارة المستخدمين</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light p-5">
<div class="container bg-white p-4 rounded shadow">
  <h4 class="mb-4 text-center">إدارة المستخدمين</h4>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>الاختصاص</th>
        <th>الدرجة</th>
        <th>الصلاحية</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $index => $user)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{  Crypt::decryptString($user->name) }}</td>
          <td>{{  Crypt::decryptString($user->email) }}</td>
          <td>{{  Crypt::decryptString($user->specialty) }}</td>
          <td>{{  Crypt::decryptString($user->degree) }}</td>
          <td>{{  Crypt::decryptString($user->role) }}</td>
          <td>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">تعديل</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
</body>
</html>
