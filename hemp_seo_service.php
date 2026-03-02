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
    <?php
    // Fetch Hero content from hemp_hero table
    $hero = [];
    try {
        $stmt = $pdo->query("SELECT * FROM hemp_hero ORDER BY id DESC LIMIT 1");
        $hero = $stmt->fetch();
    } catch (Exception $e) {
    }

    // Fallbacks if database is empty
    if (!$hero) {
        $hero = [
            'title' => 'Hemp SEO Agency for <br>Organic Growth & Compliance',
            'subtitle' => 'Compliance-Focused SEO for Hemp Brands & in the E-commerce Industry',
            'btn1_text' => 'Get Free Hemp SEO Audit',
            'btn1_link' => '#audit',
            'btn2_text' => 'Schedule Strategy Call',
            'btn2_link' => '#contact',
            'stat1_number' => '500+',
            'stat1_text' => 'Hemp Clients Served',
            'stat2_number' => '98%',
            'stat2_text' => 'Compliance Rate',
            'stat3_number' => '3.2x',
            'stat3_text' => 'Average ROAS',
            'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop'
        ];
    }

    // Check if image is a URL or a file in uploads
    $hero_image_src = $hero['image'];
    if (!filter_var($hero_image_src, FILTER_VALIDATE_URL)) {
        $local_path = 'uploads/' . $hero_image_src;
        if (file_exists($local_path) && !empty($hero_image_src)) {
            $hero_image_src = $local_path;
        } else {
            // Fallback to a high-quality default if no local file or DB value
            $hero_image_src = 'https://images.unsplash.com/photo-1620188467120-5042ed1eb5da?q=80&w=2070&auto=format&fit=crop';
        }
    }

    // Fetch content for expertise from site_content table
    $content = [];
    try {
        $stmt = $pdo->prepare("SELECT content_key, content_value FROM site_content WHERE section_name = 'hemp_seo'");
        $stmt->execute();
        $content = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    } catch (Exception $e) {
    }

    $expertise_title = $content['expertise_title'] ?? 'Industry-Specific Hemp SEO Expertise';
    $expertise_description = $content['expertise_description'] ?? "The hemp industry operates under stringent marketing regulations. Product promotions, health claims, and advertising restrictions require a tailored SEO approach to ensure compliance while maximizing visibility. Here's how our Hemp SEO strategies stand out:";
    ?>

    <style>
        .hero-section {
            position: relative;
            background: linear-gradient(135deg, #1A3C34 0%, #0D2620 100%);
            padding: 120px 0;
            overflow: hidden;
            color: white;
        }

        .hero-bg-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.2;
            pointer-events: none;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #1A3C34 0%, rgba(26, 60, 52, 0.8) 50%, rgba(26, 60, 52, 0.4) 100%);
            pointer-events: none;
        }

        .hero-wrapper {
            display: flex;
            align-items: center;
            gap: 60px;
            position: relative;
            z-index: 10;
        }

        .hero-left {
            flex: 1.2;
        }

        .hero-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-featured-image {
            width: 100%;
            max-width: 600px;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            object-fit: cover;
            aspect-ratio: 4/3;
            transition: transform 0.3s ease;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            line-height: 1.1;
            font-weight: 700;
            margin-bottom: 24px;
            color: white;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #A8D5BA;
            margin-bottom: 40px;
            line-height: 1.6;
            max-width: 550px;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            margin-bottom: 60px;
        }

        .btn-primary-gold {
            background-color: #D4AF37;
            color: #1A3C34;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.2);
        }

        .btn-primary-gold:hover {
            transform: translateY(-3px);
            background-color: #C49F2F;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-secondary-outline {
            background: transparent;
            border: 2px solid white;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-secondary-outline:hover {
            background-color: white;
            color: #1A3C34;
        }

        .hero-stats {
            display: flex;
            gap: 48px;
            padding-top: 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            color: #D4AF37;
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-text {
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.9;
            margin-top: 4px;
        }

        @media (max-width: 1024px) {
            .hero-wrapper {
                flex-direction: column;
                text-align: center;
                gap: 40px;
            }

            .hero-left {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .hero-subtitle {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-stats {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .hero-title {
                font-size: 36px;
            }

            .hero-wrapper {
                gap: 30px;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
                gap: 15px;
            }

            .btn-primary-gold,
            .btn-secondary-outline {
                width: 100%;
                text-align: center;
            }

            .hero-stats {
                flex-wrap: wrap;
                gap: 24px;
                justify-content: center;
            }
        }
    </style>

    <!-- New Premium Hero Section -->
    <section class="hero-section">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2070&auto=format&fit=crop"
            class="hero-bg-image" alt="">
        <div class="hero-overlay"></div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="hero-wrapper">
                <!-- Left Content -->
                <div class="hero-left">
                    <h1 class="hero-title">
                        <?php echo $hero['title']; ?>
                    </h1>
                    <p class="hero-subtitle">
                        <?php echo htmlspecialchars($hero['subtitle']); ?>
                    </p>

                    <div class="hero-buttons">
                        <a href="<?php echo htmlspecialchars($hero['btn1_link']); ?>" class="btn-primary-gold">
                            <?php echo htmlspecialchars($hero['btn1_text']); ?>
                        </a>
                        <a href="<?php echo htmlspecialchars($hero['btn2_link']); ?>" class="btn-secondary-outline">
                            <?php echo htmlspecialchars($hero['btn2_text']); ?>
                        </a>
                    </div>

                    <!-- Stats Area -->
                    <div class="hero-stats">
                        <div class="stat-item">
                            <span class="stat-number"><?php echo htmlspecialchars($hero['stat1_number']); ?></span>
                            <span class="stat-text"><?php echo htmlspecialchars($hero['stat1_text']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo htmlspecialchars($hero['stat2_number']); ?></span>
                            <span class="stat-text"><?php echo htmlspecialchars($hero['stat2_text']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number"><?php echo htmlspecialchars($hero['stat3_number']); ?></span>
                            <span class="stat-text"><?php echo htmlspecialchars($hero['stat3_text']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right Content: Image -->
                <div class="hero-right">
                    <img src="<?php echo $hero_image_src; ?>" alt="Premium Hemp SEO Featured Illustration"
                        class="hero-featured-image">
                </div>
            </div>
        </div>
    </section>


    <!-- Expertise Section -->

    <section id="expertise" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">
                    <?php echo htmlspecialchars($expertise_title); ?>
                </h2>
                <div class="max-w-4xl mx-auto">
                    <p class="text-base md:text-lg text-[#1A1A1A] leading-relaxed mb-6">
                        <?php echo htmlspecialchars($expertise_description); ?>
                    </p>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="bg-[#F5F3EE] p-8 rounded-xl border-l-4 border-[#D4AF37]">
                    <div class="w-14 h-14 flex items-center justify-center bg-[#1F4D45] rounded-lg mb-4"><i
                            class="ri-alert-line text-[#D4AF37] text-2xl"></i></div>
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Why Generic SEO
                        Agencies Fail in the Hemp Industry</h3>
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
                        <p class="text-white/90 leading-relaxed">Hemp-related search terms are under heightened scrutiny
                            by Google’s YMYL (Your Money Your Life) algorithms.
                            With volatility up to 3x higher than standard e-commerce, our agency monitors
                            industry-specific updates and adjusts strategies to maintain stable rankings.</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#1F4D45] to-[#2F5E57] p-8 rounded-xl text-white">
                        <div
                            class="w-14 h-14 flex items-center justify-center bg-[#D4AF37] rounded-lg mb-4 text-[#1F4D45] font-bold text-xl uppercase">
                            Ad
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold mb-3">Advertising Restrictions</h3>
                        <ul class="space-y-3 text-white/90">
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Google Ads
                                    Bans all hemp-related ads and promotions.</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Facebook/Instagram
                                    Prohibit hemp product advertising.</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>TikTok, Snapchat,
                                    and YouTube Enforce strict bars.</span></li>
                            <li class="flex items-center gap-3"><i
                                    class="ri-checkbox-circle-fill text-[#D4AF37] text-xl"></i><span>Affiliate networks
                                    Limit hemp market participation.</span></li>
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
                        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-3">Compliance Risks in
                            Hemp SEO
                        </h3>
                        <p class="text-[#1A1A1A] text-base leading-relaxed">
                            Non-compliant SEO strategies can lead to <strong class="text-red-700 font-bold">FDA warning
                                letters</strong>, platform penalties, and even legal action. Our SEO strategies
                            prioritize
                            regulatory compliance while driving organic visibility to protect your brand and its
                            rankings.

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategy / Services Section -->
    <style>
        /* Why Choose + Our Process Card */
        .strategy-intro-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.07);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            overflow: hidden;
            margin-bottom: 56px;
        }

        @media (max-width: 768px) {
            .strategy-intro-card {
                grid-template-columns: 1fr;
            }
        }

        /* Left panel */
        .strategy-why-col {
            padding: 48px 44px;
            border-right: 1px solid #f0ede8;
        }

        @media (max-width: 768px) {
            .strategy-why-col {
                border-right: none;
                border-bottom: 1px solid #f0ede8;
                padding: 36px 28px;
            }
        }

        .strategy-why-col h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: #1A3C34;
            margin-bottom: 14px;
        }

        .strategy-why-col p {
            font-size: 0.95rem;
            color: #4b616b;
            line-height: 1.75;
            margin-bottom: 26px;
        }

        .strategy-check-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .strategy-check-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            color: #1A3C34;
            font-weight: 500;
        }

        .strategy-check-list li .check-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #1A3C34;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .strategy-check-list li .check-icon i {
            color: #D4AF37;
            font-size: 0.9rem;
        }

        /* Right panel – Our Process */
        .strategy-process-col {
            padding: 48px 44px;
        }

        @media (max-width: 768px) {
            .strategy-process-col {
                padding: 36px 28px;
            }
        }

        .strategy-process-col h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.55rem;
            font-weight: 700;
            color: #1A3C34;
            margin-bottom: 28px;
        }

        .process-steps {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .process-step {
            display: flex;
            align-items: flex-start;
            gap: 18px;
        }

        .process-step-num {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #D4AF37;
            color: #1A3C34;
            font-weight: 800;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
        }

        .process-step-body h4 {
            font-weight: 700;
            font-size: 0.97rem;
            color: #1A3C34;
            margin-bottom: 3px;
        }

        .process-step-body p {
            font-size: 0.875rem;
            color: #6b7c8a;
            line-height: 1.5;
        }
    </style>

    <section id="strategy" class="py-20 bg-[#F5F3EE]">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-5">Our Services &
                    Strategy</h2>
                <p class="text-lg text-[#1A1A1A] max-w-3xl mx-auto">A comprehensive, compliance-first approach to
                    sustainable organic growth for hemp and vape brands.</p>
            </div>

            <!-- Why Choose + Our Process Card -->
            <div class="strategy-intro-card">

                <!-- Left: Why Choose Our Agency -->
                <div class="strategy-why-col">
                    <h3>Why Choose Our Hemp SEO Agency?</h3>
                    <p>Unlike general SEO agencies, we specialize exclusively in hemp, CBD, cannabis, and vape
                        industries. Our team understands the unique challenges of marketing in restricted niches and has
                        developed proven strategies that deliver results while maintaining full compliance.</p>
                    <ul class="strategy-check-list">
                        <li>
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            5+ years of hemp industry experience
                        </li>
                        <li>
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            Transparent weekly reporting and analytics
                        </li>
                        <li>
                            <span class="check-icon"><i class="ri-check-line"></i></span>
                            100% compliance guarantee
                        </li>
                    </ul>
                </div>

                <!-- Right: Our Process -->
                <div class="strategy-process-col">
                    <h3>Our Process</h3>
                    <ol class="process-steps">
                        <li class="process-step">
                            <div class="process-step-num">1</div>
                            <div class="process-step-body">
                                <h4>Audit &amp; Analysis</h4>
                                <p>Comprehensive SEO audit and competitor analysis</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="process-step-num">2</div>
                            <div class="process-step-body">
                                <h4>Strategy Development</h4>
                                <p>Custom SEO roadmap tailored to your business</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="process-step-num">3</div>
                            <div class="process-step-body">
                                <h4>Implementation</h4>
                                <p>Execute optimization and content strategies</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="process-step-num">4</div>
                            <div class="process-step-body">
                                <h4>Monitor &amp; Optimize</h4>
                                <p>Continuous tracking and performance improvement</p>
                            </div>
                        </li>
                    </ol>
                </div>

            </div><!-- /.strategy-intro-card -->

            <!-- Service Cards Grid -->
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


    <!-- ==========================================
         INDUSTRIES WE SERVE SECTION
    ========================================== -->
    <style>
        /* ---- Industries Section ---- */
        .industries-section {
            background: #f7f6f3;
            padding: 100px 0;
        }

        .industries-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .industries-heading {
            font-family: 'Playfair Display', serif;
            font-size: 2.75rem;
            font-weight: 700;
            color: #1A3C34;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .industries-subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ---- Tab Pills ---- */
        .industries-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 56px;
        }

        .ind-tab {
            padding: 12px 28px;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            background: #e5e7eb;
            color: #374151;
            transition: background 0.3s ease, color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .ind-tab:hover {
            background: #d1d5db;
            transform: translateY(-2px);
        }

        .ind-tab.ind-tab--active {
            background: #1A3C34;
            color: #ffffff;
            box-shadow: 0 6px 20px rgba(26, 60, 52, 0.25);
        }

        /* ---- Two-Column Content ---- */
        .industries-content {
            display: none;
        }

        .industries-content.is-active {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .ind-image-col {
            flex: 1;
        }

        .ind-image-col img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 55px rgba(0, 0, 0, 0.15);
            object-fit: cover;
            aspect-ratio: 4/3;
            display: block;
        }

        .ind-content-col {
            flex: 1;
            background: #ffffff;
            border-radius: 20px;
            padding: 48px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .ind-icon-box {
            width: 56px;
            height: 56px;
            background: #1A3C34;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .ind-icon-box i {
            color: #D4AF37;
            font-size: 1.6rem;
        }

        .ind-content-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #1A3C34;
            margin-bottom: 18px;
        }

        .ind-content-text {
            font-size: 1rem;
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .ind-feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .ind-feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.95rem;
            color: #374151;
        }

        .ind-feature-list li i {
            color: #D4AF37;
            font-size: 1.1rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* ---- Responsive ---- */
        @media (max-width: 1024px) {
            .industries-content.is-active {
                flex-direction: column;
                gap: 36px;
            }

            .ind-image-col,
            .ind-content-col {
                width: 100%;
                flex: unset;
            }
        }

        @media (max-width: 768px) {
            .industries-section {
                padding: 60px 0;
            }

            .industries-heading {
                font-size: 2rem;
            }

            .ind-content-col {
                padding: 28px;
            }

            .ind-tab {
                padding: 10px 20px;
                font-size: 0.875rem;
            }
        }
    </style>

    <section class="industries-section" id="industries">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="industries-header">
                <h2 class="industries-heading">Industries We Serve</h2>
                <p class="industries-subtitle">Specialized SEO strategies crafted for every corner of the hemp and
                    cannabis industry.</p>
            </div>

            <!-- Tab Navigation -->
            <div class="industries-tabs" role="tablist" aria-label="Industries">
                <button class="ind-tab ind-tab--active" role="tab" data-target="tab-hemp" aria-selected="true">
                    🌿 Hemp Brands
                </button>
                <button class="ind-tab" role="tab" data-target="tab-cbd" aria-selected="false">
                    🛒 CBD Stores
                </button>
                <button class="ind-tab" role="tab" data-target="tab-dispensaries" aria-selected="false">
                    🏪 Dispensaries
                </button>
                <button class="ind-tab" role="tab" data-target="tab-vape" aria-selected="false">
                    💨 Vape Shops
                </button>
            </div>

            <!-- Tab Content Panels -->

            <!-- Hemp Brands -->
            <div class="industries-content is-active" id="tab-hemp" role="tabpanel">
                <div class="ind-image-col">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2070&auto=format&fit=crop"
                        alt="Hemp Brand SEO">
                </div>
                <div class="ind-content-col">
                    <div class="ind-icon-box">
                        <i class="ri-plant-line"></i>
                    </div>
                    <h3 class="ind-content-title">Hemp Brand SEO</h3>
                    <p class="ind-content-text">We craft compliant, high-converting SEO strategies specifically designed
                        for hemp brands navigating strict digital marketing regulations. From topical authority building
                        to FDA-compliant content, we drive real organic growth.</p>
                    <ul class="ind-feature-list">
                        <li><i class="ri-checkbox-circle-fill"></i> Compliance-first content strategy & copy</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Hemp-specific keyword research & targeting</li>
                        <li><i class="ri-checkbox-circle-fill"></i> E-commerce SEO for product catalog growth</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Google algorithm sensitivity monitoring</li>
                    </ul>
                </div>
            </div>

            <!-- CBD Stores -->
            <div class="industries-content" id="tab-cbd" role="tabpanel">
                <div class="ind-image-col">
                    <img src="https://images.unsplash.com/photo-1581600140682-d4e68c8cde32?q=80&w=2070&auto=format&fit=crop"
                        alt="CBD Store SEO">
                </div>
                <div class="ind-content-col">
                    <div class="ind-icon-box">
                        <i class="ri-store-2-line"></i>
                    </div>
                    <h3 class="ind-content-title">CBD Store SEO</h3>
                    <p class="ind-content-text">CBD stores face unique online visibility challenges. Our specialized SEO
                        for CBD retailers focuses on earning trust signals, building domain authority, and targeting
                        high-intent shoppers searching for quality CBD products.</p>
                    <ul class="ind-feature-list">
                        <li><i class="ri-checkbox-circle-fill"></i> Schema markup & product structured data</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Collection & category page optimization</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Trust & authority link building campaigns</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Conversion rate optimization for CBD buyers</li>
                    </ul>
                </div>
            </div>

            <!-- Dispensaries -->
            <div class="industries-content" id="tab-dispensaries" role="tabpanel">
                <div class="ind-image-col">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&w=2070&auto=format&fit=crop"
                        alt="Dispensary SEO">
                </div>
                <div class="ind-content-col">
                    <div class="ind-icon-box">
                        <i class="ri-map-pin-2-line"></i>
                    </div>
                    <h3 class="ind-content-title">Dispensary Local SEO</h3>
                    <p class="ind-content-text">Dispensaries depend on local foot traffic and Google Maps rankings. We
                        specialize in local SEO strategies that put your dispensary at the top of "near me" searches,
                        Google Business Profile optimization, and geo-targeted content.</p>
                    <ul class="ind-feature-list">
                        <li><i class="ri-checkbox-circle-fill"></i> Google Business Profile optimization</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Local citation building & NAP consistency</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Geo-targeted landing pages & content</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Review generation & reputation management</li>
                    </ul>
                </div>
            </div>

            <!-- Vape Shops -->
            <div class="industries-content" id="tab-vape" role="tabpanel">
                <div class="ind-image-col">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop"
                        alt="Vape Shop SEO">
                </div>
                <div class="ind-content-col">
                    <div class="ind-icon-box">
                        <i class="ri-cloud-line"></i>
                    </div>
                    <h3 class="ind-content-title">Vape Shop SEO</h3>
                    <p class="ind-content-text">Vape shops operate in one of the most volatile SEO landscapes. Our team
                        provides algorithm-resistant strategies that build stable rankings and drive consistent traffic
                        to your vape store — both locally and nationally.</p>
                    <ul class="ind-feature-list">
                        <li><i class="ri-checkbox-circle-fill"></i> Age-gate optimization & UX compliance</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Device & e-liquid product page SEO</li>
                        <li><i class="ri-checkbox-circle-fill"></i> SERP volatility monitoring & recovery</li>
                        <li><i class="ri-checkbox-circle-fill"></i> Brand authority building through content</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <script>
        (function () {
            const tabs = document.querySelectorAll('.ind-tab');
            const panels = document.querySelectorAll('.industries-content');

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    // Deactivate all tabs and panels
                    tabs.forEach(function (t) {
                        t.classList.remove('ind-tab--active');
                        t.setAttribute('aria-selected', 'false');
                    });
                    panels.forEach(function (p) {
                        p.classList.remove('is-active');
                    });

                    // Activate clicked tab
                    tab.classList.add('ind-tab--active');
                    tab.setAttribute('aria-selected', 'true');

                    // Show matching panel
                    var target = tab.getAttribute('data-target');
                    var panel = document.getElementById(target);
                    if (panel) {
                        panel.classList.add('is-active');
                    }
                });
            });
        })();
    </script>

    <!-- Keyword Research Section -->
    <section id="keyword-research" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold text-[#1F4D45] mb-6">Hemp Keyword
                    Research Process</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Strategic keyword targeting is vital for balancing
                    search volume, commercial intent, and compliance with industry regulations. We focus on keywords
                    that generate traffic while adhering to legal constraints.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Vape Device Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Hemp Product Keywords
                    </h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">High-intent product searches with strong
                        commercial value. Focus on specific device types, brands, and technical specifications.</p>

                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">buy hemp products online</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <!-- Item 2 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">organic hemp oil
                                </h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <!-- Item 3 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">hemp gummies for sleep</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- E-Liquid & Flavor Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Hemp Brand Keywords
                    </h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Product-focused searches with immediate
                        purchase intent. Emphasize flavor profiles, nicotine strengths, and brand-specific queries.</p>

                    <div class="space-y-4">
                        <!-- Item 1 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">lab-tested hemp products</h4>
                                <p class="text-[13px] text-gray-500">Intent: Transactional</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <!-- Item 2 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">licensed hemp brand</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <!-- Item 3 -->
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">organic certified hemp</h4>
                                <p class="text-[13px] text-gray-500">Intent: Commercial</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>
                <!-- Educational & How-To Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Hemp Educational &
                        Informational Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Top-of-funnel content opportunities that
                        build topical authority and capture early-stage researchers.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">what is hemp used for</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">difference between hemp and CBD</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#DCFCE7] text-[#166534] text-[11px] font-bold rounded-full">Low</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">how hemp is grown</h4>
                                <p class="text-[13px] text-gray-500">Intent: Informational</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>

                <!-- Local Vape Shop Keywords -->
                <div class="bg-[#F5F3EE] p-10 rounded-2xl border-l-[6px] border-[#D4AF37] shadow-sm">
                    <h3 class="font-['Playfair_Display'] text-2xl font-bold text-[#1F4D45] mb-4">Local Hemp Shop
                        Keywords</h3>
                    <p class="text-[#1F4D45]/80 mb-8 text-sm leading-relaxed">Geo-targeted searches for brick-and-mortar
                        locations. Critical for local SEO and Google Business Profile optimization.</p>

                    <div class="space-y-4">
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">hemp shop near me</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEE2E2] text-[#991B1B] text-[11px] font-bold rounded-full">High</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">hemp store [city name]</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                        <div
                            class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-[#1F4D45] text-base mb-1">buy hemp products locally</h4>
                                <p class="text-[13px] text-gray-500">Intent: Local</p>
                            </div>
                            <span
                                class="px-3 py-1 bg-[#FEF3C7] text-[#92400E] text-[11px] font-bold rounded-full">Medium</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <!-- Keyword Methodology Section -->
    <section class="py-16 bg-[#1F4D45] text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white/20 rounded-full -mr-48 -mt-48 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#D4AF37]/20 rounded-full -ml-32 -mb-32 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <h2 class="font-['Playfair_Display'] text-3xl md:text-4xl font-bold mb-12 text-left">Our Keyword Research
                Methodology</h2>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-transform group-hover:scale-110">
                                <i class="ri-checkbox-circle-fill text-[#1F4D45] text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Competitor gap analysis</h4>
                                <p class="text-white/70 leading-relaxed text-sm">Identify keywords your competitors rank
                                    for that you don't</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-transform group-hover:scale-110">
                                <i class="ri-checkbox-circle-fill text-[#1F4D45] text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Search intent mapping</h4>
                                <p class="text-white/70 leading-relaxed text-sm">Align keywords with buyer journey
                                    stages</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-transform group-hover:scale-110">
                                <i class="ri-checkbox-circle-fill text-[#1F4D45] text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Compliance filtering</h4>
                                <p class="text-white/70 leading-relaxed text-sm">Remove restricted terms and health
                                    claim triggers</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-transform group-hover:scale-110">
                                <i class="ri-checkbox-circle-fill text-[#1F4D45] text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Difficulty scoring</h4>
                                <p class="text-white/70 leading-relaxed text-sm">Prioritize quick wins and long-term
                                    authority plays</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3 group">
                            <div
                                class="w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center flex-shrink-0 mt-1 transition-transform group-hover:scale-110">
                                <i class="ri-checkbox-circle-fill text-[#1F4D45] text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-1">Seasonal trend analysis</h4>
                                <p class="text-white/70 leading-relaxed text-sm">Capitalize on cyclical search patterns
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Right Card -->
                <div class="relative">
                    <div
                        class="bg-white/5 backdrop-blur-md p-8 md:p-12 rounded-[2rem] border border-white/10 text-center shadow-2xl relative z-20">
                        <div
                            class="w-16 h-16 bg-[#D4AF37] rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl">
                            <i class="ri-search-line text-[#1F4D45] text-3xl"></i>
                        </div>
                        <h3 class="font-['Playfair_Display'] text-2xl md:text-3xl font-bold mb-4">Custom Keyword
                            Strategy</h3>
                        <p class="text-white/80 mb-8 leading-relaxed text-base">Every hemp brand has unique positioning,
                            product mix, and target audience. We build custom keyword strategies tailored to your
                            specific business goals.</p>
                        <a href="#audit"
                            class="block w-full bg-[#D4AF37] text-[#1F4D45] py-4 rounded-xl font-bold text-lg hover:bg-[#C49F2F] transition-all hover:scale-[1.02] shadow-2xl">
                            Get Your Keyword Strategy
                        </a>
                    </div>
                    <!-- Background Glow -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-[#D4AF37]/5 rounded-full blur-[100px] -z-10">
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
                    for Hemp Stores</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Foundation-level optimization that ensures search
                    engines can crawl, index, and rank your hemp e-commerce site</p>
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
                                ensure consistent formatting across your hemp product catalog.</p>
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
                    Platform-Specific Hemp SEO Expertise</h2>
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
                        <p class="text-gray-700 text-lg mb-10 leading-relaxed">Running a custom-built hemp e-commerce
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
                                results-driven hemp SEO strategies that work with your existing infrastructure.</p>
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
                    Leading Hemp Brands</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Real results from real hemp businesses that chose
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
                    <h2 class="font-['Playfair_Display'] text-3xl md:text-5xl font-bold mb-6">Join 50+ Hemp Brands
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
                            <h3 class="font-bold text-[#1F4D45] text-lg mb-2">
                                <?php echo htmlspecialchars($f['question']); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php echo htmlspecialchars($f['answer']); ?>
                            </p>
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
                        Free Hemp SEO Roadmap</h2>
                    <p class="text-gray-700 text-lg mb-10 leading-relaxed">Discover exactly what's holding your hemp
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
                                <input type="email" name="email" required placeholder="john@hempbrand.com"
                                    class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-[#D4AF37] focus:ring-4 focus:ring-[#D4AF37]/10 outline-none transition-all bg-white">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1F4D45] uppercase tracking-wider mb-2">Website
                                URL *</label>
                            <input type="url" name="url" required placeholder="https://yourhempsore.com"
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
