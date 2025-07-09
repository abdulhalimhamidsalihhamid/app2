<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إرسال رسالة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body class="p-4">

<div class="container">
    <div class="card shadow p-4">
        <h4 class="text-center mb-4">إرسال رسالة إلى المستخدم</h4>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.messages.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">اختر المستخدم</label>
                <select name="faculty_member_id" class="form-select" required>
                    <option disabled selected>-- اختر المستخدم --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ Crypt::decryptString($user->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">عنوان الرسالة</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">محتوى الرسالة</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">إرسال</button>
        </form>
    </div>
</div>

</body>
</html>
