<?php
// Try to connect to DB
$case_studies = [];
if (file_exists(__DIR__ . '/../config/db.php')) {
    include_once __DIR__ . '/../config/db.php';
    if (isset($pdo)) {
        try {
            $stmt = $pdo->query("SELECT * FROM case_studies ORDER BY created_at ASC LIMIT 3");
            if ($stmt) {
                $case_studies = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            // Silently fail to fallback
        }
    }
}
?>
<section id="case-studies" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-['Playfair_Display'] text-4xl lg:text-5xl font-bold text-[#1A3C34] mb-4">Case Studies</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Real results from our Hemp SEO Agency clients across
                different industries</p>
        </div>

        <?php if (!empty($case_studies)): ?>
            <!-- Dynamic Content -->
            <div class="space-y-12">
                <?php foreach ($case_studies as $index => $study): ?>
                    <?php $is_reversed = ($index % 2 != 0); ?>
                    <div
                        class="bg-[#F8F9FA] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow <?php echo $is_reversed ? 'lg:flex-row-reverse' : ''; ?>">
                        <div class="grid lg:grid-cols-2 gap-0 <?php echo $is_reversed ? 'lg:grid-flow-dense' : ''; ?>">
                            <div class="w-full h-80 lg:h-auto <?php echo $is_reversed ? 'lg:col-start-2' : ''; ?>">
                                <img alt="<?php echo htmlspecialchars($study['title']); ?>"
                                    class="w-full h-full object-cover object-top"
                                    src="<?php echo htmlspecialchars($study['image_path']); ?>">
                            </div>
                            <div
                                class="p-8 lg:p-12 flex flex-col justify-center <?php echo $is_reversed ? 'lg:col-start-1' : ''; ?>">
                                <div
                                    class="inline-block bg-[#A8D5BA] text-[#1A3C34] px-4 py-1 rounded-full text-sm font-semibold mb-4 w-fit">
                                    <?php echo htmlspecialchars($study['category']); ?></div>
                                <h3 class="text-3xl font-bold text-[#1A3C34] mb-6">
                                    <?php echo htmlspecialchars($study['title']); ?></h3>
                                <div class="space-y-4 mb-8">
                                    <div>
                                        <h4 class="font-bold text-[#1A3C34] mb-2">Challenge:</h4>
                                        <p class="text-gray-600"><?php echo htmlspecialchars($study['challenge']); ?></p>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-[#1A3C34] mb-2">Solution:</h4>
                                        <p class="text-gray-600"><?php echo htmlspecialchars($study['solution']); ?></p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center p-4 bg-white rounded-lg">
                                        <div class="text-3xl font-bold text-[#D4AF37] mb-1">
                                            <?php echo htmlspecialchars($study['metric1_value']); ?></div>
                                        <div class="text-gray-600 text-sm">
                                            <?php echo htmlspecialchars($study['metric1_label']); ?></div>
                                    </div>
                                    <div class="text-center p-4 bg-white rounded-lg">
                                        <div class="text-3xl font-bold text-[#D4AF37] mb-1">
                                            <?php echo htmlspecialchars($study['metric2_value']); ?></div>
                                        <div class="text-gray-600 text-sm">
                                            <?php echo htmlspecialchars($study['metric2_label']); ?></div>
                                    </div>
                                    <div class="text-center p-4 bg-white rounded-lg">
                                        <div class="text-3xl font-bold text-[#D4AF37] mb-1">
                                            <?php echo htmlspecialchars($study['metric3_value']); ?></div>
                                        <div class="text-gray-600 text-sm">
                                            <?php echo htmlspecialchars($study['metric3_label']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Static Fallback Content -->
            <div class="space-y-12">
                <div class="bg-[#F8F9FA] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow ">
                    <div class="grid lg:grid-cols-2 gap-0 ">
                        <div class="w-full h-80 lg:h-auto "><img alt="Premium CBD Brand"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(12)">
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-center ">
                            <div
                                class="inline-block bg-[#A8D5BA] text-[#1A3C34] px-4 py-1 rounded-full text-sm font-semibold mb-4 w-fit">
                                CBD Ecommerce</div>
                            <h3 class="text-3xl font-bold text-[#1A3C34] mb-6">Premium CBD Brand</h3>
                            <div class="space-y-4 mb-8">
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Challenge:</h4>
                                    <p class="text-gray-600">New CBD ecommerce store struggling to rank for competitive
                                        keywords and generate organic traffic</p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Solution:</h4>
                                    <p class="text-gray-600">Implemented comprehensive Hemp SEO strategy including technical
                                        optimization, content marketing, and strategic link building</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">385%</div>
                                    <div class="text-gray-600 text-sm">Organic Traffic Increase</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">12x</div>
                                    <div class="text-gray-600 text-sm">Keyword Rankings</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">$250K</div>
                                    <div class="text-gray-600 text-sm">Monthly Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-[#F8F9FA] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow lg:flex-row-reverse">
                    <div class="grid lg:grid-cols-2 gap-0 lg:grid-flow-dense">
                        <div class="w-full h-80 lg:h-auto lg:col-start-2"><img alt="Multi-Location Dispensary"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(13)">
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-center lg:col-start-1">
                            <div
                                class="inline-block bg-[#A8D5BA] text-[#1A3C34] px-4 py-1 rounded-full text-sm font-semibold mb-4 w-fit">
                                Cannabis Retail</div>
                            <h3 class="text-3xl font-bold text-[#1A3C34] mb-6">Multi-Location Dispensary</h3>
                            <div class="space-y-4 mb-8">
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Challenge:</h4>
                                    <p class="text-gray-600">Dispensary chain needed to dominate local search across 8
                                        locations in competitive markets</p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Solution:</h4>
                                    <p class="text-gray-600">Developed location-specific landing pages, optimized Google
                                        Business Profiles, and built local citations</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">520%</div>
                                    <div class="text-gray-600 text-sm">Local Search Visibility</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">#1</div>
                                    <div class="text-gray-600 text-sm">Rankings in 6 Cities</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">180%</div>
                                    <div class="text-gray-600 text-sm">Foot Traffic Growth</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#F8F9FA] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow ">
                    <div class="grid lg:grid-cols-2 gap-0 ">
                        <div class="w-full h-80 lg:h-auto "><img alt="Hemp Wellness Brand"
                                class="w-full h-full object-cover object-top"
                                src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(14)">
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-center ">
                            <div
                                class="inline-block bg-[#A8D5BA] text-[#1A3C34] px-4 py-1 rounded-full text-sm font-semibold mb-4 w-fit">
                                Hemp Products</div>
                            <h3 class="text-3xl font-bold text-[#1A3C34] mb-6">Hemp Wellness Brand</h3>
                            <div class="space-y-4 mb-8">
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Challenge:</h4>
                                    <p class="text-gray-600">Established hemp brand losing market share to competitors with
                                        better online visibility</p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#1A3C34] mb-2">Solution:</h4>
                                    <p class="text-gray-600">Rebuilt content strategy with entity-based SEO, improved
                                        technical performance, and acquired high-authority backlinks</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">290%</div>
                                    <div class="text-gray-600 text-sm">Organic Revenue</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">450+</div>
                                    <div class="text-gray-600 text-sm">Page 1 Rankings</div>
                                </div>
                                <div class="text-center p-4 bg-white rounded-lg">
                                    <div class="text-3xl font-bold text-[#D4AF37] mb-1">4.2x</div>
                                    <div class="text-gray-600 text-sm">ROAS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="mt-16 text-center bg-[#1A3C34] rounded-lg p-12">
            <h3 class="text-3xl font-bold text-white mb-4">Ready to Achieve Similar Results?</h3>
            <p class="text-[#A8D5BA] mb-8 text-lg">Let our Hemp SEO Agency help you dominate your market</p>
            <a href="#audit"
                class="inline-block bg-[#D4AF37] text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-[#C19B2E] transition-all hover:shadow-2xl cursor-pointer whitespace-nowrap">Get
                Your Free SEO Audit</a>
        </div>
    </div>
</section>