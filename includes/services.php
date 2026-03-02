<?php
// Try to connect to DB
$services = [];
if (file_exists(__DIR__ . '/../config/db.php')) {
    include_once __DIR__ . '/../config/db.php';
    if (isset($pdo)) {
        try {
            $stmt = $pdo->query("SELECT * FROM services ORDER BY created_at ASC");
            if ($stmt) {
                $services = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            // Silently fail to fallback
        }
    }
}
?>
<style>
    html {
        scroll-behavior: smooth;
    }

    .service-card {
        scroll-margin-top: 100px;
    }
</style>
<section id="services" class="py-20 bg-[#F8F9FA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-['Playfair_Display'] text-4xl lg:text-5xl font-bold text-[#1A3C34] mb-4">Our Hemp SEO
                Services</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Specialized SEO solutions designed specifically for hemp,
                CBD, cannabis, and vape businesses</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" data-product-shop="true">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                        <div
                            class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                            <i
                                class="<?php echo htmlspecialchars($service['icon']); ?> text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[#1A3C34] mb-4"><?php echo htmlspecialchars($service['title']); ?>
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed"><?php echo htmlspecialchars($service['description']); ?>
                        </p>
                        <a href="<?php echo htmlspecialchars($service['link'] ?? '#'); ?>"
                            class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Learn
                            More<i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback Static Content -->
                <div id="hemp-seo"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-search-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Hemp &amp; CBD SEO Services</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Industry-specific keyword research with semantic
                        clustering and compliance-first content strategy. We understand the nuances of hemp SEO and create
                        content that ranks while staying fully compliant with Google guidelines and state regulations.</p><a
                        href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="cbd-seo"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-search-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">CBD SEO Services</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Specialized SEO for CBD brands with compliant content
                        strategies, product optimization, and organic growth tactics. Navigate complex regulations while
                        achieving top rankings for competitive CBD keywords.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="vape-seo-services"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-mist-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Vape SEO Services</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Algorithm-resistant SEO for vape shops and brands.
                        Age-gate optimization, device &amp; e-liquid product page SEO, SERP volatility monitoring,
                        and brand authority building through compliant content that drives consistent traffic.</p><a
                        href="vape_seo_service.php"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="cannabis-seo"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-plant-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Cannabis SEO</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Expert cannabis SEO services with compliant content
                        creation, local search optimization, and authority building. Dominate search results in this highly
                        competitive and regulated industry.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="vape-seo"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-mist-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Vape SEO</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Specialized vape industry SEO with product page
                        optimization, content marketing, and link building strategies designed for vape shops and ecommerce
                        brands.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="local-seo"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-map-pin-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Local SEO for Dispensaries</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Google Business Profile optimization, 500+ local
                        citations, and location-specific landing pages. We help dispensaries dominate local search results
                        with geo-targeted content.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="google-ads"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i
                            class="ri-advertisement-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Google Ads for CBD (Compliant)</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Compliant Google Ads campaigns that actually work for CBD
                        and hemp products. We navigate the complex advertising restrictions with white-hat strategies,
                        alternative keyword targeting, and landing page optimization that passes Google review. Achieve
                        profitable ROAS while staying within platform guidelines.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <div id="cro"
                    class="service-card bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 group">
                    <div
                        class="w-16 h-16 bg-[#A8D5BA] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#1A3C34] transition-colors">
                        <i class="ri-line-chart-line text-3xl text-[#1A3C34] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Technical SEO &amp; CRO</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">Comprehensive technical audits, Core Web Vitals
                        optimization, and conversion rate optimization. We fix crawl errors, improve site architecture,
                        implement structured data, and optimize page speed. Our CRO strategies include A/B testing, heat
                        mapping analysis, and user experience improvements.</p><a href="#audit"
                        class="inline-flex items-center text-[#D4AF37] font-semibold hover:text-[#1A3C34] transition-colors cursor-pointer group">Get
                        Started
                        <i class="ri-arrow-right-line ml-2 group-hover:translate-x-1 transition-transform"></i></a>
                </div>
                <!-- This card removed as we now have 8 services total -->
            <?php endif; ?>
        </div>

        <div class="mt-16 bg-white rounded-lg p-8 shadow-lg">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Why Choose Our Hemp SEO Agency?</h3>
                    <p class="text-gray-600 mb-4">Unlike general SEO agencies, we specialize exclusively in hemp, CBD,
                        cannabis, and vape industries. Our team understands the unique challenges of marketing in
                        restricted niches and has developed proven strategies that deliver results while maintaining
                        full compliance.</p>
                    <ul class="space-y-2">
                        <li class="flex items-start gap-2"><i
                                class="ri-checkbox-circle-fill text-[#1A3C34] text-xl flex-shrink-0 mt-1"></i><span>5+
                                years of hemp industry experience</span></li>
                        <li class="flex items-start gap-2"><i
                                class="ri-checkbox-circle-fill text-[#1A3C34] text-xl flex-shrink-0 mt-1"></i><span>Transparent
                                weekly reporting and analytics</span></li>
                        <li class="flex items-start gap-2"><i
                                class="ri-checkbox-circle-fill text-[#1A3C34] text-xl flex-shrink-0 mt-1"></i><span>100%
                                compliance guarantee</span></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-[#1A3C34] mb-4">Our Process</h3>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                1</div>
                            <div>
                                <h4 class="font-bold text-[#1A3C34]">Audit &amp; Analysis</h4>
                                <p class="text-gray-600 text-sm">Comprehensive SEO audit and competitor analysis</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                2</div>
                            <div>
                                <h4 class="font-bold text-[#1A3C34]">Strategy Development</h4>
                                <p class="text-gray-600 text-sm">Custom SEO roadmap tailored to your business</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                3</div>
                            <div>
                                <h4 class="font-bold text-[#1A3C34]">Implementation</h4>
                                <p class="text-gray-600 text-sm">Execute optimization and content strategies</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold text-sm">
                                4</div>
                            <div>
                                <h4 class="font-bold text-[#1A3C34]">Monitor &amp; Optimize</h4>
                                <p class="text-gray-600 text-sm">Continuous tracking and performance improvement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>