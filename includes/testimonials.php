<?php
// Try to connect to DB
$testimonials = [];
if (file_exists(__DIR__ . '/../config/db.php')) {
    include_once __DIR__ . '/../config/db.php';
    if (isset($pdo)) {
        try {
            $stmt = $pdo->query("SELECT * FROM testimonials ORDER BY created_at ASC");
            if ($stmt) {
                $testimonials = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            // Silently fail to fallback
        }
    }
}
?>
<section class="py-20 bg-[#F8F9FA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-['Playfair_Display'] text-4xl lg:text-5xl font-bold text-[#1A3C34] mb-4">Client Testimonials
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Hear what our Hemp SEO Agency clients have to say about
                their experience</p>
        </div>

        <?php if (!empty($testimonials)): ?>
            <!-- Dynamic Content -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex gap-1 mb-4">
                            <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                <i class="ri-star-fill text-[#D4AF37] text-xl"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="text-gray-600 mb-6 leading-relaxed"><?php echo htmlspecialchars($testimonial['content']); ?>
                        </p>
                        <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                            <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                <img alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                    class="w-full h-full object-cover object-top"
                                    src="<?php echo htmlspecialchars($testimonial['image_path']); ?>">
                            </div>
                            <div>
                                <div class="font-bold text-[#1A3C34]">
                                    <?php echo htmlspecialchars($testimonial['client_name']); ?>
                                </div>
                                <div class="text-gray-600 text-sm">
                                    <?php echo htmlspecialchars($testimonial['position'] . ', ' . $testimonial['company']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Static Fallback Content -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"Working with this Hemp SEO Agency transformed our
                        business. We went from page 3 to dominating page 1 for our most important keywords. Our organic
                        traffic increased 385% in just 6 months, and revenue has tripled. They truly understand the hemp
                        industry and compliance requirements."</p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="Sarah Mitchell"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(15)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">Sarah Mitchell</div>
                            <div class="text-gray-600 text-sm">CEO, GreenLeaf CBD</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"As a multi-location dispensary, local SEO was critical
                        for us. This team delivered beyond expectations. We now rank #1 in all our target cities, and foot
                        traffic has increased dramatically. Their understanding of cannabis regulations and local search is
                        unmatched."</p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="Michael Chen"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(16)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">Michael Chen</div>
                            <div class="text-gray-600 text-sm">Owner, Urban Dispensary</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"Finally, an SEO agency that gets the hemp industry! Their
                        strategic approach to content and link building has positioned us as an authority in our niche. We
                        have seen consistent month-over-month growth in rankings, traffic, and most importantly, revenue."
                    </p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="Jennifer Rodriguez"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(17)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">Jennifer Rodriguez</div>
                            <div class="text-gray-600 text-sm">Marketing Director, Hemp Wellness Co</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"The results speak for themselves. Our vape shop went from
                        struggling to find customers online to being the top result for dozens of high-value keywords. The
                        Hemp SEO Agency team is responsive, transparent, and delivers real ROI."</p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="David Thompson"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(18)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">David Thompson</div>
                            <div class="text-gray-600 text-sm">Founder, Vape Nation</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"I have worked with several SEO agencies before, but none
                        understood the unique challenges of CBD ecommerce like this team. They optimized our entire site,
                        created amazing content, and built quality backlinks. Our sales have increased 290% year-over-year."
                    </p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="Amanda Foster"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(19)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">Amanda Foster</div>
                            <div class="text-gray-600 text-sm">Owner, Pure CBD Store</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex gap-1 mb-4"><i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                            class="ri-star-fill text-[#D4AF37] text-xl"></i></div>
                    <p class="text-gray-600 mb-6 leading-relaxed">"Outstanding service and results. This Hemp SEO Agency
                        helped us navigate the complex world of cannabis marketing with compliant strategies that actually
                        work. We have seen tremendous growth in organic visibility and customer acquisition."</p>
                    <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                        <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0"><img alt="Robert Martinez"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(20)">
                        </div>
                        <div>
                            <div class="font-bold text-[#1A3C34]">Robert Martinez</div>
                            <div class="text-gray-600 text-sm">Director, Cannabis Collective</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-16 grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-5xl font-bold text-[#1A3C34] mb-2">4.9/5</div>
                <div class="text-gray-600">Average Client Rating</div>
                <div class="flex justify-center gap-1 mt-2">
                    <i class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                        class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                        class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                        class="ri-star-fill text-[#D4AF37] text-xl"></i><i
                        class="ri-star-fill text-[#D4AF37] text-xl"></i>
                </div>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-5xl font-bold text-[#1A3C34] mb-2">95%</div>
                <div class="text-gray-600">Client Retention Rate</div>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-5xl font-bold text-[#1A3C34] mb-2">500+</div>
                <div class="text-gray-600">Successful Projects</div>
            </div>
        </div>
    </div>
</section>