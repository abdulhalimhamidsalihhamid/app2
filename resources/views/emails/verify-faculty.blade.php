<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تأكيد البريد</title>
</head>
<body>
    <h2>مرحبًا {{ $name }}</h2>
    <p>يرجى الضغط على الزر أدناه لتأكيد بريدك الإلكتروني.</p>
    <a href="{{ $verificationUrl }}" style="padding: 10px 15px; background-color: #3490dc; color: white; text-decoration: none;">تأكيد البريد</a>
    <p>إذا لم تطلب هذا البريد، فلا داعي لأي إجراء.</p>
</body>
</html>
