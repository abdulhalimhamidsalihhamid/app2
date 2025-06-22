<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تسجيل الدخول</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap RTL -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    body {
      background: linear-gradient(to right, #f1f1f1, #ffffff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow-x: hidden;
    }

    .login-card {
      max-width: 500px;
      margin: 200px auto;
      padding: 30px;
      border-radius: 15px;
      background: white;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      animation: fadeInUp 1s ease;
    }

    .form-control {
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
      border-color: #0d6efd;
    }

    .btn-primary {
      border-radius: 10px;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .btn-primary:hover {
      transform: scale(1.05);
      background-color: #0056b3;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

  @include('home.navbar')

  <div class="login-card animate__animated animate__fadeInUp">
    <h4 class="text-center mb-4">تسجيل الدخول</h4>

    @if (session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
    </div>
@endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">كلمة المرور</label>
        <input type="password" name="password" class="form-control" id="password" required>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" name="remember" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">تذكرني</label>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">دخول</button>
      </div>

      <div class="text-center">
        <small><a href="#">نسيت كلمة المرور؟</a></small>
      </div>
    </form>
  </div>

</body>
</html>
