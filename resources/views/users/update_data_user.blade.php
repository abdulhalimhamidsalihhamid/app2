<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل البيانات الشخصية</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f4f7;
      animation: fadeInBody 1s ease-in-out;
    }

    .profile-form {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.08);
      animation: slideInUp 0.9s ease forwards;
      opacity: 0;
    }

    .form-control, .form-select {
      transition: all 0.3s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
      transform: scale(1.02);
      box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    .btn {
      transition: transform 0.3s ease;
    }

    .btn:hover {
      transform: scale(1.03);
    }

    @keyframes fadeInBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideInUp {
      0% {
        transform: translateY(40px);
        opacity: 0;
      }
      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

@include('home.navbar_user')

<div class="container mt-5 mb-5">
  <div class="profile-form">

    <h4 class="mb-4 text-center">تعديل البيانات الشخصية</h4>

    {{-- رسائل النجاح --}}
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- رسائل الخطأ --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('users.update') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">اسم عضو هيئة التدريس</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $member->name_plain) }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" class="form-control" name="email" value="{{ old('email', $member->email_plain) }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">التخصص</label>
        <input type="text" class="form-control" name="specialty" value="{{ old('specialty', $member->specialty_plain) }}">
      </div>
      <div class="mb-3">
        <label class="form-label">الدرجة العلمية</label>
        <select class="form-select" name="degree">
          <option disabled selected>اختر الدرجة العلمية</option>
          @foreach(['بكالوريوس', 'ماجستير', 'دكتوراه', 'أستاذ مساعد', 'أستاذ مشارك', 'أستاذ'] as $option)
            <option value="{{ $option }}" {{ old('degree', $member->degree_plain) == $option ? 'selected' : '' }}>{{ $option }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">كلمة المرور الجديدة</label>
        <input type="password" class="form-control" name="password" placeholder="اتركه فارغاً إذا لا تريد التغيير">
      </div>
      <div class="mb-3">
        <label class="form-label">تأكيد كلمة المرور</label>
        <input type="password" class="form-control" name="password_confirmation" placeholder="أعد إدخال كلمة المرور">
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>
