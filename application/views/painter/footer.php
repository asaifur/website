<!-- Floating Contact Start -->
<div class="floating-contact">
    <!-- WhatsApp -->
    <?php if (!empty($domain->wa_link)) : ?>
        <a href="<?= $domain->wa_link; ?>" target="_blank" class="float-btn wa">
            <img src="<?= base_url('assets/uploads/img/fd14d9811e056a03b44e7c3e043b2476.png'); ?>" alt="WhatsApp">
        </a>
    <?php endif; ?>

    <!-- Call -->
    <?php if (!empty($domain->telepon)) : ?>
        <a href="tel:<?= $domain->telepon; ?>" class="float-btn call">
            <img src="<?= base_url('assets/uploads/img/b06f39c95463db9183a5d3fa912777ee.png'); ?>" alt="Telepon">
        </a>
    <?php endif; ?>
</div>
<!-- Floating Contact End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/painter/lib/easing/easing.min.js'); ?>"></script>
<script src="<?= base_url('assets/painter/lib/waypoints/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/painter/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>

<!-- Template Javascript -->
<script src="<?= base_url('assets/painter/js/main.js'); ?>"></script>

<!-- Typing Effect Script -->
<script>
    const texts = [
        "Instalasi Ducting Exhaust Dapur Restoran",
        "Dan Manfaat Penggunaan Instalasi Ducting Exhaust"
    ];

    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typingElement = document.getElementById("typing-text");

    if (typingElement) {
        function typeEffect() {
            const currentText = texts[textIndex];

            if (!isDeleting) {
                typingElement.textContent = currentText.substring(0, charIndex + 1);
                charIndex++;

                if (charIndex === currentText.length) {
                    setTimeout(() => isDeleting = true, 1500);
                }
            } else {
                typingElement.textContent = currentText.substring(0, charIndex - 1);
                charIndex--;

                if (charIndex === 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length;
                }
            }

            setTimeout(typeEffect, isDeleting ? 40 : 80);
        }

        typeEffect();
    }
</script>
</body>

</html>