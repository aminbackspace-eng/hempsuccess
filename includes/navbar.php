<?php
// Fetch services for mega menu
$services_menu = [];
if (file_exists(__DIR__ . '/../config/db.php')) {
    include_once __DIR__ . '/../config/db.php';
    if (isset($pdo)) {
        try {
            // Rename "Ecommerce SEO for CBD Stores" → "Vape SEO Services" in the DB
            $pdo->exec("
                UPDATE services
                SET title = 'Vape SEO Services',
                    link  = 'services.php'
                WHERE title = 'Ecommerce SEO for CBD Stores'
                   OR title = 'Ecommerce SEO for CBD'
                   OR title = 'Vape SEO Services'
                LIMIT 1
            ");
            $stmt = $pdo->query("SELECT title, link FROM services ORDER BY created_at ASC LIMIT 8");
            if ($stmt) {
                $services_menu = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            // Silently fail
        }
    }
}

// Fallback services if database is empty
if (empty($services_menu)) {
    $services_menu = [
        ['title' => 'Hemp & CBD SEO Services', 'link' => 'hemp_seo_service.php'],
        ['title' => 'Cannabis SEO', 'link' => '#cannabis-seo'],
        ['title' => 'Vape SEO Services', 'link' => 'services.php'],
        ['title' => 'Local SEO for Dispensaries', 'link' => '#local-seo'],
        ['title' => 'Google Ads for CBD', 'link' => '#google-ads'],
        ['title' => 'Technical SEO & CRO', 'link' => '#technical-seo'],
        ['title' => 'Link Building for Hemp', 'link' => '#link-building']
    ];
}
?>
<style>
    .mega-menu-dropdown {
        visibility: hidden;
        position: absolute;
        left: 0;
        top: 100%;
        margin-top: 0.5rem;
        width: 16rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        z-index: 9999;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1),
            transform 0.8s cubic-bezier(0.22, 1, 0.36, 1),
            visibility 0.8s;
        pointer-events: none;
    }

    .mega-menu-dropdown.active {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .mega-menu-item {
        transition: all 0.3s ease;
    }

    .mega-menu-item:hover {
        background-color: rgba(168, 213, 186, 0.1);
        color: #1A3C34;
        padding-left: 1.75rem;
    }

    /* Ensure dropdown parent has relative positioning */
    .mega-menu-parent {
        position: relative;
    }

    @media (min-width: 1024px) {
        .mega-menu-parent:hover .mega-menu-dropdown {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .mega-menu-parent:hover #services-menu-btn,
        .mega-menu-parent:hover #industries-menu-btn {
            color: #A8D5BA;
        }
    }
</style>

<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-[#1A3C34] shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex-shrink-0">
                <a href="index.php" class="flex items-center cursor-pointer">
                    <span class="text-2xl font-bold text-white font-['Playfair_Display']">Hemp<span
                            class="text-[#A8D5BA]">Success</span></span>
                </a>
            </div>
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="index.php"
                    class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">HOME</a>

                <!-- Services Mega Menu -->
                <div class="relative mega-menu-parent h-full flex items-center">
                    <a href="services.php" id="services-menu-btn"
                        class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA] flex items-center h-full">
                        SERVICES
                        <?php if (!isset($hide_mega_menu) || !$hide_mega_menu): ?>
                            <i class="ri-arrow-down-s-line ml-1"></i>
                        <?php endif; ?>
                    </a>

                    <!-- Mega Menu Dropdown -->
                    <?php if (!isset($hide_mega_menu) || !$hide_mega_menu): ?>
                        <div id="services-dropdown" class="mega-menu-dropdown">
                            <div class="py-4">
                                <a href="services.php"
                                    class="mega-menu-item block px-6 py-3 text-[#1A3C34] bg-gray-50 transition-colors font-bold border-b border-gray-100 italic">
                                    VIEW ALL SERVICES <i class="ri-arrow-right-line ml-1"></i>
                                </a>
                                <?php foreach ($services_menu as $service): ?>
                                    <a href="<?php echo htmlspecialchars((strpos($service['link'], '#') === 0 ? 'index.php' : '') . ($service['link'] ?? '#services')); ?>"
                                        class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">
                                        <?php echo htmlspecialchars($service['title']); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Industries Mega Menu -->
                <div class="relative mega-menu-parent">
                    <?php if (!isset($hide_mega_menu) || !$hide_mega_menu): ?>
                        <button id="industries-menu-btn"
                            class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA] flex items-center">
                            INDUSTRIES
                            <i class="ri-arrow-down-s-line ml-1"></i>
                        </button>

                        <!-- Industries Dropdown -->
                        <div id="industries-dropdown" class="mega-menu-dropdown">
                            <div class="py-4">
                                <a href="#hemp"
                                    class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">Hemp
                                    Brands</a>
                                <a href="#cbd"
                                    class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">CBD
                                    Stores</a>
                                <a href="#cannabis"
                                    class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">Cannabis
                                    Dispensaries</a>
                                <a href="#vape"
                                    class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">Vape
                                    Shops</a>
                                <a href="#wellness"
                                    class="mega-menu-item block px-6 py-3 text-gray-700 transition-colors font-medium">Wellness
                                    Brands</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="index.php#industries"
                            class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">INDUSTRIES</a>
                    <?php endif; ?>
                </div>

                <a href="#case-studies"
                    class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">CASE
                    STUDIES</a>
                <a href="#resources"
                    class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">RESOURCES</a>
                <a href="#about"
                    class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">ABOUT</a>
                <a href="#contact"
                    class="font-medium transition-colors cursor-pointer whitespace-nowrap text-white hover:text-[#A8D5BA]">CONTACT</a>
                <a href="#audit"
                    class="bg-[#D4AF37] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#C19B2E] transition-all hover:shadow-lg cursor-pointer whitespace-nowrap">Get
                    Free SEO Audit</a>
            </nav>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-2xl cursor-pointer text-white">
                <i class="ri-menu-line"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
        class="hidden lg:hidden bg-[#1A3C34] absolute w-full left-0 top-20 border-t border-[#A8D5BA]/20 shadow-xl">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="index.php" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">HOME</a>

            <!-- Mobile Services Accordion -->
            <div>
                <?php if (!isset($hide_mega_menu) || !$hide_mega_menu): ?>
                    <button id="mobile-services-btn"
                        class="w-full text-left px-3 py-2 text-white hover:text-[#A8D5BA] font-medium flex items-center justify-between">
                        SERVICES
                        <i class="ri-arrow-down-s-line"></i>
                    </button>
                    <div id="mobile-services-menu" class="hidden pl-6 space-y-1">
                        <a href="services.php" class="block px-3 py-2 text-[#A8D5BA] font-bold text-sm">
                            VIEW ALL SERVICES <i class="ri-arrow-right-line ml-1"></i>
                        </a>
                        <?php foreach ($services_menu as $service): ?>
                            <a href="<?php echo htmlspecialchars((strpos($service['link'], '#') === 0 ? 'index.php' : '') . ($service['link'] ?? '#services')); ?>"
                                class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">
                                <?php echo htmlspecialchars($service['title']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <a href="services.php" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">SERVICES</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Industries Accordion -->
            <div>
                <?php if (!isset($hide_mega_menu) || !$hide_mega_menu): ?>
                    <button id="mobile-industries-btn"
                        class="w-full text-left px-3 py-2 text-white hover:text-[#A8D5BA] font-medium flex items-center justify-between">
                        INDUSTRIES
                        <i class="ri-arrow-down-s-line"></i>
                    </button>
                    <div id="mobile-industries-menu" class="hidden pl-6 space-y-1">
                        <a href="#hemp" class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">Hemp Brands</a>
                        <a href="#cbd" class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">CBD Stores</a>
                        <a href="#cannabis" class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">Cannabis
                            Dispensaries</a>
                        <a href="#vape" class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">Vape Shops</a>
                        <a href="#wellness" class="block px-3 py-2 text-white/80 hover:text-[#A8D5BA] text-sm">Wellness
                            Brands</a>
                    </div>
                <?php else: ?>
                    <a href="index.php#industries"
                        class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">INDUSTRIES</a>
                <?php endif; ?>
            </div>

            <a href="#case-studies" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">CASE STUDIES</a>
            <a href="#resources" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">RESOURCES</a>
            <a href="#about" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">ABOUT</a>
            <a href="#contact" class="block px-3 py-2 text-white hover:text-[#A8D5BA] font-medium">CONTACT</a>
            <a href="#audit" class="block px-3 py-2 text-[#D4AF37] font-bold">Get Free Audit</a>
        </div>
    </div>

    <script>
        // Desktop mega menu toggles
        const servicesBtn = document.getElementById('services-menu-btn');
        const servicesDropdown = document.getElementById('services-dropdown');
        const industriesBtn = document.getElementById('industries-menu-btn');
        const industriesDropdown = document.getElementById('industries-dropdown');

        // Toggle services dropdown
        if (servicesBtn && servicesDropdown) {
            servicesBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                servicesDropdown.classList.toggle('active');
                if (industriesDropdown) industriesDropdown.classList.remove('active');
            });
        }

        // Toggle industries dropdown
        if (industriesBtn && industriesDropdown) {
            industriesBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                industriesDropdown.classList.toggle('active');
                if (servicesDropdown) servicesDropdown.classList.remove('active');
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function (e) {
            if (servicesBtn && servicesDropdown && !servicesBtn.contains(e.target) && !servicesDropdown.contains(e.target)) {
                servicesDropdown.classList.remove('active');
            }
            if (industriesBtn && industriesDropdown && !industriesBtn.contains(e.target) && !industriesDropdown.contains(e.target)) {
                industriesDropdown.classList.remove('active');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Mobile services accordion
        const mobileServicesBtn = document.getElementById('mobile-services-btn');
        if (mobileServicesBtn) {
            mobileServicesBtn.addEventListener('click', function () {
                const menu = document.getElementById('mobile-services-menu');
                menu.classList.toggle('hidden');
            });
        }

        // Mobile industries accordion
        const mobileIndustriesBtn = document.getElementById('mobile-industries-btn');
        if (mobileIndustriesBtn) {
            mobileIndustriesBtn.addEventListener('click', function () {
                const menu = document.getElementById('mobile-industries-menu');
                menu.classList.toggle('hidden');
            });
        }
    </script>
</header>