<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container ">
    <!-- شعار بصورة -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{asset('image\logo.png')}}" alt="شعار" class="logo-img me-2">
      <span class="fw-bold fs-5 text-primary"></span>
    </a>

    <!-- زر الجوال -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- روابط -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
      <div class="d-flex gap-2 mt-3 mt-lg-0">
        <a href="{{ route('users.login') }}" class="btn btn-outline-primary rounded-pill px-4">تسجيل الدخول</a>
        <a href="{{ route('users.register') }}" class="btn btn-primary text-white rounded-pill px-4">إنشاء حساب</a>
      </div>
    </div>
  </div>
</nav>

<!-- CSS مخصص -->
<style>
  .logo-img {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 50%;
  }
</style>
