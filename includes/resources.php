<?php
require_once __DIR__ . '/../config/db.php';
try {
    $stmt = $pdo->query("SELECT * FROM resources ORDER BY created_at DESC");
    $resources = $stmt->fetchAll();
} catch (Exception $e) {
    $resources = [];
}

// Fallback if empty
if (empty($resources)) {
    $resources = [
        [
            'title' => 'The Ultimate Guide to CBD SEO in 2025',
            'description' => 'Learn how to navigate Google\'s strict regulations and rank your CBD brand on the first page.',
            'type' => 'E-Book',
            'icon_class' => 'ri-book-open-line',
            'link' => '#'
        ],
        [
            'title' => '300% Growth in Organic Traffic',
            'description' => 'A deep dive into how we helped a boutique hemp brand scale from 1k to 50k monthly visitors.',
            'type' => 'Case Study',
            'icon_class' => 'ri-line-chart-line',
            'link' => '#'
        ],
        [
            'title' => 'CBD Compliance SEO Checklist',
            'description' => 'Don\'t get de-indexed. Follow our 25-point checklist to ensure your content stays compliant.',
            'type' => 'Checklist',
            'icon_class' => 'ri-shield-check-line',
            'link' => '#'
        ]
    ];
}
?>
<section id="resources" class="py-20 bg-[#F8F9FA]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="font-['Playfair_Display'] text-4xl lg:text-5xl font-bold text-[#1A3C34] mb-4">Educational Resources</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Master the world of Hemp and CBD SEO with our expert guides and tools.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($resources as $resource): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:-translate-y-2">
                <div class="h-48 bg-[#1A3C34] flex items-center justify-center p-8">
                    <i class="<?php echo htmlspecialchars($resource['icon_class']); ?> text-6xl text-[#A8D5BA]"></i>
                </div>
                <div class="p-6">
                    <span class="text-[#D4AF37] font-bold text-sm uppercase tracking-wider"><?php echo htmlspecialchars($resource['type']); ?></span>
                    <h3 class="text-xl font-bold text-[#1A3C34] mt-2 mb-4"><?php echo htmlspecialchars($resource['title']); ?></h3>
                    <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($resource['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($resource['link']); ?>" class="inline-flex items-center text-[#1A3C34] font-bold hover:text-[#D4AF37] transition-colors">
                        Learn More <i class="ri-arrow-right-line ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>