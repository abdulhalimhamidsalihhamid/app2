<!-- شريط التنقل (Navbar) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">لوحة التحكم - عضو هيئة التدريس</a>

    <!-- زر التبديل عند الشاشات الصغيرة -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarOptions" aria-controls="navbarOptions" aria-expanded="false" aria-label="تبديل التنقل">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- الروابط -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarOptions">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('students.home') }}"><i class="fas fa-chart-line me-1"></i>نتائج الطلاب</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('books.index') }}"><i class="fas fa-book me-1"></i>الكتب الدراسية</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('videos.index') }}"><i class="fas fa-video me-1"></i>فيديوهات تدريبية</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('users.edit') }}"><i class="fas fa-user-edit me-1"></i>تعديل البيانات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('users.logout') }}"><i class="fas fa-sign-out-alt me-1"></i>تسجيل الخروج</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
