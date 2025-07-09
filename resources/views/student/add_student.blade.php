<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إضافة طلاب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        .div-home {
            background-image: url('{{ asset('image/2.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-div {
            background-color: rgba(255, 255, 255, 0.95);
            margin-top: 80px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 1s ease-in-out;
        }

        h4,
        h5 {
            color: #007bff;
            font-weight: bold;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-primary,
        .btn-danger {
            border-radius: 10px;
        }

        .table {
            border-radius: 12px;
            overflow: hidden;
            animation: fadeIn 1.2s ease-in-out;
        }

        tr {
            animation: fadeIn 0.7s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            animation: fadeIn 0.6s ease-in-out;
        }
    </style>
</head>

<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

    @include('home.navbar_user')

    <div class="div-home">


        <div class="container container-div p-4">

            <label class="form-label">إضافة طالب</label>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <select name="student_id" class="form-select" required>
                            <option selected disabled>اختر طالبًا</option>
                            @foreach ($studentsOptions as $studentOption)
                                <option value="{{ $studentOption->id }}">
                                    {{ Crypt::decryptString($studentOption->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">المقرر الدراسي</label>
                        <select name="course_id" class="form-select" required>
                            <option selected disabled>اختر مقررًا</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">إضافة</button>
            </form>

            <hr>

            <h5 class="mt-4">قائمة الطلاب:</h5>
            <table class="table table-striped mt-3 text-center">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>اسم الطالب</th>
                        <th>المقرر</th>
                        <th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ Crypt::decryptString($student->facultyMember->name) }}</td>
                            <td>{{ $student->course->name }}</td>
                            <td>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
