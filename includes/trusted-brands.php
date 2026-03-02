<?php
// Try to connect to DB
$brands = [];
if (file_exists(__DIR__ . '/../config/db.php')) {
    include_once __DIR__ . '/../config/db.php';
    if (isset($pdo)) {
        try {
            $stmt = $pdo->query("SELECT * FROM brands ORDER BY created_at ASC");
            if ($stmt) {
                $brands = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            // Silently fail to fallback
        }
    }
}
?>

<section class="py-16 bg-[#F8F9FA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-2xl font-semibold text-gray-600 mb-12">Trusted by Leading Hemp, CBD &amp; Vape
            Brands</h2>

        <?php if (!empty($brands)): ?>
            <!-- Dynamic Content -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
                <?php foreach ($brands as $brand): ?>
                    <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                        <div class="w-full h-16">
                            <img alt="<?php echo htmlspecialchars($brand['name']); ?>"
                                class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                                src="<?php echo htmlspecialchars($brand['image_path']); ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Static Fallback Content -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="Hemp Brand 1"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(2)">
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="CBD Store 2"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(3)">
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="Vape Brand 3"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(4)">
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="Cannabis Co 4"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(5)">
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="Hemp Products 5"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(6)">
                    </div>
                </div>
                <div class="flex items-center justify-center p-4 bg-white rounded-lg hover:shadow-lg transition-shadow">
                    <div class="w-full h-16"><img alt="CBD Wellness 6"
                            class="w-full h-full object-contain grayscale hover:grayscale-0 transition-all"
                            src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/search-image(7)">
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Stats Section (Static) -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-[#1A3C34] mb-2">5+</div>
                <div class="text-gray-600">Years Experience</div>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-[#1A3C34] mb-2">500+</div>
                <div class="text-gray-600">Clients Served</div>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-[#1A3C34] mb-2">300%</div>
                <div class="text-gray-600">Avg Traffic Growth</div>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-sm">
                <div class="text-4xl font-bold text-[#1A3C34] mb-2">98%</div>
                <div class="text-gray-600">Compliance Rate</div>
            </div>
        </div>
    </div>
</section>