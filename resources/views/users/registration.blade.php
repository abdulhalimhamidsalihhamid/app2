<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>إنشاء حساب</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to left, #c2e9fb, #f9f9f9);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow-x: hidden;
    }

   .card {
  margin-top: 200px; /* المسافة من الأعلى */
  border: none;
  border-radius: 15px;
  background: rgba(255, 255, 255, 0.75);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  backdrop-filter: blur(10px);
  width: 100%;
  max-width: 600px;
  animation: fadeInUp 0.8s ease forwards;
  opacity: 0;
  transform: translateY(30px);
}


    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-control,
    .form-select {
      border-radius: 10px;
    }

    .btn-primary {
      border-radius: 10px;
      background-color: #0069d9;
      border: none;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #004eae;
    }
  </style>
</head>

<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

  @include('home.navbar')

  <div class="container m-5 p-5 ">
    <div class="card p-4 m-auto">
      <h4 class="text-center mb-4">إنشاء حساب عضو هيئة تدريس</h4>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">الاسم الكامل</label>
          <input type="text" name="name" class="form-control" required>
          @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">البريد الإلكتروني</label>
          <input type="email" name="email" class="form-control" required>
          @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="specialty" class="form-label">التخصص</label>
          <input type="text" name="specialty" class="form-control" required>
          @error('specialty')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="degree" class="form-label">الدرجة العلمية</label>
          <select name="degree" class="form-select" required>
            <option selected disabled>اختر الدرجة العلمية</option>
            <option value="بكالوريوس">بكالوريوس</option>
            <option value="ماجستير">ماجستير</option>
            <option value="دكتوراه">دكتوراه</option>
            <option value="أستاذ مساعد">أستاذ مساعد</option>
            <option value="أستاذ مشارك">أستاذ مشارك</option>
            <option value="أستاذ">أستاذ</option>
          </select>
          @error('degree')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">كلمة المرور</label>
          <input type="password" name="password" class="form-control" required>
          @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">إنشاء الحساب</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
