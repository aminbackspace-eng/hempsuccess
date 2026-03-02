<style>
    /* ── Industries We Serve – Tabbed Layout ── */
    .home-ind-section {
        padding: 90px 0 100px;
        background: #fff;
    }

    .home-ind-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .home-ind-heading {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 700;
        color: #1A3C34;
        margin-bottom: 14px;
    }

    .home-ind-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Tab Pills */
    .home-ind-tabs {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-bottom: 44px;
    }

    .home-ind-tab {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 26px;
        border-radius: 999px;
        border: 1.5px solid #d1d5db;
        background: #fff;
        color: #374151;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
    }

    .home-ind-tab i {
        font-size: 1.05rem;
        color: #1A3C34;
    }

    .home-ind-tab:hover {
        border-color: #1A3C34;
        color: #1A3C34;
        background: #f0faf5;
    }

    .home-ind-tab.active {
        background: #1A3C34;
        border-color: #1A3C34;
        color: #fff;
        box-shadow: 0 4px 14px rgba(26, 60, 52, 0.25);
    }

    .home-ind-tab.active i {
        color: #A8D5BA;
    }

    /* Content Panels */
    .home-ind-panel {
        display: none;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        align-items: stretch;
        max-width: 1100px;
        margin: 0 auto;
    }

    .home-ind-panel.active {
        display: grid;
    }

    @media (max-width: 900px) {
        .home-ind-panel.active {
            grid-template-columns: 1fr;
        }
    }

    /* Image column */
    .home-ind-img-col {
        border-radius: 18px;
        overflow: hidden;
        min-height: 380px;
    }

    .home-ind-img-col img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Content card */
    .home-ind-content-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 44px 40px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .home-ind-icon-box {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        background: #e8f5ee;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 22px;
    }

    .home-ind-icon-box i {
        font-size: 1.5rem;
        color: #1A3C34;
    }

    .home-ind-content-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.65rem;
        font-weight: 700;
        color: #1A3C34;
        margin-bottom: 16px;
    }

    .home-ind-content-card p {
        font-size: 0.97rem;
        color: #374151;
        line-height: 1.8;
        margin-bottom: 28px;
    }

    .home-ind-features {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .home-ind-features li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.92rem;
        color: #374151;
        font-weight: 500;
    }

    .home-ind-features li i {
        color: #1A3C34;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    /* Free SEO Audit floating button */
    .home-ind-audit-btn {
        position: fixed;
        top: 90px;
        right: 28px;
        z-index: 200;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #D4AF37;
        color: #fff;
        padding: 12px 22px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 18px rgba(212, 175, 55, 0.35);
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .home-ind-audit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(212, 175, 55, 0.45);
    }

    @media (max-width: 768px) {
        .home-ind-content-card {
            padding: 30px 22px;
        }

        .home-ind-audit-btn {
            display: none;
        }
    }
</style>

<!-- Free SEO Audit floating button (visible while in this section area) -->
<a href="#audit" class="home-ind-audit-btn" id="home-ind-audit-btn">
    <i class="ri-file-search-line"></i> Free SEO Audit
</a>

<section class="home-ind-section" id="industries">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="home-ind-header">
            <h2 class="home-ind-heading">Industries We Serve</h2>
            <p class="home-ind-subtitle">Specialized Hemp SEO Agency expertise across all cannabis-related industries
            </p>
        </div>

        <!-- Tab Pills -->
        <div class="home-ind-tabs" role="tablist">
            <button class="home-ind-tab active" data-panel="ind-hemp" role="tab" aria-selected="true">
                <i class="ri-leaf-line"></i> Hemp Brands
            </button>
            <button class="home-ind-tab" data-panel="ind-cbd" role="tab" aria-selected="false">
                <i class="ri-store-2-line"></i> CBD Stores
            </button>
            <button class="home-ind-tab" data-panel="ind-dispensaries" role="tab" aria-selected="false">
                <i class="ri-building-2-line"></i> Dispensaries
            </button>
            <button class="home-ind-tab" data-panel="ind-vape" role="tab" aria-selected="false">
                <i class="ri-contrast-drop-2-line"></i> Vape Shops
            </button>
        </div>

        <!-- Hemp Brands Panel -->
        <div class="home-ind-panel active" id="ind-hemp" role="tabpanel">
            <div class="home-ind-img-col">
                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2070&auto=format&fit=crop"
                    alt="Hemp Brand SEO">
            </div>
            <div class="home-ind-content-card">
                <div class="home-ind-icon-box"><i class="ri-leaf-line"></i></div>
                <h3>Hemp Brands</h3>
                <p>SEO strategies for hemp clothing, supplements, and lifestyle brands. We build topical authority,
                    ensure full compliance with FDA and FTC guidelines, and help you dominate organic search results to
                    grow revenue sustainably.</p>
                <ul class="home-ind-features">
                    <li><i class="ri-checkbox-circle-fill"></i> Compliance-first content strategy &amp; copy</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Hemp-specific keyword research &amp; targeting</li>
                    <li><i class="ri-checkbox-circle-fill"></i> E-commerce SEO for product catalog growth</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Google algorithm sensitivity monitoring</li>
                </ul>
            </div>
        </div>

        <!-- CBD Stores Panel -->
        <div class="home-ind-panel" id="ind-cbd" role="tabpanel">
            <div class="home-ind-img-col">
                <img src="https://images.unsplash.com/photo-1581600140682-d4e68c8cde32?q=80&w=2070&auto=format&fit=crop"
                    alt="CBD Store SEO">
            </div>
            <div class="home-ind-content-card">
                <div class="home-ind-icon-box"><i class="ri-store-2-line"></i></div>
                <h3>CBD Stores</h3>
                <p>CBD ecommerce requires specialized SEO strategies that account for payment processing restrictions,
                    advertising limitations, and compliance requirements. Our Hemp SEO Agency has extensive experience
                    optimizing CBD stores for maximum organic visibility and revenue growth. We implement advanced
                    ecommerce SEO techniques including product schema markup, category optimization, internal linking
                    strategies, and conversion rate optimization tailored specifically for CBD retailers.</p>
                <ul class="home-ind-features">
                    <li><i class="ri-checkbox-circle-fill"></i> Schema markup &amp; product structured data</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Collection &amp; category page optimization</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Trust &amp; authority link building campaigns</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Conversion rate optimization for CBD buyers</li>
                </ul>
            </div>
        </div>

        <!-- Dispensaries Panel -->
        <div class="home-ind-panel" id="ind-dispensaries" role="tabpanel">
            <div class="home-ind-img-col">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop"
                    alt="Dispensary SEO">
            </div>
            <div class="home-ind-content-card">
                <div class="home-ind-icon-box"><i class="ri-building-2-line"></i></div>
                <h3>Dispensaries</h3>
                <p>Dispensaries depend on local foot traffic and Google Maps rankings. We specialize in local SEO
                    strategies that put your dispensary at the top of "near me" searches, Google Business Profile
                    optimization, and geo-targeted content that converts searchers into customers.</p>
                <ul class="home-ind-features">
                    <li><i class="ri-checkbox-circle-fill"></i> Google Business Profile optimization</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Local citation building &amp; NAP consistency</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Geo-targeted landing pages &amp; content</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Review generation &amp; reputation management</li>
                </ul>
            </div>
        </div>

        <!-- Vape Shops Panel -->
        <div class="home-ind-panel" id="ind-vape" role="tabpanel">
            <div class="home-ind-img-col">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop"
                    alt="Vape Shop SEO">
            </div>
            <div class="home-ind-content-card">
                <div class="home-ind-icon-box"><i class="ri-contrast-drop-2-line"></i></div>
                <h3>Vape Shops</h3>
                <p>Vape shops operate in one of the most volatile SEO landscapes. Our team provides algorithm-resistant
                    strategies that build stable rankings and drive consistent traffic to your vape store — both locally
                    and nationally — without risking platform penalties.</p>
                <ul class="home-ind-features">
                    <li><i class="ri-checkbox-circle-fill"></i> Age-gate optimization &amp; UX compliance</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Device &amp; e-liquid product page SEO</li>
                    <li><i class="ri-checkbox-circle-fill"></i> SERP volatility monitoring &amp; recovery</li>
                    <li><i class="ri-checkbox-circle-fill"></i> Brand authority building through content</li>
                </ul>
            </div>
        </div>

    </div>
</section>

<script>
    (function () {
        var tabs = document.querySelectorAll('.home-ind-tab');
        var panels = document.querySelectorAll('.home-ind-panel');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) {
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                panels.forEach(function (p) { p.classList.remove('active'); });

                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');

                var panelId = tab.getAttribute('data-panel');
                var panel = document.getElementById(panelId);
                if (panel) panel.classList.add('active');
            });
        });

        // Auto-hide the floating audit button when scrolled away from this section
        var section = document.getElementById('industries');
        var auditBtn = document.getElementById('home-ind-audit-btn');
        if (section && auditBtn) {
            function checkVisibility() {
                var rect = section.getBoundingClientRect();
                var inView = rect.top < window.innerHeight && rect.bottom > 0;
                auditBtn.style.display = inView ? 'inline-flex' : 'none';
            }
            window.addEventListener('scroll', checkVisibility, { passive: true });
            checkVisibility();
        }
    })();
</script>