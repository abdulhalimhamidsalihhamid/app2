<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>لوحة تحكم المدرس</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #4facfe, #00f2fe);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card-container {
      display: flex;
      gap: 30px;
      animation: rotate 40s linear infinite;
    }

    .action-card {
      width: 220px;
      height: 200px;
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.15);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      padding: 20px;
      transition: transform 0.3s;
    }

    .action-card:hover {
      transform: scale(1.08);
    }

    .action-card i {
      font-size: 40px;
      color: #007bff;
      margin-bottom: 15px;
    }

    .action-card a {
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
      color: #333;
    }

    

    @media (max-width: 768px) {
      .card-container {
        flex-direction: column;
        animation: none;
      }
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
@include('home.navbar')
</nav> 
<div class="card-container">
  <div class="action-card">
    <i class="fas fa-book-open"></i>
    <a href="{{ route('courses.index') }}">إضافة مقرر دراسي</a>
  </div>
  <div class="action-card">
    <i class="fas fa-user-plus"></i>
    <a href="{{ route('students.index') }}">إضافة طالب حسب المقرر</a>
  </div>
  <div class="action-card">
    <i class="fas fa-clipboard-list"></i>
    <a href="{{ route('students.grades') }}">إدخال درجات الطلاب</a>
  </div>
</div>

</body>
</html>
