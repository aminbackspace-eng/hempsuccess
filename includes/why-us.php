<?php
require_once __DIR__ . '/../config/db.php';
$about_title = 'Why Hemp SEO is Different';
$about_subtitle = 'Hemp, CBD, vape, and cannabis SEO is <strong>COMPLETELY different</strong> from normal industries. Here\'s why:';

if ($pdo instanceof PDO) {
    try {
        $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'about'");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        if (isset($results['title'])) $about_title = $results['title'];
        if (isset($results['subtitle'])) $about_subtitle = $results['subtitle'];
    } catch (Throwable $e) {}
}
?>
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <h2 class="font-['Playfair_Display'] text-4xl lg:text-5xl font-bold text-[#1A3C34] mb-8"><?php echo htmlspecialchars($about_title); ?></h2>
                <div class="prose prose-lg max-w-none text-gray-700 space-y-6">
                    <p class="text-lg leading-relaxed"><?php echo $about_subtitle; ?></p>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold">1</div>
                            <div>
                                <h3 class="text-xl font-bold text-[#1A3C34] mb-2">GOOGLE RESTRICTIONS</h3>
                                <p>Cannabis-related terms trigger manual reviews and ad suspensions. Standard SEO tactics that work for other industries can get your site penalized or de-indexed in the hemp space.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold">2</div>
                            <div>
                                <h3 class="text-xl font-bold text-[#1A3C34] mb-2">PAYMENT PROCESSORS</h3>
                                <p>Stripe and PayPal ban CBD products, requiring special merchant accounts. Your ecommerce SEO strategy must account for these unique payment processing challenges.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold">3</div>
                            <div>
                                <h3 class="text-xl font-bold text-[#1A3C34] mb-2">COMPLIANCE CHALLENGES</h3>
                                <p>State laws differ dramatically. Location-specific content is required to maintain compliance while maximizing organic visibility across different markets.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center text-white font-bold">4</div>
                            <div>
                                <h3 class="text-xl font-bold text-[#1A3C34] mb-2">AD LIMITATIONS</h3>
                                <p>Google Ads blocks 90% of cannabis keywords. Our Hemp SEO Agency specializes in compliant advertising strategies that actually work.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-[#1A3C34] text-white p-8 rounded-lg">
                        <h3 class="text-2xl font-bold mb-6 text-center">Our Track Record</h3>
                        <div class="space-y-6">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-[#D4AF37] mb-2">500+</div>
                                <div class="text-sm">Hemp Clients Served</div>
                            </div>
                            <div class="text-center">
                                <div class="text-5xl font-bold text-[#D4AF37] mb-2">98%</div>
                                <div class="text-sm">Compliance Rate</div>
                            </div>
                            <div class="text-center">
                                <div class="text-5xl font-bold text-[#D4AF37] mb-2">3.2x</div>
                                <div class="text-sm">Average ROAS</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-[#D4AF37] text-white p-6 rounded-lg text-center">
                        <h4 class="text-xl font-bold mb-3">Ready to Grow?</h4>
                        <p class="mb-4 text-sm">Get your free Hemp SEO audit today</p>
                        <a href="#audit" class="block bg-white text-[#1A3C34] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors cursor-pointer whitespace-nowrap">Get Free Audit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>