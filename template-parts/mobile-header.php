<?php
// Check if we're viewing a specific page to set active states
$current_url = $_SERVER['REQUEST_URI'];
$targetUrl = trim($current_url, '/');

// Helper function to check if menu item is active
function is_menu_active($url, $targetUrl) {
    $normalizedTarget = strtolower(trim($targetUrl, '/'));
    $normalizedMenuUrl = strtolower(trim($url, '/'));
    
    return $normalizedTarget === $normalizedMenuUrl || 
           ($normalizedTarget === '' && $normalizedMenuUrl === '') ||
           ($normalizedTarget === 'index' && $normalizedMenuUrl === '');
}

// Helper function to create mobile menu items
function create_mobile_menu_item($url, $icon, $title, $isExternal = false) {
    global $targetUrl;
    
    $isActive = is_menu_active($url, $targetUrl);
    $classAttr = $isActive ? 'current mobile-submenu-item' : 'mobile-submenu-item';
    $href = $isExternal ? $url : home_url($url);
    
    // Handle icon - check if it's an image path or CSS class
    if (strpos($icon, '/') !== false || strpos($icon, 'http') !== false) {
        $iconHtml = '<img src="' . get_stylesheet_directory_uri() . $icon . '" alt="' . $title . '" class="mobile-menu-icon">';
    } else {
        $iconHtml = '<div class="header-icon ' . $icon . '"></div>';
    }
    
    return '
        <a href="' . $href . '" class="' . $classAttr . '">
            ' . $iconHtml . '
            <span>' . $title . '</span>
        </a>';
}
?>

<!-- Mobile Menu Toggle Button -->
<button class="mobile-menu-toggle" type="button" aria-label="Toggle navigation menu">
    <span class="hamburger-line"></span>
    <span class="hamburger-line"></span>
    <span class="hamburger-line"></span>
</button>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-overlay"></div>
    <div class="mobile-nav-content">
        <div class="mobile-nav-header">
            <a href="<?php echo home_url('/'); ?>" class="mobile-logo">
                <div class="oneroyal-logo"></div>
            </a>
            <button class="mobile-nav-close" type="button" aria-label="Close navigation menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <div class="mobile-nav-body">
            <!-- Trading Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Trade</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/gold-silver-trading', '/images/icons/header-icons/trade-icon-01.svg', 'Gold'); ?>
                    <?php echo create_mobile_menu_item('/forex-trading', '/images/icons/header-icons/trade-icon-02.svg', 'Forex'); ?>
                    <?php echo create_mobile_menu_item('/oil-trading', '/images/icons/header-icons/trade-icon-03.svg', 'Oil Trading'); ?>
                    <?php echo create_mobile_menu_item('/indices-trading', '/images/icons/header-icons/trade-icon-04.svg', 'Indices'); ?>
                    <?php echo create_mobile_menu_item('/crypto-trading', '/images/icons/header-icons/trade-icon-05.svg', 'Cryptocurrency'); ?>
                    <?php echo create_mobile_menu_item('/shares-trading', '/images/icons/header-icons/trade-icon-06.svg', 'Shares'); ?>
                    <?php echo create_mobile_menu_item('/etfs-trading', '/images/icons/header-icons/trade-icon-07.svg', 'ETFs'); ?>
                    <?php echo create_mobile_menu_item('/ai-trading', '/images/icons/header-icons/trade-icon-08.svg', 'AI Tools'); ?>
                    <?php echo create_mobile_menu_item('/ai-trading/technical-analysis', '/images/icons/header-icons/trade-icon-09.svg', 'AI Technical Analysis'); ?>
                </div>
            </div>

            <!-- Accounts Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Accounts</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/accounts', '/images/icons/header-icons/accounts-icon-01.svg', 'Compare Accounts'); ?>
                    <?php echo create_mobile_menu_item('/accounts/classic', '/images/icons/header-icons/accounts-icon-02.svg', 'Classic Accounts'); ?>
                    <?php echo create_mobile_menu_item('/accounts/ecn', '/images/icons/header-icons/accounts-icon-03.svg', 'ECN Accounts'); ?>
                    <?php echo create_mobile_menu_item('/accounts/copy-trading', '/images/icons/header-icons/accounts-icon-04.svg', 'Copy Trading'); ?>
                    <?php echo create_mobile_menu_item('/accounts/prime', '/images/icons/header-icons/accounts-icon-05.svg', 'Prime Accounts'); ?>
                    <?php echo create_mobile_menu_item('/accounts/swap-free', '/images/icons/header-icons/accounts-icon-06.svg', 'Swap-Free Account'); ?>
                    <?php echo create_mobile_menu_item('/accounts/funding', '/images/icons/header-icons/accounts-icon-07.svg', 'Funding Options'); ?>
                    <?php echo create_mobile_menu_item('/accounts/pamm-investing', '/images/icons/header-icons/accounts-icon-08.svg', 'PAMM Investing'); ?>
                    <?php echo create_mobile_menu_item('/accounts/risk-management', '/images/icons/header-icons/accounts-icon-09.svg', 'Risk Management'); ?>
                </div>
            </div>

            <!-- Platforms Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Platforms</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/compare-platforms', '/images/icons/header-icons/platforms-icon-01.svg', 'Compare Platforms'); ?>
                    <?php echo create_mobile_menu_item('/mt5-platform', '/images/icons/header-icons/platforms-icon-02.png', 'MT5 Platform'); ?>
                    <?php echo create_mobile_menu_item('/mt4-platform', '/images/icons/header-icons/platforms-icon-03.png', 'MT4 Platform'); ?>
                    <?php echo create_mobile_menu_item('/webtrader', '/images/icons/header-icons/platforms-icon-04.png', 'WebTrader'); ?>
                    <?php echo create_mobile_menu_item('/accelerator', '/images/icons/header-icons/platforms-icon-05.png', 'Accelerator'); ?>
                    <?php echo create_mobile_menu_item('/multiterminal', '/images/icons/header-icons/platforms-icon-06.svg', 'MultiTerminal'); ?>
                    <?php echo create_mobile_menu_item('/demo-account', '/images/icons/header-icons/platforms-icon-07.svg', 'Demo Account'); ?>
                    <?php echo create_mobile_menu_item('/metafx', '/images/icons/header-icons/platforms-icon-08.svg', 'MetaFX'); ?>
                    <?php echo create_mobile_menu_item('/vps-hosting', '/images/icons/header-icons/platforms-icon-09.svg', 'VPS Hosting'); ?>
                </div>
            </div>

            <!-- Promotions Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Promotions</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/promotions', '/images/icons/header-icons/promotions-icon-01.svg', 'All Promotions'); ?>
                    <?php echo create_mobile_menu_item('/promotions/welcome-bonus', '/images/icons/header-icons/promotions-icon-02.svg', 'Welcome Bonus'); ?>
                    <?php echo create_mobile_menu_item('/promotions/100-bonus', '/images/icons/header-icons/promotions-icon-03.svg', '100% Bonus'); ?>
                    <?php echo create_mobile_menu_item('/ai-trading', '/images/icons/header-icons/promotions-icon-04.svg', 'AI Trading'); ?>
                    <?php echo create_mobile_menu_item('/promotions/trading-contests', '/images/icons/header-icons/promotions-icon-05.svg', 'Trading Contests'); ?>
                    <?php echo create_mobile_menu_item('/trading-app', '/images/icons/header-icons/promotions-icon-06.svg', 'Trading App'); ?>
                    <?php echo create_mobile_menu_item('/accounts/loyalty-programme', '/images/icons/header-icons/promotions-icon-07.svg', 'Loyalty Programme'); ?>
                </div>
            </div>

            <!-- Education Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Education</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('//oneroyal.academy', '/images/icons/header-icons/academy-icon-01.svg', 'Academy', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/getting-started', '/images/icons/header-icons/academy-icon-02.svg', 'Getting Started', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/platforms', '/images/icons/header-icons/academy-icon-03.svg', 'Platform Guides', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/trading-accounts', '/images/icons/header-icons/academy-icon-04.svg', 'Trading Accounts', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/learn-the-markets', '/images/icons/header-icons/academy-icon-05.svg', 'Learn Markets', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/webinars', '/images/icons/header-icons/academy-icon-06.svg', 'Webinars', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/building-strategies', '/images/icons/header-icons/academy-icon-07.svg', 'Building Strategies', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/understanding-indicators', '/images/icons/header-icons/academy-icon-08.svg', 'Understanding Indicators', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.academy/trading-eas', '/images/icons/header-icons/academy-icon-09.svg', 'Trading EAs', true); ?>
                </div>
            </div>

            <!-- News Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>News</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('//oneroyal.news/', '/images/icons/header-icons/news-icon-01.svg', 'News', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/live-stream', '/images/icons/header-icons/news-icon-02.svg', 'Live Stream', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/podcasts-video', '/images/icons/header-icons/news-icon-03.svg', 'Podcasts & Video', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/trade-ideas', '/images/icons/header-icons/news-icon-04.svg', 'Trade Ideas', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/daily-analysis', '/images/icons/header-icons/news-icon-05.svg', 'Daily Analysis', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/market-analysis', '/images/icons/header-icons/news-icon-06.svg', 'Market Analysis', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/economic-events', '/images/icons/header-icons/news-icon-07.svg', 'Economic Events', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/markets-to-watch', '/images/icons/header-icons/news-icon-08.svg', 'Markets to Watch', true); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/special-reports', '/images/icons/header-icons/news-icon-09.svg', 'Special Reports', true); ?>
                </div>
            </div>

            <!-- About Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>About</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/why-us', '/images/icons/header-icons/about-icon-01.svg', 'Why OneRoyal'); ?>
                    <?php echo create_mobile_menu_item('/awards-honours', '/images/icons/header-icons/about-icon-02.svg', 'Awards & Honours'); ?>
                    <?php echo create_mobile_menu_item('/licences', '/images/icons/header-icons/about-icon-03.svg', 'Licences'); ?>
                    <?php echo create_mobile_menu_item('/documents', '/images/icons/header-icons/about-icon-04.svg', 'Documents'); ?>
                    <?php echo create_mobile_menu_item('/csr', '/images/icons/header-icons/about-icon-05.svg', 'CSR'); ?>
                    <?php echo create_mobile_menu_item('//oneroyal.news/careers', '/images/icons/header-icons/about-icon-06.svg', 'Careers', true); ?>
                    <?php echo create_mobile_menu_item('/contact-us', '/images/icons/header-icons/about-icon-07.svg', 'Contact Us'); ?>
                </div>
            </div>

            <!-- Partners Section -->
            <div class="mobile-menu-section">
                <button class="mobile-section-header" type="button">
                    <span>Partners</span>
                    <svg class="chevron" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="mobile-submenu">
                    <?php echo create_mobile_menu_item('/partners', '/images/icons/header-icons/partners-icon-01.svg', 'Partner with OneRoyal'); ?>
                    <?php echo create_mobile_menu_item('/partners/introducing-broker', '/images/icons/header-icons/partners-icon-02.svg', 'Introducing Broker'); ?>
                    <?php echo create_mobile_menu_item('/partners/refer-a-friend', '/images/icons/header-icons/partners-icon-03.svg', 'Refer a Friend'); ?>
                    <?php echo create_mobile_menu_item('/partners/money-managers', '/images/icons/header-icons/partners-icon-04.svg', 'Money Managers'); ?>
                    <?php echo create_mobile_menu_item('/partners/institutional', '/images/icons/header-icons/partners-icon-05.svg', 'Institutional'); ?>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Footer -->
        <div class="mobile-nav-footer">
            <div class="mobile-footer-buttons">
                <a href="#" class="btn btn-tertiary btn-sm btn-plain no-icon">Log In</a>
                <a href="#" class="btn btn-primary btn-sm btn-plain no-icon">Sign Up</a>
                <a href="//oneroyal.academy/faqs" class="header-btn-faq mobile-faq-btn"></a>
            </div>
        </div>
    </div>
</nav>

<script>
jQuery(document).ready(function($) {
    const $mobileMenuToggle = $('.mobile-menu-toggle');
    const $mobileNav = $('#mobileNav');
    const $mobileNavClose = $('.mobile-nav-close');
    const $mobileNavOverlay = $('.mobile-nav-overlay');
    const $body = $('body');

    function openMobileMenu() {
        $mobileNav.addClass('active');
        $body.addClass('mobile-menu-open');
        $mobileMenuToggle.addClass('active');
        
        setTimeout(() => {
            $mobileMenuToggle.find('.hamburger-line:nth-child(1)').css('transform', 'rotate(45deg) translate(5px, 5px)');
            $mobileMenuToggle.find('.hamburger-line:nth-child(2)').css('opacity', '0');
            $mobileMenuToggle.find('.hamburger-line:nth-child(3)').css('transform', 'rotate(-45deg) translate(7px, -6px)');
        }, 100);
    }

    function closeMobileMenu() {
        $mobileNav.removeClass('active');
        $body.removeClass('mobile-menu-open');
        $mobileMenuToggle.removeClass('active');
        
        $mobileMenuToggle.find('.hamburger-line').css({
            'transform': 'none',
            'opacity': '1'
        });
        
        $('.mobile-menu-section').removeClass('active');
        $('.mobile-submenu').slideUp(200);
    }

    $mobileMenuToggle.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if ($mobileNav.hasClass('active')) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    });

    $mobileNavClose.on('click', closeMobileMenu);
    $mobileNavOverlay.on('click', closeMobileMenu);

    $('.mobile-section-header').on('click', function() {
        const $section = $(this).closest('.mobile-menu-section');
        const $submenu = $section.find('.mobile-submenu');
        const $chevron = $(this).find('.chevron');
        
        if ($section.hasClass('active')) {
            $section.removeClass('active');
            $submenu.slideUp(200);
            $chevron.css('transform', 'rotate(0deg)');
        } else {
            $('.mobile-menu-section').removeClass('active');
            $('.mobile-submenu').slideUp(200);
            $('.mobile-section-header .chevron').css('transform', 'rotate(0deg)');
            
            $section.addClass('active');
            $submenu.slideDown(200);
            $chevron.css('transform', 'rotate(180deg)');
        }
    });

    $('.mobile-submenu-item').on('click', function() {
        setTimeout(closeMobileMenu, 100);
    });

    $(window).on('resize', function() {
        if ($(window).width() > 1200) {
            closeMobileMenu();
        }
    });

    $mobileNav.on('touchmove', function(e) {
        if ($body.hasClass('mobile-menu-open')) {
            e.preventDefault();
        }
    });
});
</script> 