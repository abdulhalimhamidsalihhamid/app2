<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة الطالب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Cairo', sans-serif;
        }

        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            color: #f5f7fa;
        }

        .card {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.4s, box-shadow 0.4s;
            border-radius: 15px;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 16px 30px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1.2rem;
        }

        h2 {
            font-weight: bold;
        }
    </style>
</head>

<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold text-amber-50" href="#">نظام الطالب</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.videos') }}">الفيديوهات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.books') }}">الكتب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('student.grades') }}">الدرجات</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-5">لوحة تحكم الطالب</h2>

        <div class="row g-4">
            <!-- الفيديوهات -->
            <div class="col-md-4">
                <div class="card border-success text-center p-3">
                    <div class="card-body">
                        <h5 class="card-title">الفيديوهات</h5>
                        <a href="{{ route('student.videos') }}" class="btn btn-success">عرض الفيديوهات</a>
                    </div>
                </div>
            </div>

            <!-- الكتب -->
            <div class="col-md-4">
                <div class="card border-primary text-center p-3">
                    <div class="card-body">
                        <h5 class="card-title">الكتب</h5>
                        <a href="{{ route('student.books') }}" class="btn btn-primary">عرض الكتب</a>
                    </div>
                </div>
            </div>

            <!-- الدرجات -->
            <div class="col-md-4">
                <div class="card border-warning text-center p-3">
                    <div class="card-body">
                        <h5 class="card-title">الدرجات</h5>
                        <a href="{{ route('student.grades') }}" class="btn btn-warning">عرض الدرجات</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-warning text-center p-3">
                    <div class="card-body">
                        <h5 class="card-title">اعدادات الحساب</h5>
                        <a href="{{ route('users.edit') }}" class="btn btn-warning">دخول</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
