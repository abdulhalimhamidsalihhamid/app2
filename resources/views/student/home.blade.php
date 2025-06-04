<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المدرس</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .div-home {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding-top: 80px;
            /* لتجنب التداخل مع الـ navbar الثابت */
            background-image: url('{{ asset('image/2.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-container {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 1s ease forwards;
        }

        .action-card {
            width: 240px;
            height: 220px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(120deg, #00f2fe33, #4facfe33);
            transform: rotate(25deg);
            z-index: 0;
            transition: opacity 0.5s;
            opacity: 0;
        }

        .action-card:hover::before {
            opacity: 1;
        }

        .action-card:hover {
            transform: translateY(-10px);
        }

        .action-card i {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 15px;
            z-index: 1;
        }

        .action-card a {
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .action-card a:hover {
            color: #007bff;
        }

        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                padding: 0 15px;
            }
        }

        /* أنيميشن الدخول */
        @keyframes fadeInUp {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <!-- شريط التنقل الثابت -->

    @include('home.navbar_user')

    <div class="div-home">
        <!-- البطاقات -->
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

    </div>

</body>

</html>
