<?php
$inputFile = __DIR__ . '/Hemp SEO Agency _ CBD, Cannabis & Vape SEO Services _ HempSuccess.html';
$html = file_get_contents($inputFile);

if ($html === false) {
    die("Failed to read input file.");
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

function savePart($filename, $content)
{
    global $dom;
    if (is_array($content)) {
        $fullContent = '';
        foreach ($content as $node) {
            $fullContent .= $dom->saveHTML($node);
        }
        file_put_contents(__DIR__ . '/includes/' . $filename, $fullContent);
    } else {
        file_put_contents(__DIR__ . '/includes/' . $filename, $dom->saveHTML($content));
    }
    echo "Saved " . $filename . "\n";
}

// Ensure includes directory exists
if (!is_dir(__DIR__ . '/includes')) {
    mkdir(__DIR__ . '/includes', 0777, true);
}

// Header: Lines 1-86 + <header> element
// Actually, extracting specific elements is easier.
// But we want to preserve the surrounding structure too.

// Let's extract specific sections.

// 1. Head
$head = $dom->getElementsByTagName('head')->item(0);
// We need the DOCTYPE and HTML tag too, but DOMDocument handles fragments weirdly.
// Let's just save the head content.
// And manually construct header.php later.

// 2. Header (Navigation)
$headerNode = $dom->getElementsByTagName('header')->item(0);
if ($headerNode)
    savePart('navbar.php', $headerNode);

// 3. Hero Section
$sections = $dom->getElementsByTagName('section');
if ($sections->length > 0)
    savePart('hero.php', $sections->item(0));

// 4. Trusted Brands (2nd section)
if ($sections->length > 1)
    savePart('trusted-brands.php', $sections->item(1));

// 5. Why Us (3rd section)
if ($sections->length > 2)
    savePart('why-us.php', $sections->item(2));

// 6. Services (4th section, id="services")
// Let's find by ID to be robust.
$servicesNode = $dom->getElementById('services');
if ($servicesNode)
    savePart('services.php', $servicesNode);

// 7. Industries (id="industries")
$industriesNode = $dom->getElementById('industries');
if ($industriesNode)
    savePart('industries.php', $industriesNode);

// 8. Process (py-20 bg-[#1A3C34]) - Assume it's the section after industries?
// Let's check section order.
// Section 0: Hero
// Section 1: Trusted Brands
// Section 2: Why Us
// Section 3: Services
// Section 4: Industries
// Section 5: Process (based on original content reading)
// Section 6: Case Studies
// Section 7: Testimonials
// Section 8: Audit/FAQ
if ($sections->length > 5)
    savePart('process.php', $sections->item(5));

// 9. Case Studies (id="case-studies")
$caseStudiesNode = $dom->getElementById('case-studies');
if ($caseStudiesNode)
    savePart('case-studies.php', $caseStudiesNode);

// 10. Testimonials (py-20 bg-[#F8F9FA]?) - Section 7
if ($sections->length > 7)
    savePart('testimonials.php', $sections->item(7));

// 11. Audit/FAQ (id="audit")
$auditNode = $dom->getElementById('audit');
if ($auditNode)
    savePart('audit.php', $auditNode);

// 12. Footer
$footerNode = $dom->getElementsByTagName('footer')->item(0);
if ($footerNode)
    savePart('footer-content.php', $footerNode);

echo "Extraction complete.\n";
?>