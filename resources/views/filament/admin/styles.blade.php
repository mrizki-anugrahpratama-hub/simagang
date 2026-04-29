<style>
    /* Custom Navbar Styling - Solid Background */
    .fi-topbar {
        background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%) !important;
        border-bottom: 2px solid transparent !important;
        border-image: linear-gradient(to right, #FFC107, #1A8EC4) 1 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
    }

    /* Dark Mode - Navbar */
    .dark .fi-topbar {
        background: #0a0a0a !important;
        border-image: linear-gradient(to right, #FFD54F, #60a5fa) 1 !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
    }

    /* Sidebar Styling with Strong Border */
    .fi-sidebar {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;
        border-right: 2px solid #e2e8f0 !important;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.05) !important;
    }

    /* Dark Mode - Sidebar */
    .dark .fi-sidebar {
        background: #0a0a0a !important;
        border-right: 2px solid #1a1a1a !important;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.3) !important;
    }

    /* Sidebar Navigation Items */
    .fi-sidebar-item {
        transition: all 0.3s ease !important;
        border-radius: 0.5rem !important;
        margin: 0.25rem 0.5rem !important;
    }

    .fi-sidebar-item:hover {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(26, 142, 196, 0.1) 100%) !important;
        transform: translateX(4px) !important;
    }

    /* Dark Mode - Sidebar Items Hover */
    .dark .fi-sidebar-item:hover {
        background: linear-gradient(135deg, rgba(255, 211, 79, 0.15) 0%, rgba(96, 165, 250, 0.15) 100%) !important;
    }

    .fi-sidebar-item-active {
        background: linear-gradient(135deg, #FFC107 0%, #1A8EC4 100%) !important;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3) !important;
    }

    /* Dark Mode - Active Item */
    .dark .fi-sidebar-item-active {
        background: linear-gradient(135deg, #FFD54F 0%, #60a5fa 100%) !important;
        box-shadow: 0 4px 12px rgba(255, 211, 79, 0.4) !important;
    }

    .fi-sidebar-item-active .fi-sidebar-item-label,
    .fi-sidebar-item-active .fi-sidebar-item-icon {
        color: white !important;
        font-weight: 600 !important;
    }

    /* Sidebar Group Labels */
    .fi-sidebar-group-label {
        color: #64748b !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.05em !important;
        text-transform: uppercase !important;
        margin-top: 1rem !important;
        padding: 0.5rem 1rem !important;
    }

    /* Dark Mode - Group Labels */
    .dark .fi-sidebar-group-label {
        color: #94a3b8 !important;
    }

    /* Sidebar Collapse Button - Force Override with Stronger Selectors */
    button[x-on\:click*="toggleSidebarCollapse"],
    button.fi-sidebar-collapse-button,
    .fi-sidebar-header button {
        position: relative !important;
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        min-height: 36px !important;
        border-radius: 0.625rem !important;
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.12) 0%, rgba(26, 142, 196, 0.12) 100%) !important;
        border: 1.5px solid rgba(255, 193, 7, 0.2) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 0 !important;
    }

    /* Hide ALL SVG icons in collapse button */
    button[x-on\:click*="toggleSidebarCollapse"] svg,
    button.fi-sidebar-collapse-button svg,
    .fi-sidebar-header button svg,
    button[x-on\:click*="toggleSidebarCollapse"] *,
    button.fi-sidebar-collapse-button *,
    .fi-sidebar-header button * {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }

    /* Create custom icon with pseudo elements */
    button[x-on\:click*="toggleSidebarCollapse"]::before,
    button.fi-sidebar-collapse-button::before,
    .fi-sidebar-header button::before {
        content: '☰' !important;
        display: block !important;
        font-size: 18px !important;
        line-height: 1 !important;
        color: #64748b !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 10 !important;
    }

    /* Hover effect */
    button[x-on\:click*="toggleSidebarCollapse"]:hover,
    button.fi-sidebar-collapse-button:hover,
    .fi-sidebar-header button:hover {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.25) 0%, rgba(26, 142, 196, 0.25) 100%) !important;
        border-color: rgba(255, 193, 7, 0.4) !important;
        transform: scale(1.08) !important;
        box-shadow: 0 3px 10px rgba(255, 193, 7, 0.2) !important;
    }

    button[x-on\:click*="toggleSidebarCollapse"]:active,
    button.fi-sidebar-collapse-button:active,
    .fi-sidebar-header button:active {
        transform: scale(0.96) !important;
    }

    /* User Menu */
    .fi-user-menu-button {
        transition: all 0.3s ease !important;
        border-radius: 0.75rem !important;
    }

    .fi-user-menu-button:hover {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(26, 142, 196, 0.1) 100%) !important;
        transform: scale(1.02) !important;
    }

    /* Buttons */
    .fi-btn-primary {
        background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%) !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3) !important;
        transition: all 0.3s ease !important;
    }

    .fi-btn-primary:hover {
        background: linear-gradient(135deg, #FFD54F 0%, #FFC107 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(255, 193, 7, 0.4) !important;
    }

    /* Stats Cards */
    .fi-wi-stats-overview-stat {
        transition: all 0.3s ease !important;
    }

    .fi-wi-stats-overview-stat:hover {
        transform: translateY(-4px) !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
    }

    /* Login Page - Center Brand Name */
    .fi-simple-page .fi-logo {
        text-align: center !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
    }

    .fi-simple-page .fi-logo > div {
        text-align: center !important;
    }

    /* Login Page - Mobile Padding Only */
    @media (max-width: 640px) {
        .fi-simple-page {
            padding: 1.5rem !important;
        }

        .fi-simple-page .fi-simple-main {
            padding: 1rem !important;
        }
        
        .fi-simple-page .fi-section-content-ctn {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }
</style>
