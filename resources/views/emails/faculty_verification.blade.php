<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>مرحباً {{ $facultyName }}</h2>
    <p>يرجى الضغط على الرابط التالي لتأكيد بريدك الإلكتروني:</p>
    <a href="{{ $url }}">{{ $url }}</a>
    <p>إذا لم تقم بإنشاء الحساب، يمكنك تجاهل هذه الرسالة.</p>
</body>
</html>
