<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>فيديوهات تدريبية</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f1f3f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      animation: fadeInBody 1s ease;
    }

    .box {
      background-color: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      margin-bottom: 30px;
      animation: fadeInUp 0.8s ease both;
    }

    h4, h5, h6 {
      color: #343a40;
    }

    iframe {
      border-radius: 10px;
      margin-top: 10px;
      animation: fadeIn 1s ease both;
    }

    .alert {
      animation: fadeInUp 0.5s ease both;
    }

    .btn {
      transition: transform 0.3s ease;
    }

    .btn:hover {
      transform: scale(1.03);
    }

    @keyframes fadeInBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.98); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body style="background-image: url('{{ asset('image/2.jpg') }}'); background-size: cover; background-repeat: no-repeat;">

@include('home.navbar_user')

  <div class="container mt-5">

    <!-- نموذج إضافة فيديو -->
    <div class="box">
      <h4 class="mb-4">إضافة فيديو تدريبي</h4>

      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('videos.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">العنوان</label>
          <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">الوصف</label>
          <textarea name="description" class="form-control" rows="2"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">رابط الفيديو (YouTube)</label>
          <input type="url" name="url" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">التصنيف</label>
          <input type="text" name="category" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">إضافة</button>
      </form>
    </div>

    <!-- قائمة الفيديوهات -->
    <h5 class="mb-4 text-center bg-amber-50 ">قائمة الفيديوهات</h5>
    @foreach($videos as $video)
      @php
        preg_match('/(?:youtube\.com.*(?:\?|&)v=|youtu\.be\/)([^&\n?#]+)/', $video->url, $matches);
        $videoId = $matches[1] ?? null;
      @endphp

      <div class="box">
        <h6>{{ $video->title }}</h6>
        <p class="mb-1">{{ $video->description }}</p>
        <p class="mb-2"><strong>التصنيف:</strong> {{ $video->category }}</p>

        @if($videoId)
          <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
        @endif

        <form method="POST" action="{{ route('videos.destroy', $video->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm mt-3">حذف</button>
        </form>
      </div>
    @endforeach
  </div>
</body>
</html>
