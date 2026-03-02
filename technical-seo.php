<?php
require_once __DIR__ . '/config/db.php';
include 'includes/header.php';
$hide_mega_menu = true;
include 'includes/navbar.php';
?>

<div class="min-h-screen bg-[#F5F3EE] pt-20">
    <!-- Hero Section -->
    <section class="relative py-20 bg-[#1A3C34] overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#D4AF37] rounded-full filter blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#A8D5BA] rounded-full filter blur-3xl -ml-32 -mb-32">
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <h1 class="font-['Playfair_Display'] text-4xl md:text-6xl font-bold text-white mb-6">Technical SEO for Vape
                Stores</h1>
            <p class="text-xl text-[#A8D5BA] max-w-3xl mx-auto">Ensuring your e-commerce platform is perfectly optimized
                for search engine crawlers and users alike.</p>
        </div>
    </section>

    <!-- Keyword Research Methodology Section (from screenshot) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-[#1F4D45] rounded-3xl overflow-hidden p-8 md:p-12 shadow-2xl relative">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="font-['Playfair_Display'] text-3xl md:text-4xl font-bold text-white mb-8">Our Keyword
                            Research Methodology</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="ri-check-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <div>
                                    <span class="text-white font-bold text-lg">Competitor gap analysis</span>
                                    <span class="text-white/80 block">— Identify keywords your competitors rank for that
                                        you don't</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="ri-check-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <div>
                                    <span class="text-white font-bold text-lg">Search intent mapping</span>
                                    <span class="text-white/80 block">— Align keywords with buyer journey stages</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="ri-check-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <div>
                                    <span class="text-white font-bold text-lg">Compliance filtering</span>
                                    <span class="text-white/80 block">— Remove restricted terms and health claim
                                        triggers</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="ri-check-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <div>
                                    <span class="text-white font-bold text-lg">Difficulty scoring</span>
                                    <span class="text-white/80 block">— Prioritize quick wins and long-term authority
                                        plays</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-6 h-6 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="ri-check-line text-[#1F4D45] font-bold"></i>
                                </div>
                                <div>
                                    <span class="text-white font-bold text-lg">Seasonal trend analysis</span>
                                    <span class="text-white/80 block">— Capitalize on cyclical search patterns</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Side Card -->
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 text-center">
                        <div
                            class="w-16 h-16 bg-[#D4AF37]/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="ri-search-2-line text-[#D4AF37] text-4xl"></i>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-white mb-4">Custom Keyword Strategy
                        </h3>
                        <p class="text-white/80 mb-8">Every vape brand has unique positioning, product mix, and target
                            audience. We build custom keyword strategies tailored to your specific business goals.</p>
                        <a href="#audit"
                            class="inline-block w-full bg-[#D4AF37] text-[#1F4D45] py-4 rounded-xl font-bold hover:bg-[#C49F2F] transition-all">Get
                            Your Keyword Strategy</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical SEO Details -->
    <section class="py-20 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-8">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 italic transition-all hover:shadow-lg">
                        <h3 class="text-xl font-bold text-[#1F4D45] mb-4 flex items-center gap-3">
                            <i class="ri-speed-up-line text-[#D4AF37]"></i> Core Web Vitals Optimization
                        </h3>
                        <p class="text-gray-600">We optimize LCP, FID, and CLS to ensure your site loads instantly and
                            provides a stable user experience, which is a critical ranking factor in 2025.</p>
                    </div>
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-lg">
                        <h3 class="text-xl font-bold text-[#1F4D45] mb-4 flex items-center gap-3">
                            <i class="ri-layout-masonry-line text-[#D4AF37]"></i> Site Architecture
                        </h3>
                        <p class="text-gray-600">A logical hierarchy for your categories and products ensures that
                            authority flows correctly throughout your site and users can find products within 3 clicks.
                        </p>
                    </div>
                </div>
                <div class="space-y-8">
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-lg">
                        <h3 class="text-xl font-bold text-[#1F4D45] mb-4 flex items-center gap-3">
                            <i class="ri-database-line text-[#D4AF37]"></i> Schema Markup for E-commerce
                        </h3>
                        <p class="text-gray-600">Implementing Product, Review, and Availability schema to get your
                            products featured with rich snippets in Google SERPs, increasing CTR dramatically.</p>
                    </div>
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-lg">
                        <h3 class="text-xl font-bold text-[#1F4D45] mb-4 flex items-center gap-3">
                            <i class="ri-settings-3-line text-[#D4AF37]"></i> Advanced Crawl Budget Management
                        </h3>
                        <p class="text-gray-600">We optimize your robots.txt and sitemaps to ensure Google crawls your
                            high-priority product pages more frequently while ignoring low-value utility pages.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-[#1F4D45] text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="font-['Playfair_Display'] text-3xl md:text-5xl font-bold text-white mb-8">Ready to Optimize Your
                Vape Store?</h2>
            <p class="text-xl text-white/80 mb-10">Get a comprehensive technical audit and see where you're losing
                traffic.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#audit"
                    class="bg-[#D4AF37] text-[#1F4D45] px-10 py-5 rounded-lg font-bold text-lg hover:bg-[#C49F2F] transition-all shadow-lg">Request
                    Technical Audit</a>
                <a href="#contact"
                    class="border-2 border-white text-white px-10 py-5 rounded-lg font-bold text-lg hover:bg-white hover:text-[#1F4D45] transition-all">Talk
                    to an Expert</a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <?php include 'includes/audit.php'; ?>
</div>

<?php include 'includes/footer-content.php'; ?>
<?php include 'includes/exit-popup.php'; ?>
<?php include 'includes/footer.php'; ?>