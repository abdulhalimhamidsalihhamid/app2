<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>فيديوهات تدريبية</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body class="bg-light ">
@include('home.navbar_user')
<div class="container mt-5">
  <div class="bg-white p-4 rounded shadow-sm mb-4">
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
        <textarea name="description" class="form-control"></textarea>
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

  <div>
    <h5 class="mb-3">قائمة الفيديوهات</h5>
    @foreach($videos as $video)
      @php
        preg_match('/(?:youtube\.com.*(?:\?|&)v=|youtu\.be\/)([^&\n?#]+)/', $video->url, $matches);
        $videoId = $matches[1] ?? null;
      @endphp
      <div class="bg-white p-3 rounded mb-3 shadow-sm">
        <h6>{{ $video->title }}</h6>
        <p>{{ $video->description }}</p>
        <p><strong>التصنيف:</strong> {{ $video->category }}</p>
        @if($videoId)
          <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
        @endif
        <form method="POST" action="{{ route('videos.destroy', $video->id) }}" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm mt-2">حذف</button>
        </form>
      </div>
    @endforeach
  </div>
</div>

</body>
</html>
