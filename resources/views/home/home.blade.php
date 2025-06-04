<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>لوحة التحكم - عضو هيئة التدريس</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      background: linear-gradient(to right, #4facfe, #00f2fe);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .welcome {
      padding: 60px 0 20px;
      color: #000000;
      background: #ffffff7a;
      text-align: center;
    }

    .card {
        margin-top:10px;
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .card i {
      font-size: 40px;
      color: #007bff;
      margin-bottom: 10px;
    }

    .card-title {
      font-weight: bold;
      color: #333;
    }

    .btn-primary {
      border-radius: 10px;
    }
  </style>
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

@include('home.navbar_user')

<!-- الرسالة الترحيبية -->
<div class="welcome animate__animated animate__fadeInDown">
  <h2>مرحبًا بك في لوحة التحكم الخاصة بك</h2>
  <p>اختر أحد الخيارات التالية:</p>
</div>

<!-- البطاقات -->
<div class="container pb-5">
  <div class="row g-4">

    <!-- إضافة نتائج الطلاب -->
    <div class="col-md-6 col-lg-3">
      <div class="card text-center p-4 animate__animated animate__zoomIn" style="animation-delay: 0.1s;">
        <i class="fas fa-chart-line"></i>
        <h5 class="card-title">إضافة نتائج الطلاب</h5>
        <p class="card-text">إدخال أو تعديل درجات وتقارير الطلاب.</p>
        <a href="{{ route('students.home') }}" class="btn btn-primary mt-2">دخول</a>
      </div>
    </div>

    <!-- إضافة كتب -->
    <div class="col-md-6 col-lg-3">
      <div class="card text-center p-4 animate__animated animate__zoomIn" style="animation-delay: 0.2s;">
        <i class="fas fa-book"></i>
        <h5 class="card-title">إضافة كتب</h5>
        <p class="card-text">رفع أو مشاركة مصادر وكتب دراسية.</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-2">دخول</a>
      </div>
    </div>

    <!-- إضافة فيديوهات تدريبية -->
    <div class="col-md-6 col-lg-3">
      <div class="card text-center p-4 animate__animated animate__zoomIn" style="animation-delay: 0.3s;">
        <i class="fas fa-video"></i>
        <h5 class="card-title">إضافة فيديوهات تدريبية</h5>
        <p class="card-text">مشاركة فيديوهات تعليمية مع الطلاب.</p>
        <a href="{{ route('videos.index') }}" class="btn btn-primary mt-2">دخول</a>
      </div>
    </div>

    <!-- تعديل البيانات الشخصية -->
    <div class="col-md-6 col-lg-3">
      <div class="card text-center p-4 animate__animated animate__zoomIn" style="animation-delay: 0.4s;">
        <i class="fas fa-user-edit"></i>
        <h5 class="card-title">تعديل البيانات الشخصية</h5>
        <p class="card-text">تعديل الاسم، البريد، التخصص وكلمة المرور.</p>
        <a href="{{ route('users.edit') }}" class="btn btn-primary mt-2">دخول</a>
      </div>
    </div>

  </div>
</div>

</body>
</html>
