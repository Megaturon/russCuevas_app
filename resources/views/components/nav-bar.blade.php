@vite(['resources/js/navbar.js', 'resources/css/styles2.css'])

<nav class="navbar">
    <div class="logo-container">
      <a href="/" class="logo">
        <img src="/images/RC_logo.jpg" alt="Russ Cuevas luxury fashion brand logo, returning to homepage">
      </a>
    </div>

    <div class="nav-right">
      <div class="dropdown-wrapper">
        <button class="gallery-btn">Gallery</button>
        <ul class="luxury-dropdown" id="galleryDropdown">
          <li onclick="mpSmoothScroll('wedding-dresses')">Wedding Gown</li>
          <li onclick="mpSmoothScroll('evening-gowns')">Evening Wear</li>
          <li onclick="mpSmoothScroll('prom-dresses')">Prom Collections</li>
          <li onclick="mpSmoothScroll('filipiniana-section')">Filipiniana</li>
        </ul>
      </div>
      <div class="dropdown-wrapper">
        <button class="about-btn">About Us</button>
        <ul class="luxury-dropdown" id="aboutDropdown">
          <li onclick="location.href='/our-story'">Our Story</li>
          <li onclick="location.href='/faq'">FAQ</li>
          <li onclick="location.href='/terms'">Terms & Conditions</li>
        </ul>
      </div>
      <a href="/faq">Learn</a>
      <a href="{{ route('quote.index') }}" class="quote-link">Get a Quote</a>
      <a href="{{ route('appointments.index') }}" class="book-btn-nav">Book Now</a>

      <div class="icons">
        <div class="dropdown" style="position: relative;">
          <a class="login-btn" style="display:flex; align-items:center; justify-content:center; cursor:pointer;">
            @guest
                <img src="/img/user.png" alt="User Profile" class="user-icon-img" style="display: block; width: 35px; height: 35px; min-width: 35px; object-fit: contain;">            @else
              @php
                $nameParts = explode(' ', auth()->user()->name);
                $initials = strtoupper(substr($nameParts[0], 0, 1));
                if (count($nameParts) > 1) {
                    $initials .= strtoupper(substr(end($nameParts), 0, 1));
                }
              @endphp
              <div style="width: 32px; height: 32px; border-radius: 50%; background-color: var(--black, #000); color: var(--white, #fff); display: flex; align-items: center; justify-content: center; font-size: 0.85rem; font-weight: 600; font-family: var(--font-inter, sans-serif); letter-spacing: 1px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                {{ $initials }}
              </div>
            @endguest
          </a>
          <div class="dropdown-content">
            <ul class="user-dropdown-luxury" id="loginDropdown" style="display: none;">
              @guest
              <a href="/login"><li>Log In</li></a>
              <a href="/signup"><li>Sign Up</li></a>
              @else
              <li class="user-name-header" style="font-size: 0.75rem; color: var(--grey); cursor: default; pointer-events: none; padding-bottom: 5px;">HELLO, {{ strtoupper(auth()->user()->name) }}</li>
              <a href="{{ route('portal.appointments') }}"><li>My Appointments</li></a>
              <a href="{{ route('portal.quotes') }}"><li>My Quotes</li></a>
              <a href="{{ route('portal.receipts') }}"><li>To Review</li></a>
              <hr style="border: 0; border-top: 1px solid var(--grey-border); margin: 5px 0;">
              @if(auth()->user()->is_admin)
              <a href="/admin"><li>Admin Dashboard</li></a>
              @endif
              <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              @endguest
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="menu-toggle" id="mobile-menu">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
</nav>

@if(session('success') && str_contains(session('success'), 'Welcome back'))
<div id="welcome-toast" style="position: fixed; top: 100px; right: 30px; background: rgba(255, 255, 255, 0.5); ; color: #000000; padding: 18px 28px; z-index: 10000; font-family: var(--font-inter, sans-serif); font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 500; display: flex; align-items: center; gap: 14px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); border: 1px solid #eaeaea; opacity: 0; transform: translateY(-20px); transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);">
    <i class="fas fa-check" style="color: #000; font-size: 0.85rem;"></i> <span>{{ session('success') }}</span>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('welcome-toast');
        if (toast) {
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            }, 100);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-20px)';
                setTimeout(() => toast.remove(), 400);
            }, 4000);
        }
    });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script>
  function mpSmoothScroll(id) {
    // Close any open luxury dropdowns
    document.querySelectorAll('.luxury-dropdown').forEach(d => d.style.display = 'none');
    
    const isHome = window.location.pathname === '/' || window.location.pathname === '/index.php' || window.location.pathname.endsWith('main-page');
    if (isHome) {
      const el = document.getElementById(id);
      if (el) {
        el.scrollIntoView({ behavior: 'smooth' });
        return;
      }
    }
    window.location.href = '/#' + id;
  }

  document.addEventListener('DOMContentLoaded', async function() {
    const supabaseUrl = '{{ env('SUPABASE_URL') }}';
    const supabaseKey = '{{ env('SUPABASE_KEY') }}';
    if (!supabaseUrl || !supabaseKey) return;
    
    const supabaseClient = window.supabase.createClient(supabaseUrl, supabaseKey);

    const { data: { session } } = await supabaseClient.auth.getSession();
    const authMenu = document.getElementById('loginDropdown');

    if (session && session.user) {
        if (window.location.hash.includes('access_token')) {
            window.history.replaceState(null, null, window.location.pathname + window.location.search);
        }

        const userName = session.user.user_metadata?.full_name || session.user.email;
        
        if (authMenu) {
            const isAdmin = session.user.user_metadata?.role === 'admin' || session.user.email === 'admin@russcuevas.com';
            authMenu.innerHTML = `
                <li class="user-name-header" style="font-size: 0.75rem; color: var(--grey); cursor: default; pointer-events: none; padding-bottom: 5px;">HELLO, ${userName.toUpperCase()}</li>
                <a href="/portal/appointments"><li>My Appointments</li></a>
                <a href="/portal/quotes"><li>My Quotes</li></a>
                <a href="/portal/receipts"><li>My Receipts</li></a>
                <hr style="border: 0; border-top: 1px solid var(--grey-border); margin: 5px 0;">
                ${isAdmin ? `<a href="/admin"><li>Admin Dashboard</li></a>` : ''}
                <li id="supabase-logout-btn">Log Out</li>
            `;
            
            document.getElementById('supabase-logout-btn').addEventListener('click', async () => {
                await supabaseClient.auth.signOut();
                window.location.reload();
            });
        }
    }
  });
</script>