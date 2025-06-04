<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
  <div class="container">
    <!-- شعار بصورة -->
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="{{ asset('image/logo.png') }}" alt="شعار" class="logo-img me-2">
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

  .custom-navbar {
    background: linear-gradient(to left, rgba(255, 255, 255, 0.9), rgba(240, 248, 255, 0.9)); /* تموج بلون فاتح مع شفافية */
    backdrop-filter: blur(8px); /* يجعل التموج ناعم ويزيد من الجمالية */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: background 0.5s ease-in-out;
  }
</style>
