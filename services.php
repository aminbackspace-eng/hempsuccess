<?php
require_once __DIR__ . '/config/db.php';
include 'includes/header.php';
$hide_mega_menu = false;
include 'includes/navbar.php';

// Fetch all services from database
$services = [];
try {
    $stmt = $pdo->query("SELECT * FROM services ORDER BY created_at ASC");
    $services = $stmt->fetchAll();
} catch (Exception $e) {
}

// Fetch testimonials from database
$testimonials = [];
try {
    $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY id DESC LIMIT 3");
    $testimonials = $stmt->fetchAll();
} catch (Exception $e) {
}
// Fetch FAQs from database
$faqs_list = [];
try {
    $stmt = $pdo->query("SELECT * FROM faqs ORDER BY id ASC");
    $faqs_list = $stmt->fetchAll();
} catch (Exception $e) {
}
?>

<div class="min-h-screen bg-[#F5F3EE] pt-20">
    <!-- Hero Section -->
    <section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img alt="Vape SEO Marketing Team" class="w-full h-full object-cover object-top"
                src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/60"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 text-center w-full">
            <h1 class="font-['Playfair_Display'] text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">Vape SEO
                Agency for<br>Sustainable Organic Growth</h1>
            <p class="text-xl md:text-2xl text-[#D4AF37] font-medium mb-8">Compliance-Focused SEO for Vape &amp;
                E-Cigarette Brands</p>
            <div class="max-w-3xl mx-auto mb-10">
                <p class="text-base md:text-lg text-white/90 leading-relaxed">The vape industry faces unique digital
                    marketing challenges—strict FDA regulations, Google Ads restrictions, and algorithm sensitivities
                    make traditional advertising nearly impossible. For vape and e-cigarette brands, organic search
                    isn't just a channel—it's the primary growth engine. Our specialized vape SEO agency navigates these
                    complexities to deliver compliant, sustainable rankings.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#audit"
                    class="bg-[#D4AF37] text-[#1A1A1A] px-8 py-4 rounded-lg text-base font-bold hover:bg-[#C49F2F] transition-all hover:scale-105 whitespace-nowrap cursor-pointer shadow-lg">Get
                    Free Vape SEO Audit</a>
                <a href="#contact"
                    class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-lg text-base font-bold hover:bg-white hover:text-[#1F4D45] transition-all whitespace-nowrap cursor-pointer">Schedule
                    Strategy Call</a>
            </div>
            <div class="mt-12 flex items-center justify-center gap-8 text-white/80 text-sm">
                <div class="flex items-center gap-2"><i
                        class="ri-shield-check-line text-[#D4AF37] text-xl"></i><span>FDA Compliant</span></div>
                <div class="flex items-center gap-2"><i
                        class="ri-line-chart-line text-[#D4AF37] text-xl"></i><span>Proven Results</span></div>
                <div class="flex items-center gap-2"><i class="ri-award-line text-[#D4AF37] text-xl"></i><span>Industry
                        Experts</span></div>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section id="expertise" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">
                    Industry-Specific Vape SEO Expertise</h2>
                <div class="max-w-4xl mx-auto">
                    <p class="text-base md:text-lg text-[#1A1A1A] leading-relaxed mb-6">The vape and e-cigarette
                        industry operates under unprecedented digital marketing constraints. <strong>FDA
                            regulations</strong> mandate strict content guidelines around health claims and product
                        descriptions. <strong>Age-restriction requirements</strong> complicate user experience and
                        conversion paths. <strong>Google Ads limitations</strong> and platform advertising bans
                        eliminate traditional paid acquisition channels, making organic search the only viable
                        scalability lever for vape brands.</p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-[#F5F3EE] p-8 rounded-xl border-l-4 border-[#D4AF37]">
                    <div class="w-14 h-14 flex items-center justify-center bg-[#1F4D45] rounded-lg mb-4"><i
                            class="ri-alert-line text-[#D4AF37] text-2xl"></i></div>
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Why Generic SEO
                        Agencies Fail</h3>
                    <ul class="space-y-3 text-[#1A1A1A]">
                        <li class="flex items-start gap-3"><i
                                class="ri-close-circle-line text-red-500 text-xl mt-0.5 flex-shrink-0"></i><span><strong>No
                                    compliance expertise</strong> – Risk of FDA violations and content penalties</span>
                        </li>
                        <li class="flex items-start gap-3"><i
                                class="ri-close-circle-line text-red-500 text-xl mt-0.5 flex-shrink-0"></i><span><strong>Generic
                                    keyword strategies</strong> – Miss high-intent, compliant search terms</span></li>
                        <li class="flex items-start gap-3"><i
                                class="ri-close-circle-line text-red-500 text-xl mt-0.5 flex-shrink-0"></i><span><strong>Ignorance
                                    of SERP volatility</strong> – Vape keywords face unique algorithm sensitivity</span>
                        </li>
                        <li class="flex items-start gap-3"><i
                                class="ri-close-circle-line text-red-500 text-xl mt-0.5 flex-shrink-0"></i><span><strong>Cookie-cutter
                                    content</strong> – Fails to build topical authority in regulated niches</span>
                        </li>
                        <li class="flex items-start gap-3"><i
                                class="ri-close-circle-line text-red-500 text-xl mt-0.5 flex-shrink-0"></i><span><strong>No
                                    age-gate optimization</strong> – Conversion rate killers that hurt rankings</span>
                        </li>
                    </ul>
                </div>
                <div class="space-y-6">
                    <div class="bg-gradient-to-br from-[#1F4D45] to-[#2F5E57] p-8 rounded-xl text-white">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#D4AF37] rounded-lg mb-4"><i
                                class="ri-search-eye-line text-[#1F4D45] text-2xl"></i></div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold mb-3">Google Algorithm Sensitivity</h3>
                        <p class="text-white/90 leading-relaxed">Vape-related search terms trigger heightened scrutiny
                            from Google's YMYL (Your Money Your Life) algorithms. SERP volatility is 3x higher than
                            standard e-commerce. Our vape SEO agency monitors algorithm updates specific to regulated
                            industries and adjusts strategies proactively to maintain stable rankings.</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#1F4D45] to-[#2F5E57] p-8 rounded-xl text-white">
                        <div
                            class="w-14 h-14 flex items-center justify-center bg-[#D4AF37] rounded-lg mb-4 text-[#1F4D45] font-bold text-xl uppercase">
                            Ad
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold mb-3">Advertising Restrictions</h3>
                        <ul class="space-y-3 text-white/90">
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Google Ads bans all
                                    vape and e-cigarette promotions</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Facebook/Instagram
                                    prohibit vape product advertising</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>TikTok, Snapchat,
                                    and YouTube enforce strict bans</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Affiliate networks
                                    limit vape merchant participation</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Compliance Risks Box -->
            <div class="mt-12 bg-[#FFFBEB] border border-[#D4AF37]/50 rounded-2xl p-8 shadow-sm">
                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div
                        class="w-12 h-12 bg-[#D4AF37] rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <i class="ri-shield-check-line text-[#1F4D45] text-2xl font-bold"></i>
                    </div>
                    <div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-3">Compliance Risks
                        </h3>
                        <p class="text-[#1A1A1A] text-base leading-relaxed">
                            Non-compliant SEO content can trigger <strong class="text-red-700 font-bold">FDA warning
                                letters</strong>, platform penalties, and even legal action. Product descriptions must
                            avoid therapeutic claims, health benefits, or smoking cessation language. Our vape SEO
                            strategies prioritize regulatory compliance while maximizing organic visibility—protecting
                            your brand reputation and ensuring long-term ranking stability without risking violations.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategy / Services Section -->
    <section id="strategy" class="py-20 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Our Services &
                    Strategy</h2>
                <p class="text-lg text-[#1A1A1A] max-w-3xl mx-auto">A comprehensive, compliance-first approach to
                    sustainable organic growth for hemp and vape brands.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <div
                            class="bg-white p-8 rounded-xl shadow-sm hover:shadow-lg transition-all border border-gray-100 hover:-translate-y-1">
                            <div class="w-14 h-14 flex items-center justify-center bg-[#1F4D45] rounded-lg mb-4">
                                <i
                                    class="<?php echo htmlspecialchars($service['icon'] ?? 'ri-search-line'); ?> text-[#D4AF37] text-2xl"></i>
                            </div>
                            <h3 class="font-['Playfair_Display'] text-xl font-bold text-[#1F4D45] mb-3">
                                <?php echo htmlspecialchars($service['title']); ?>
                            </h3>
                            <p class="text-[#1A1A1A] text-sm leading-relaxed mb-3">
                                <?php echo htmlspecialchars($service['description']); ?>
                            </p>
                            <?php if (!empty($service['link'])): ?>
                                <a href="<?php echo htmlspecialchars($service['link']); ?>"
                                    class="text-[#D4AF37] font-semibold flex items-center gap-1 hover:gap-2 transition-all">Learn
                                    More <i class="ri-arrow-right-line"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Fallback content if no services in DB -->
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                        <div class="w-14 h-14 flex items-center justify-center bg-[#1F4D45] rounded-lg mb-4"><i
                                class="ri-file-list-3-line text-[#D4AF37] text-2xl"></i></div>
                        <h3 class="font-['Playfair_Display'] text-xl font-bold text-[#1F4D45] mb-3">Compliance Audit</h3>
                        <p class="text-[#1A1A1A] text-sm leading-relaxed mb-3">Comprehensive compliance audit of your
                            content and meta data.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Keyword Research Section -->
    <section id="keyword-research" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Vape Keyword
                    Research Process</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Strategic keyword targeting that balances search
                    volume, commercial intent, and regulatory compliance</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Vape Device Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Vape Device Keywords
                    </h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">High-intent product searches with strong
                        commercial value. Focus on specific device types, brands, and technical specifications.</p>

                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">best pod system 2025</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <!-- Item 2 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">refillable vape pen</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <!-- Item 3 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">sub ohm tank comparison</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- E-Liquid & Flavor Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">E-Liquid & Flavor
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Product-focused searches with immediate
                        purchase intent. Emphasize flavor profiles, nicotine strengths, and brand-specific queries.</p>

                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">salt nicotine e-juice</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <!-- Item 2 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">tobacco flavor vape liquid</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <!-- Item 3 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">best menthol e-liquid brands</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>
                <!-- Educational & How-To Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Educational & How-To
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Top-of-funnel content opportunities that
                        build topical authority and capture early-stage researchers.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">how to prime vape coil</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">vape maintenance guide</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">difference between MTL and DTL</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- Local Vape Shop Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Local Vape Shop
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Geo-targeted searches for brick-and-mortar
                        locations. Critical for local SEO and Google Business Profile optimization.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">vape shop near me</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEE2E2] text-[#991B1B] text-[11px] font-bold rounded-full">High</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">vape store [city name]</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">where to buy vape locally</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- Compliance-Safe Brand Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Compliance-Safe Brand
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Brand-specific searches that avoid
                        restricted health claims while capturing branded traffic.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">SMOK nord components</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">GeekVape user manual</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">best Vaporesso pods</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- Vape Accessories Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Vape Accessories
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Supporting product categories with lower
                        competition and strong upsell potential.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">replacement vape glass</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">vape battery charger</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">portable vape case</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical SEO Section -->
    <section id="technical-seo" class="py-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Technical SEO
                    for Vape Stores</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Foundation-level optimization that ensures search
                    engines can crawl, index, and rank your vape e-commerce site</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Left Column: Cards -->
                <div class="space-y-6">
                    <!-- URL Structure -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex gap-6 items-start transition-all hover:shadow-md">
                        <div class="w-12 h-12 bg-[#1F4D45] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-link-m text-[#D4AF37] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#1F4D45] text-xl mb-3">URL Structure Optimization</h3>
                            <p class="text-gray-600 leading-relaxed text-sm">Clean, keyword-rich URLs that follow SEO
                                best practices. We implement logical hierarchy, remove unnecessary parameters, and
                                ensure consistent formatting across your vape product catalog.</p>
                        </div>
                    </div>

                    <!-- Canonical Tag -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex gap-6 items-start transition-all hover:shadow-md">
                        <div class="w-12 h-12 bg-[#1F4D45] rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="ri-file-copy-2-line text-[#D4AF37] text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-[#1F4D45] text-xl mb-3">Canonical Tag Implementation</h3>
                            <p class="text-gray-600 leading-relaxed text-sm">Prevent duplicate content issues from
                                product variants, filter pages, and pagination. Proper canonical tags consolidate
                                ranking signals and protect against self-competition.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Image & Feature -->
                <div class="space-y-8">
                    <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-200 bg-white">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=2070"
                            alt="Google Search Console Analytics Dashboard"
                            class="w-full h-auto opacity-100 transition-hover duration-500 hover:scale-105">
                    </div>
                    <div class="px-2">
                        <h3 class="font-bold text-[#1F4D45] text-xl mb-3">Search Console Monitoring</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">Continuous monitoring of indexation status,
                            crawl errors, and search performance metrics to identify and resolve technical issues before
                            they impact rankings.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Contact Button (Matches Screenshot) -->
    <div class="fixed bottom-8 right-8 z-[100]">
        <a href="#contact"
            class="flex items-center gap-3 bg-[#1F4D45] text-white px-6 py-3 rounded-full shadow-2xl hover:bg-[#2A5E55] transition-all hover:scale-105 group border border-white/10">
            <i class="ri-customer-service-2-line text-2xl text-[#D4AF37]"></i>
            <span class="font-bold">Talk with Us</span>
        </a>
    </div>

    <!-- Analytics & Reporting Section -->
    <section class="pb-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-white rounded-[2rem] p-12 md:p-16 shadow-xl border border-gray-100">
                <div class="grid md:grid-cols-3 gap-12 items-center text-center">
                    <!-- Item 1 -->
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 bg-[#1F4D45] rounded-full flex items-center justify-center mb-6 shadow-lg">
                            <i class="ri-apps-2-line text-[#D4AF37] text-2xl"></i>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Analytics
                            Integration</h3>
                        <p class="text-gray-600 leading-relaxed text-sm">GA4 event tracking, revenue attribution, and
                            conversion funnel analysis</p>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 bg-[#1F4D45] rounded-full flex items-center justify-center mb-6 shadow-lg">
                            <i class="ri-bar-chart-box-line text-[#D4AF37] text-2xl"></i>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Ranking Monitoring
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-sm">Daily keyword position tracking with SERP
                            feature visibility</p>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 bg-[#1F4D45] rounded-full flex items-center justify-center mb-6 shadow-lg">
                            <i class="ri-file-chart-line text-[#D4AF37] text-2xl"></i>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Monthly Reporting
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-sm">Transparent performance reports with actionable
                            insights</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Platform-Specific Section -->
    <section class="py-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">
                    Platform-Specific Vape SEO Expertise</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Every e-commerce platform has unique technical
                    requirements. We optimize for Shopify, WooCommerce, BigCommerce, and custom solutions.</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Shopify -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 transition-all hover:scale-[1.02]">
                    <div class="bg-[#83B250] p-8 text-center text-white">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm p-3">
                            <img src="https://cdn.simpleicons.org/shopify/white" alt="Shopify Logo"
                                class="w-full h-full object-contain">
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold">Shopify</h3>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#83B250] mt-1"></i>
                                <span class="text-gray-600 text-sm">Theme speed optimization and app conflict
                                    resolution</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#83B250] mt-1"></i>
                                <span class="text-gray-600 text-sm">Collection and product URL structure
                                    refinement</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#83B250] mt-1"></i>
                                <span class="text-gray-600 text-sm">Liquid template SEO enhancements</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- WooCommerce -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 transition-all hover:scale-[1.02]">
                    <div class="bg-[#875581] p-8 text-center text-white">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm p-3">
                            <img src="https://raw.githubusercontent.com/FortAwesome/Font-Awesome/6.x/svgs/brands/woocommerce.svg"
                                alt="WooCommerce Logo" class="w-full h-full object-contain brightness-0 invert">
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold">WooCommerce</h3>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#875581] mt-1"></i>
                                <span class="text-gray-600 text-sm">WordPress core and plugin optimization</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#875581] mt-1"></i>
                                <span class="text-gray-600 text-sm">Database query optimization for large
                                    catalogs</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#875581] mt-1"></i>
                                <span class="text-gray-600 text-sm">WooCommerce-specific caching strategies</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-[#875581] mt-1"></i>
                                <span class="text-gray-600 text-sm">Product attribute and variation SEO</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- BigCommerce -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 transition-all hover:scale-[1.02]">
                    <div class="bg-black p-8 text-center text-white">
                        <div
                            class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 p-4 shadow-xl border-4 border-white/10">
                            <img src="https://cdn.simpleicons.org/bigcommerce/000000" alt="BigCommerce Official Logo"
                                class="w-full h-full object-contain">
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold tracking-wide">BigCommerce</h3>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-black mt-1"></i>
                                <span class="text-gray-600 text-sm">Stencil theme performance optimization</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-black mt-1"></i>
                                <span class="text-gray-600 text-sm">Category and faceted search SEO configuration</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-black mt-1"></i>
                                <span class="text-gray-600 text-sm">BigCommerce API integration for bulk
                                    optimization</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="ri-checkbox-circle-fill text-black mt-1"></i>
                                <span class="text-gray-600 text-sm">Multi-storefront SEO management</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom & Headless SEO Section -->
    <section class="pb-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-[#F1EFE9] rounded-[2.5rem] p-8 md:p-16 shadow-inner border border-gray-200/50">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Content Left -->
                    <div>
                        <h2 class="font-['Playfair_Display'] text-3xl md:text-5xl font-bold text-[#1F4D45] mb-8">Custom
                            & Headless Commerce SEO</h2>
                        <p class="text-gray-700 text-lg mb-10 leading-relaxed">Running a custom-built vape e-commerce
                            platform or headless architecture? We have extensive experience optimizing non-standard
                            implementations, including:</p>

                        <ul class="space-y-6">
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-sm">
                                    <i class="ri-arrow-right-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <p class="text-gray-800"><span class="font-bold">Headless CMS</span> – Next.js, Gatsby,
                                    and JAMstack SEO optimization</p>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-sm">
                                    <i class="ri-arrow-right-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <p class="text-gray-800"><span class="font-bold">Custom frameworks</span> – Laravel,
                                    Django, Ruby on Rails SEO implementation</p>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-sm">
                                    <i class="ri-arrow-right-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <p class="text-gray-800"><span class="font-bold">API-first commerce</span> –
                                    Commercetools, Elastic Path, and custom APIs</p>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform shadow-sm">
                                    <i class="ri-arrow-right-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <p class="text-gray-800"><span class="font-bold">Progressive Web Apps</span> – PWA SEO
                                    best practices and indexation</p>
                            </li>
                        </ul>
                    </div>

                    <!-- Visual Right -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 flex flex-col items-center">
                        <div class="rounded-2xl overflow-hidden mb-8 shadow-md border border-gray-100">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2026&auto=format&fit=crop"
                                alt="Platform Dashboard View" class="w-full h-auto">
                        </div>
                        <div class="text-center px-4">
                            <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">
                                Platform-Agnostic Expertise</h3>
                            <p class="text-gray-600 leading-relaxed text-sm">Regardless of your tech stack, we deliver
                                results-driven vape SEO strategies that work with your existing infrastructure.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Trusted by
                    Leading Vape Brands</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Real results from real vape businesses that chose
                    compliance-focused SEO</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <?php if (!empty($testimonials)): ?>
                    <?php foreach ($testimonials as $t): ?>
                        <div
                            class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 flex flex-col h-full transition-all hover:scale-[1.02]">
                            <div class="flex items-center gap-4 mb-6">
                                <?php if (!empty($t['image_path'])): ?>
                                    <img src="<?php echo htmlspecialchars($t['image_path']); ?>"
                                        alt="<?php echo htmlspecialchars($t['client_name']); ?>"
                                        class="w-16 h-16 rounded-full object-cover">
                                <?php else: ?>
                                    <div
                                        class="w-16 h-16 bg-[#1F4D45] rounded-full flex items-center justify-center text-white font-bold text-xl">
                                        <?php echo substr($t['client_name'], 0, 1); ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h4 class="font-bold text-[#1F4D45]">
                                        <?php echo htmlspecialchars($t['client_name']); ?>
                                    </h4>
                                    <p class="text-xs text-gray-500 font-medium italic">
                                        <?php echo htmlspecialchars($t['position']); ?>
                                    </p>
                                    <p class="text-xs text-[#D4AF37] font-bold">
                                        <?php echo htmlspecialchars($t['company']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-1 mb-4">
                                <?php for ($i = 0; $i < (int) $t['rating']; $i++): ?>
                                    <i class="ri-star-fill text-[#D4AF37]"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-600 text-sm italic leading-relaxed mb-4 flex-grow">"
                                <?php echo htmlspecialchars($t['content']); ?>"
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-3 text-center text-gray-400 py-12">
                        <i class="ri-chat-voice-line text-4xl mb-4 block"></i>
                        <p>Add testimonials in the admin panel to display them here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section class="py-24 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div
                class="bg-[#2B584F] rounded-[2.5rem] p-12 md:p-20 text-center text-white relative overflow-hidden shadow-2xl">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>

                <div class="relative z-10">
                    <h2 class="font-['Playfair_Display'] text-3xl md:text-5xl font-bold mb-6">Join 50+ Vape Brands
                        Growing Organically</h2>
                    <p class="text-white/80 text-lg mb-12 max-w-2xl mx-auto">Stop struggling with generic SEO advice.
                        Partner with specialists who understand your industry.</p>

                    <div class="flex flex-wrap justify-center gap-4 mb-12">
                        <span
                            class="px-6 py-2 bg-white/10 rounded-full border border-white/20 text-sm font-medium backdrop-blur-sm">FDA
                            Compliant Strategies</span>
                        <span
                            class="px-6 py-2 bg-white/10 rounded-full border border-white/20 text-sm font-medium backdrop-blur-sm">Transparent
                            Reporting</span>
                        <span
                            class="px-6 py-2 bg-white/10 rounded-full border border-white/20 text-sm font-medium backdrop-blur-sm">Long-Term
                            Growth</span>
                    </div>

                    <a href="#audit"
                        class="inline-block bg-[#D4AF37] text-[#1F4D45] px-10 py-5 rounded-xl font-bold text-lg hover:bg-[#C49F2F] transition-all hover:scale-105 shadow-xl">
                        Start Your Success Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-20 bg-[#F5F3EE]">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Frequently
                    Asked Questions</h2>
                <p class="text-lg text-[#1A1A1A]">Everything you need to know about our services</p>
            </div>
            <div class="space-y-4">
                <?php if (!empty($faqs_list)): ?>
                    <?php foreach ($faqs_list as $f): ?>
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="font-bold text-[#1F4D45] text-lg mb-2"><?php echo htmlspecialchars($f['question']); ?>
                            </h3>
                            <p class="text-gray-600"><?php echo htmlspecialchars($f['answer']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-400">Add FAQs in the admin panel to display them here.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Free Audit Section -->
    <section id="audit" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Info -->
                <div>
                    <h2 class="font-['Playfair_Display'] text-4xl md:text-6xl font-bold text-[#1F4D45] mb-8">Get Your
                        Free Vape SEO Roadmap</h2>
                    <p class="text-gray-700 text-lg mb-10 leading-relaxed">Discover exactly what's holding your vape
                        brand back from organic growth. Our comprehensive SEO audit includes:</p>
                    <div class="space-y-8">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-[#1F4D45] rounded-xl flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="ri-shield-check-line text-[#D4AF37] text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-xl">Compliance Risk Assessment</h4>
                                <p class="text-gray-600">Identify FDA violation risks and content that could trigger
                                    penalties</p>
                            </div>
                        </div>
                        <!-- Item 2 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-[#1F4D45] rounded-xl flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="ri-search-eye-line text-[#D4AF37] text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-xl">Keyword Opportunity Analysis</h4>
                                <p class="text-gray-600">Uncover high-intent keywords your competitors are ranking for
                                </p>
                            </div>
                        </div>
                        <!-- Item 3 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-[#1F4D45] rounded-xl flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="ri-tools-line text-[#D4AF37] text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-xl">Technical SEO Audit</h4>
                                <p class="text-gray-600">Crawl errors, speed issues, and indexation problems holding you
                                    back</p>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-[#1F4D45] rounded-xl flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="ri-bar-chart-2-line text-[#D4AF37] text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-xl">Competitor Gap Analysis</h4>
                                <p class="text-gray-600">See exactly where competitors are beating you in search results
                                </p>
                            </div>
                        </div>
                        <!-- Item 5 -->
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 bg-[#1F4D45] rounded-xl flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="ri-road-map-line text-[#D4AF37] text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-xl">Custom Growth Roadmap</h4>
                                <p class="text-gray-600">A step-by-step plan to dominate your niche</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Form -->
                <div class="bg-[#F5F3EE] p-8 md:p-12 rounded-[2.5rem] shadow-2xl border border-gray-100 relative">
                    <div
                        class="absolute -top-6 left-1/2 -translate-x-1/2 bg-[#D4AF37] text-[#1F4D45] px-6 py-2 rounded-full font-bold text-sm shadow-lg whitespace-nowrap">
                        Limited: 5 Audits Remaining This Week
                    </div>
                    <h3 class="font-['Playfair_Display'] text-3xl font-bold text-[#1F4D45] text-center mb-8">Request
                        Your Free SEO Audit</h3>
                    <form action="process-lead.php" method="POST" class="space-y-5">
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Full
                                    Name *</label>
                                <input type="text" name="name" required placeholder="John Smith"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Email
                                    Address *</label>
                                <input type="email" name="email" required placeholder="john@vapebrand.com"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Website
                                URL *</label>
                            <input type="url" name="url" required placeholder="https://yourvapesore.com"
                                class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Phone
                                Number</label>
                            <input type="tel" name="phone" placeholder="+1 (555) 123-4567"
                                class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white">
                        </div>
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label
                                    class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Monthly
                                    Traffic</label>
                                <select name="traffic"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white appearance-none">
                                    <option value="">Select range</option>
                                    <option value="0-1k">0 - 1k</option>
                                    <option value="1k-10k">1k - 10k</option>
                                    <option value="10k-50k">10k - 50k</option>
                                    <option value="50k+">50k+</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Main
                                    Challenge</label>
                                <select name="challenge"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-100 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white appearance-none">
                                    <option value="">Select challenge</option>
                                    <option value="rankings">Rankings</option>
                                    <option value="compliance">Compliance</option>
                                    <option value="technical">Technical</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-[#1F4D45] text-white py-5 rounded-xl font-bold text-lg hover:bg-[#2A5E55] transition-all shadow-xl mt-4 flex items-center justify-center gap-3 group">
                            Claim Your Free Roadmap <i
                                class="ri-arrow-right-line group-hover:translate-x-2 transition-transform"></i>
                        </button>
                        <p class="text-center text-[10px] text-gray-400 mt-4">We respect your privacy. Your data will
                            never be shared with third parties.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer-content.php'; ?>
<?php include 'includes/exit-popup.php'; ?>
<?php include 'includes/footer.php'; ?>