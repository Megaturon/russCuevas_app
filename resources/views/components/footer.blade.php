<footer class="site-footer">
    <div class="footer-container">
        <!-- Brand Section -->
        <div class="footer-brand">
            <h2>Russ Cuevas</h2>
            <p>A premier couture artelier in Manila, dedicated to exquisite craftsmanship and the timeless beauty of bespoke fashion.</p>
            <div class="footer-social-wrap">
                <a href="https://www.facebook.com/russcuevascouture" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/russcuevas/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@russcuevas" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="javascript:void(0)" onclick="openStoreMapModal()" aria-label="Store Location"><i class="fas fa-location-dot"></i></a>
            </div>
        </div>

        <!-- Collections Section -->
        <div class="footer-column">
            <h3>Collections</h3>
            <ul class="footer-links-list">
                <li><a href="javascript:void(0)" onclick="mpSmoothScroll('wedding-dresses')">Wedding Dresses</a></li>
                <li><a href="javascript:void(0)" onclick="mpSmoothScroll('evening-gowns')">Evening Gowns</a></li>
                <li><a href="javascript:void(0)" onclick="mpSmoothScroll('prom-dresses')">Prom Collections</a></li>
                <li><a href="javascript:void(0)" onclick="mpSmoothScroll('filipiniana-section')">Filipiniana</a></li>
            </ul>
        </div>

        <!-- Information Section -->
        <div class="footer-column">
            <h3>Information</h3>
            <ul class="footer-links-list">
                <li><a href="/our-story">Our Story</a></li>
                <li><a href="/faq">Common Questions</a></li>
                <li><a href="/privacy">Privacy Policy</a></li>
                <li><a href="/terms">Terms & Conditions</a></li>
            </ul>
        </div>

        <!-- Contact Section -->
        <div class="footer-column">
            <h3>Contact</h3>
            <div class="footer-contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>53 B 1600 P.Visitacion, <br> Pasig, NCR, Philippines</span>
            </div>
            <div class="footer-contact-item">
                <i class="fas fa-clock"></i>
                <span>Mon - Sat: 9AM - 7PM<br>Strictly by Appointment</span>
            </div>
        </div>
    </div>

    <div class="footer-bottom-bar">
        <p>&copy; 2025 Russ Cuevas Artelier. All Rights Reserved.</p>
        <p>Crafted in Manila</p>
    </div>
</footer>

<div id="store-map-modal" style="display: none; position: fixed; inset: 0; z-index: 10000; background: rgba(0, 0, 0, 0.65); align-items: center; justify-content: center; padding: 20px;">
    <div style="position: relative; width: 100%; max-width: 900px; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.35);">
        <button type="button" onclick="closeStoreMapModal()" aria-label="Close map" style="position: absolute; top: 10px; right: 10px; width: 36px; height: 36px; border: none; border-radius: 50%; background: rgba(0,0,0,0.75); color: #fff; font-size: 1rem; cursor: pointer; z-index: 2;">
            <i class="fas fa-times"></i>
        </button>
        <iframe
            title="Russ Cuevas Artelier Location"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.36368075987562!2d121.08210183879862!3d14.552347061378297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c713ef8186d7%3A0x64829e7c2a21e6e5!2sRuss%20Cuevas%20Couture!5e0!3m2!1sfil!2sph!4v1779469796565!5m2!1sfil!2sph"
            width="100%"
            height="500"
            style="border: 0; display: block;"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen>
        </iframe>
    </div>
</div>

<script>
    function openStoreMapModal() {
        var modal = document.getElementById('store-map-modal');
        if (!modal) return;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeStoreMapModal() {
        var modal = document.getElementById('store-map-modal');
        if (!modal) return;
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('click', function (event) {
        var modal = document.getElementById('store-map-modal');
        if (!modal || modal.style.display === 'none') return;
        if (event.target === modal) closeStoreMapModal();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeStoreMapModal();
    });
</script>
