@vite(['resources/js/navbar.js', 'resources/css/styles2.css'])

<nav class="navbar">
    <div class="logo-container">
      <a href="/" class="logo">
        <img src="/images/RC_logo.jpg" alt="Russ Cuevas Logo">
      </a>
    </div>

    <div class="nav-right">
      <div class="dropdown-wrapper">
        <button class="gallery-btn">Gallery</button>
        <ul class="luxury-dropdown" id="galleryDropdown">
          <li onclick="loadGallery('Wedding Gown')">Wedding Gown</li>
          <li onclick="loadGallery('Evening Gown')">Evening Wear</li>
          <li onclick="loadGallery('Prom')">Prom Collections</li>
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
            <img src="/img/user.png" alt="User Profile" width="22" height="22" class="user-icon-img" style="display:block; object-fit:contain;">
          </a>
          <div class="dropdown-content" style="position: absolute; top: 100%; right: 0; left: auto;">
            <ul class="dropdown-menu" id="loginDropdown" style="display: none;">
              @guest
              <a href="/login"><li>Log In</li></a>
              <a href="/signup"><li>Sign Up</li></a>
              @else
              <li style="padding: 10px 20px; font-weight: 600; font-size: 0.7rem; border-bottom: 1px solid #eee;">{{ auth()->user()->name }}</li>
              <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer; padding: 10px 20px;">Log Out</li>
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

<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
<script>
  function mpSmoothScroll(id) {
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
            authMenu.innerHTML = `
                <li style="padding: 10px 20px; font-weight: 600; font-size: 0.7rem; border-bottom: 1px solid #eee; white-space: nowrap;">${userName}</li>
                <li id="supabase-logout-btn" style="cursor: pointer; padding: 10px 20px; font-size: 0.8rem;">Log Out</li>
            `;
            
            document.getElementById('supabase-logout-btn').addEventListener('click', async () => {
                await supabaseClient.auth.signOut();
                window.location.reload();
            });
        }
    }
  });
</script>