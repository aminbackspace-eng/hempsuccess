<?php
require_once __DIR__ . '/../config/db.php';

// Default values
$popup = [
    'title' => 'Wait! Don\'t Miss Out',
    'description' => 'Get your FREE Hemp SEO Audit and discover how to dominate Google rankings in your niche.',
    'button_text' => 'Get My Free Audit',
    'is_active' => '1'
];

try {
    $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'popup'");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    foreach ($popup as $key => $val) {
        if (isset($results[$key])) $popup[$key] = $results[$key];
    }
} catch (Exception $e) {}

// If disabled, don't show anything
if ($popup['is_active'] != '1') return;
?>

<!-- Exit Intent Popup -->
<div id="exit-popup" class="fixed inset-0 z-[100] flex items-center justify-center hidden">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" id="exit-popup-overlay"></div>
    
    <!-- Popup Card -->
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden transform transition-all scale-95 opacity-0 duration-300" id="exit-popup-card">
        <!-- Close Button -->
        <button id="close-exit-popup" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
            <i class="ri-close-line text-2xl"></i>
        </button>
        
        <div class="p-8 lg:p-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl lg:text-4xl font-bold text-[#1A3C34] mb-4 font-serif"><?php echo htmlspecialchars($popup['title']); ?></h2>
                <p class="text-gray-600 text-lg"><?php echo htmlspecialchars($popup['description']); ?></p>
            </div>
            
            <form action="process-lead.php" method="POST" class="space-y-4">
                <div>
                    <input type="text" name="full_name" required 
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#A8D5BA] focus:ring-2 focus:ring-[#A8D5BA]/20 transition-all text-lg" 
                        placeholder="Your Name">
                </div>
                <div>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#A8D5BA] focus:ring-2 focus:ring-[#A8D5BA]/20 transition-all text-lg" 
                        placeholder="Email Address">
                </div>
                <div>
                    <input type="url" name="website_url" required 
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:outline-none focus:border-[#A8D5BA] focus:ring-2 focus:ring-[#A8D5BA]/20 transition-all text-lg" 
                        placeholder="Your Website URL">
                </div>
                
                <!-- Hidden inputs for compatibility with process-lead.php -->
                <input type="hidden" name="phone" value="N/A">
                <input type="hidden" name="business_type" value="popup_lead">
                
                <button type="submit" 
                    class="w-full bg-[#D4AF37] hover:bg-[#C19B2E] text-white py-5 rounded-xl font-bold text-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <?php echo htmlspecialchars($popup['button_text']); ?>
                </button>
            </form>
            
            <p class="text-center text-gray-400 text-sm mt-6 italic">Discover your growth potential in 60 seconds.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('exit-popup');
    const card = document.getElementById('exit-popup-card');
    const overlay = document.getElementById('exit-popup-overlay');
    const closeBtn = document.getElementById('close-exit-popup');
    
    // Check if shown in this session (reset on browser close for testing, or use localStorage for persistent dismissal)
    let popupShown = sessionStorage.getItem('exit_popup_shown');
    
    function showPopup() {
        if (!popupShown) {
            popup.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
            sessionStorage.setItem('exit_popup_shown', 'true');
            popupShown = true;
        }
    }
    
    function hidePopup() {
        card.classList.add('scale-95', 'opacity-0');
        card.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            popup.classList.add('hidden');
        }, 300);
    }
    
    // Exit intent logic: mouse leaves top of window
    document.addEventListener('mouseleave', function(e) {
        if (e.clientY <= 0) {
            showPopup();
        }
    });
    
    // Close on X button click
    closeBtn.addEventListener('click', hidePopup);
    
    // Close on overlay click
    overlay.addEventListener('click', hidePopup);
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popup && !popup.classList.contains('hidden')) {
            hidePopup();
        }
    });
});
</script>