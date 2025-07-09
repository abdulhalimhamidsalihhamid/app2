<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل المستخدم</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow">
  <h4 class="mb-4 text-center">تعديل بيانات المستخدم</h4>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">الاسم</label>
      <input type="text" name="name" class="form-control" value="{{ old('name',  Crypt::decryptString($user->name)) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">البريد الإلكتروني</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', Crypt::decryptString($user->email)) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">الاختصاص</label>
      <input type="text" name="specialty" class="form-control" value="{{ old('specialty', Crypt::decryptString($user->specialty)) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">الدرجة</label>
      <input type="text" name="degree" class="form-control" value="{{ old('degree', Crypt::decryptString($user->degree)) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">الصلاحية</label>
      <select name="role" class="form-select" required>
        <option value="admin" {{ old('role', Crypt::decryptString($user->role)) === 'admin' ? 'selected' : '' }}>مدير</option>
        <option value="user" {{ old('role', Crypt::decryptString($user->role)) === 'user' ? 'selected' : '' }}>مستخدم</option>
        <option value="user" {{ old('role', Crypt::decryptString($user->role)) === 'student' ? 'selected' : '' }}>طالب</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">تأكيد كلمة المرور</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary w-100">تحديث</button>
  </form>
</div>

</body>
</html>
