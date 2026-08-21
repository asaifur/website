<!-- JavaScript Libraries -->

<style>
    .floating-contact {
        position: fixed;
        left: 15px;
        bottom: 25px;
        z-index: 9999;

        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* tombol utama */
    .float-btn {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 50px;
        padding: 5px 12px 5px 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);

        text-decoration: none;
        transition: all .3s ease;
        animation: bounce 2s infinite;
    }

    /* icon */
    .float-btn img {
        width: 50px;
        height: auto;
    }

    /* label */
    .float-btn .label {
        margin-left: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    /* hover */
    .float-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    /* bounce animation */
    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-6px);
        }

        60% {
            transform: translateY(-3px);
        }
    }

    /* responsive */
    @media(max-width:768px) {

        .float-btn img {
            width: 45px;
        }

        .float-btn .label {
            display: none;
        }

    }
</style>

<div class="floating-contact">

    <!-- WhatsApp -->
    <a href="<?= $domain->wa_link; ?>"
        target="_blank"
        class="float-btn wa">

        <img src="https://www.naninukitchenset.com/wp-content/uploads/2022/08/to-icon-whatsapp.png">
        <span class="label">Chat WhatsApp</span>
    </a>

    <!-- Call -->
    <a href="tel:<?= $domain->telepon; ?>"
        class="float-btn call">

        <img src="https://www.naninukitchenset.com/wp-content/uploads/2022/08/to-icon-phone.png">
        <span class="label">Telepon Kami</span>
    </a>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/posify/') ?>lib/wow/wow.min.js"></script>
<script src="<?= base_url('assets/posify/') ?>lib/easing/easing.min.js"></script>
<script src="<?= base_url('assets/posify/') ?>lib/waypoints/waypoints.min.js"></script>
<script src="<?= base_url('assets/posify/') ?>lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/posify/') ?>lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="<?= base_url('assets/posify/') ?>js/main.js"></script>
</body>

</html>