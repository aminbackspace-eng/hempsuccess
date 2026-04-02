<?php
require_once __DIR__ . '/../config/db.php';
$contact = [
    'email' => 'info@hempsuccess.com',
    'phone' => '(555) 123-4567',
    'address' => '123 Hemp Street<br>Denver, CO 80202'
];
if ($pdo instanceof PDO) {
    try {
        $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'contact'");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        foreach ($contact as $key => $val) {
            if (isset($results[$key]))
                $contact[$key] = ($key == 'address') ? nl2br($results[$key]) : $results[$key];
        }
    } catch (Throwable $e) {
    }
}
?>
<footer class="bg-[#1A3C34] text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <div><img alt="HempSuccess Logo" class="h-12 w-auto mb-6"
                    src="./Hemp%20SEO%20Agency%20_%20CBD,%20Cannabis%20&amp;%20Vape%20SEO%20Services%20_%20HempSuccess_files/6d1fec57-d3aa-43dd-bd9f-9caa2a604a27.png">
                <p class="text-white/80 mb-6">Leading Hemp SEO Agency specializing in SEO and Google Ads for hemp, CBD,
                    cannabis, and vape industries.</p>
                <div class="flex gap-4"><a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#D4AF37] transition-colors cursor-pointer"><i
                            class="ri-facebook-fill text-xl"></i></a><a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#D4AF37] transition-colors cursor-pointer"><i
                            class="ri-twitter-x-fill text-xl"></i></a><a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#D4AF37] transition-colors cursor-pointer"><i
                            class="ri-linkedin-fill text-xl"></i></a><a href="#"
                        class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-[#D4AF37] transition-colors cursor-pointer"><i
                            class="ri-instagram-fill text-xl"></i></a></div>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-6">Services</h4>
                <ul class="space-y-3">
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Hemp SEO
                            Services</a></li>
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">CBD SEO
                            Services</a></li>
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Cannabis SEO</a>
                    </li>
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Vape SEO</a>
                    </li>
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Local SEO for
                            Dispensaries</a></li>
                    <li><a href="#services"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Google Ads for
                            CBD</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-6">Industries</h4>
                <ul class="space-y-3">
                    <li><a href="#industries"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Hemp Brands</a>
                    </li>
                    <li><a href="#industries"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">CBD Stores</a>
                    </li>
                    <li><a href="#industries"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Dispensaries</a>
                    </li>
                    <li><a href="#industries"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Vape Shops</a>
                    </li>
                    <li><a href="#case-studies"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Case Studies</a>
                    </li>
                    <li><a href="#resources"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">Resources</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-bold mb-6">Contact</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3"><i
                            class="ri-mail-line text-[#D4AF37] text-xl flex-shrink-0 mt-1"></i><a
                            href="mailto:<?php echo $contact['email']; ?>"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">
                            <?php echo $contact['email']; ?>
                        </a></li>
                    <li class="flex items-start gap-3"><i
                            class="ri-phone-line text-[#D4AF37] text-xl flex-shrink-0 mt-1"></i><a
                            href="tel:<?php echo $contact['phone']; ?>"
                            class="text-white/80 hover:text-[#D4AF37] transition-colors cursor-pointer">
                            <?php echo $contact['phone']; ?>
                        </a></li>
                    <li class="flex items-start gap-3"><i
                            class="ri-map-pin-line text-[#D4AF37] text-xl flex-shrink-0 mt-1"></i><span
                            class="text-white/80">
                            <?php echo $contact['address']; ?>
                        </span></li>
                </ul><a href="#audit"
                    class="inline-block mt-6 bg-[#D4AF37] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#C19B2E] transition-colors cursor-pointer whitespace-nowrap">Get
                    Free Audit</a>
            </div>
        </div>
        <div class="pt-8 border-t border-white/10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/60 text-sm text-center md:text-left">© 2025 HempSuccess. All rights reserved. | <a
                        href="https://readdy.ai/?ref=logo"
                        class="hover:text-[#D4AF37] transition-colors cursor-pointer">Powered by Readdy</a></p>
                <div class="flex gap-6"><a href="#privacy"
                        class="text-white/60 hover:text-[#D4AF37] transition-colors text-sm cursor-pointer">Privacy
                        Policy</a><a href="#terms"
                        class="text-white/60 hover:text-[#D4AF37] transition-colors text-sm cursor-pointer">Terms of
                        Service</a><a href="#sitemap"
                        class="text-white/60 hover:text-[#D4AF37] transition-colors text-sm cursor-pointer">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>