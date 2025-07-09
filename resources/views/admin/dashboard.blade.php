<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <title>لوحة التحكم الإدارية</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #eef1f5;
    }

    .main-body {
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      animation: slideIn 0.6s ease forwards;
      opacity: 0;
    }

    .card:nth-child(1) {
      animation-delay: 0.1s;
    }

    .card:nth-child(2) {
      animation-delay: 0.3s;
    }

    .card:nth-child(3) {
      animation-delay: 0.5s;
    }

    @keyframes slideIn {
      0% {
        transform: translateY(30px);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .navbar {
      background-color: #0d6efd;
    }

    .navbar-brand,
    .nav-link {
      color: #fff !important;
    }

    .card-title {
      font-size: 1.4rem;
      font-weight: bold;
    }

    .container {
      margin-top: 70px;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">لوحة التحكم</a>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">المستخدمون</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.messages.create') }}">الرسائل</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('users.edit') }}">الإعدادات</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Dashboard Content -->
  <div class="container main-body">
    <h2 class="text-center mb-5 fw-bold">لوحة التحكم الإدارية</h2>

    <div class="row g-4">
      <!-- إدارة المستخدمين -->
      <div class="col-md-4">
        <div class="card border-primary text-center">
          <div class="card-body">
            <h5 class="card-title">إدارة المستخدمين</h5>
            <p class="card-text">إضافة أو تعديل أو حذف حسابات الأعضاء.</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">الانتقال</a>
          </div>
        </div>
      </div>

      <!-- إرسال الرسائل -->
      <div class="col-md-4">
        <div class="card border-success text-center">
          <div class="card-body">
            <h5 class="card-title">إرسال الرسائل</h5>
            <p class="card-text">إرسال رسائل بريد إلكتروني للمستخدمين.</p>
            <a href="{{ route('admin.messages.create') }}" class="btn btn-success">إرسال</a>
          </div>
        </div>
      </div>

      <!-- إعدادات الحساب -->
      <div class="col-md-4">
        <div class="card border-warning text-center">
          <div class="card-body">
            <h5 class="card-title">إعدادات الحساب</h5>
            <p class="card-text">تحديث بيانات حساب الأدمن وكلمة المرور.</p>
            <a href="{{ route('users.edit') }}" class="btn btn-warning">الإعدادات</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
