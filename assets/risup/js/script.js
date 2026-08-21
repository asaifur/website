// RisUp Kitchen JavaScript

// Simple carousel for products
class RisupCarousel {
    constructor(container, items) {
        this.container = container;
        this.items = items;
        this.currentIndex = 0;
        this.init();
    }

    init() {
        this.showItem(this.currentIndex);
        this.createControls();
    }

    showItem(index) {
        this.items.forEach((item, i) => {
            item.style.display = i === index ? 'block' : 'none';
        });
    }

    createControls() {
        const prevBtn = document.createElement('button');
        prevBtn.textContent = 'Previous';
        prevBtn.addEventListener('click', () => this.prev());

        const nextBtn = document.createElement('button');
        nextBtn.textContent = 'Next';
        nextBtn.addEventListener('click', () => this.next());

        this.container.appendChild(prevBtn);
        this.container.appendChild(nextBtn);
    }

    next() {
        this.currentIndex = (this.currentIndex + 1) % this.items.length;
        this.showItem(this.currentIndex);
    }

    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
        this.showItem(this.currentIndex);
    }
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize product carousel if exists
    const productContainer = document.querySelector('.risup-product-carousel');
    if (productContainer) {
        const items = productContainer.querySelectorAll('.risup-product-item');
        new RisupCarousel(productContainer, items);
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Mobile menu toggle
    const menuToggle = document.querySelector('.risup-menu-toggle');
    const menu = document.querySelector('.risup-menu');
    if (menuToggle && menu) {
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    }
});