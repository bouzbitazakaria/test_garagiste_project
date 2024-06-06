
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-3 border p-3 rounded-lg border-radius-xl my-3 fixed-start ms-3  "style="background-color:aliceblue" id="sidenav-main" style="overflow-y: hidden;">
  
  <div class=" navbar- w-auto" id="sidenav-collapse-main">
    <div class="text-center mb-6">
      <img src="{{ asset('storage/icons/mechanic.svg') }}" alt="Icon" class="img-fluid sidebar-icon w-40">
    </div>
    <ul class="navbar-nav gap-3">
      <li class="nav-item">
        <a class="nav-link {{ (Request::is('reparations') || Request::is('reparations/create') || Request::is('/')? 'active' : '') }} " href="{{route('reparations.index')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M413.5 237.5c-28.2 4.8-58.2-3.6-80-25.4l-38.1-38.1C280.4 159 272 138.8 272 117.6V105.5L192.3 62c-5.3-2.9-8.6-8.6-8.3-14.7s3.9-11.5 9.5-14l47.2-21C259.1 4.2 279 0 299.2 0h18.1c36.7 0 72 14 98.7 39.1l44.6 42c24.2 22.8 33.2 55.7 26.6 86L503 183l8-8c9.4-9.4 24.6-9.4 33.9 0l24 24c9.4 9.4 9.4 24.6 0 33.9l-88 88c-9.4 9.4-24.6 9.4-33.9 0l-24-24c-9.4-9.4-9.4-24.6 0-33.9l8-8-17.5-17.5zM27.4 377.1L260.9 182.6c3.5 4.9 7.5 9.6 11.8 14l38.1 38.1c6 6 12.4 11.2 19.2 15.7L134.9 484.6c-14.5 17.4-36 27.4-58.6 27.4C34.1 512 0 477.8 0 435.7c0-22.6 10.1-44.1 27.4-58.6z"/></svg>
            </div>
            <span class="nav-link-text ms-1">Repairs</span>
        </a>
      </li>
      <hr class="horizontal dark mt-0">
    </ul>
  </div>
</aside>