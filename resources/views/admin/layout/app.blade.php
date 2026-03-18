<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | Rana Marble')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

        <!-- Ico favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('./img/favicon.ico')}}">

    <!-- {{-- Per-page SEO (set from any view using @section) --}} -->
<meta name="description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', ''))">
<meta name="keywords"    content="@yield('meta_keywords',    \App\Models\Setting::get('meta_keywords', ''))">
<meta property="og:title"       content="@yield('og_title', \App\Models\Setting::get('meta_title', ''))">
<meta property="og:description" content="@yield('meta_description', \App\Models\Setting::get('meta_description', ''))">
<meta property="og:image"       content="@yield('og_image', \App\Models\Setting::get('og_image', ''))">
<meta name="robots" content="{{ \App\Models\Setting::get('robots', 'index,follow') }}">
@if(\App\Models\Setting::get('google_verification'))
    <meta name="google-site-verification" content="{{ \App\Models\Setting::get('google_verification') }}">
@endif
    
    <style>
        :root {
            --primary: #FF6B2B;
            --primary-dark: #e5551a;
            --primary-light: #fff3ee;
            --dark: #0f1117;
            --sidebar-bg: #0f1117;
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --header-h: 64px;
            --surface: #ffffff;
            --surface2: #f8f9fb;
            --border: #eaecf0;
            --text: #1a1d23;
            --text-muted: #6b7280;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--surface2);
            color: var(--text);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .brand-name {
            font-family: 'Syne', sans-serif;
        }

        /* ── SIDEBAR ── */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            z-index: 1040;
            transition: width .3s cubic-bezier(.4, 0, .2, 1), transform .3s;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
            min-height: var(--header-h);
            text-decoration: none;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
            font-size: 18px;
        }

        .brand-name {
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            white-space: nowrap;
            letter-spacing: -.3px;
        }

        .brand-name span {
            color: var(--primary);
        }

        .sidebar-scroll {
            overflow-y: auto;
            overflow-x: hidden;
            flex: 1;
            padding: 12px 0;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, .1) transparent;
        }

        .nav-section-label {
            color: rgba(255, 255, 255, .3);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 12px 22px 4px;
            white-space: nowrap;
            transition: opacity .3s;
        }

        #sidebar.collapsed .nav-section-label {
            opacity: 0;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            margin: 2px 10px;
            border-radius: 10px;
            color: rgba(255, 255, 255, .6);
            text-decoration: none;
            transition: all .2s;
            cursor: pointer;
            white-space: nowrap;
            font-size: 14px;
            font-weight: 500;
            border: none;
            background: none;
            width: calc(100% - 20px);
            text-align: left;
        }

        .nav-link-item i {
            font-size: 17px;
            flex-shrink: 0;
            width: 20px;
            text-align: center;
        }

        .nav-link-item .nav-text {
            transition: opacity .2s;
        }

        .nav-link-item .badge-count {
            margin-left: auto;
            background: var(--primary);
            color: #fff;
            font-size: 10px;
            padding: 2px 7px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        .nav-link-item:hover {
            background: rgba(255, 255, 255, .07);
            color: #fff;
        }

        .nav-link-item.active {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 4px 14px rgba(255, 107, 43, .4);
        }

        .nav-link-item.active .badge-count {
            background: rgba(255, 255, 255, .25);
        }

        #sidebar.collapsed .nav-text,
        #sidebar.collapsed .badge-count {
            opacity: 0;
            pointer-events: none;
        }

        #sidebar.collapsed .nav-link-item {
            justify-content: center;
            padding: 10px;
            margin: 2px 10px;
        }

        .sidebar-footer {
            padding: 14px;
            border-top: 1px solid rgba(255, 255, 255, .07);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #ff9a5c);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
        }

        .sidebar-user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user-name {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-role {
            color: rgba(255, 255, 255, .4);
            font-size: 11px;
        }

        #sidebar.collapsed .sidebar-user-info {
            display: none;
        }

        /* ── MAIN LAYOUT ── */
        #main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left .3s cubic-bezier(.4, 0, .2, 1);
            min-height: 100vh;
        }

        #main-content.expanded {
            margin-left: var(--sidebar-collapsed);
        }

        /* ── TOPBAR ── */
        #topbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
            box-shadow: var(--shadow);
        }

        #sidebar-toggle {
            border: none;
            background: none;
            color: var(--text-muted);
            font-size: 22px;
            cursor: pointer;
            padding: 4px;
            border-radius: 8px;
        }

        #sidebar-toggle:hover {
            background: var(--surface2);
            color: var(--text);
        }

        .topbar-search {
            flex: 1;
            max-width: 420px;
            position: relative;
        }

        .topbar-search input {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px 8px 38px;
            font-size: 14px;
            background: var(--surface2);
            color: var(--text);
            width: 100%;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            transition: border-color .2s;
        }

        .topbar-search input:focus {
            border-color: var(--primary);
            background: #fff;
        }

        .topbar-search i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }

        .topbar-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            cursor: pointer;
            position: relative;
            transition: all .2s;
            text-decoration: none;
        }

        .topbar-icon-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        .topbar-icon-btn .dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            position: absolute;
            top: 6px;
            right: 6px;
            border: 2px solid #fff;
        }

        .topbar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), #ff9a5c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
            border: 2px solid var(--primary-light);
        }

        /* ── PAGE CONTENT ── */
        .page-content {
            padding: 24px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin: 0;
        }

        /* ── CARDS ── */
        .card {
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-header-custom {
            padding: 18px 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title-sm {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        /* ── STAT CARDS ── */
        .stat-card {
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            border: 1.5px solid var(--border);
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .stat-card .icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .stat-card .value {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 4px;
            font-family: 'Syne', sans-serif;
        }

        .stat-card .label {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .stat-card .trend {
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .trend-up {
            background: #dcfce7;
            color: #16a34a;
        }

        .trend-down {
            background: #fee2e2;
            color: #dc2626;
        }

        .stat-card .bg-icon {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 80px;
            opacity: .05;
        }

        /* ── TABLE ── */
        .table-custom {
            font-size: 13.5px;
        }

        .table-custom th {
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-muted);
            border-color: var(--border);
        }

        .table-custom td {
            border-color: var(--border);
            vertical-align: middle;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-delivered {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-processing {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-shipped {
            background: #e0e7ff;
            color: #4338ca;
        }

        .badge-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-inactive {
            background: #f3f4f6;
            color: #6b7280;
        }

        .badge-draft {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-low {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-medium {
            background: #fef9c3;
            color: #854d0e;
        }

        .badge-high {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-new {
            background: #e0e7ff;
            color: #4338ca;
        }

        .badge-resolved {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-inprogress {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .product-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 8px;
            background: var(--surface2);
        }

        .product-img-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 18px;
        }

        .avatar-sm {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            flex-shrink: 0;
        }

        /* ── CHART PLACEHOLDER ── */
        .chart-area {
            height: 220px;
            background: linear-gradient(135deg, #f8f9fb 0%, #fff 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .chart-bars {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 160px;
            padding: 0 10px;
        }

        .chart-bar {
            border-radius: 6px 6px 0 0;
            flex: 1;
            min-width: 18px;
            transition: opacity .2s;
            cursor: pointer;
        }

        .chart-bar:hover {
            opacity: .8;
        }

        .donut-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .donut-center {
            position: absolute;
            text-align: center;
        }

        /* ── PAGE SECTIONS ── */
        .page-section {
            display: none;
        }

        .page-section.active {
            display: block;
        }

        /* ── MOBILE OVERLAY ── */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 1039;
            backdrop-filter: blur(2px);
        }

        /* ── FORMS ── */
        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
            display: block;
        }

        .form-control,
        .form-select {
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            padding: 9px 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(255, 107, 43, .1);
        }

        .btn-primary-custom {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            padding: 9px 20px;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
        }

        .btn-outline-custom {
            border: 1.5px solid var(--border);
            color: var(--text);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            padding: 9px 20px;
            background: #fff;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-light);
        }

        /* ── MOBILE BOTTOM NAV ── */
        #mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1045;
            background: var(--surface);
            border-top: 1.5px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, .08);
            padding: 6px 0 calc(6px + env(safe-area-inset-bottom));
        }

        .mob-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 10px;
            transition: color .2s;
            background: none;
            border: none;
            flex: 1;
        }

        .mob-nav-item i {
            font-size: 20px;
        }

        .mob-nav-item.active {
            color: var(--primary);
        }

        .mob-nav-item.active i {
            font-weight: 600;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991.98px) {
            #sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-width) !important;
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }

            #sidebar-overlay.show {
                display: block;
            }

            #main-content,
            #main-content.expanded {
                margin-left: 0 !important;
            }

            #mobile-bottom-nav {
                display: flex;
            }

            .page-content {
                padding: 16px 14px 90px;
            }

            #topbar {
                padding: 0 14px;
            }

            .topbar-search {
                display: none;
            }

            .page-title {
                font-size: 20px;
            }

            .stat-card .value {
                font-size: 22px;
            }
        }

        @media (max-width: 575.98px) {
            .page-content {
                padding: 12px 10px 86px;
            }

            .topbar-actions .topbar-icon-btn:nth-child(1) {
                display: none;
            }

            .card-body {
                padding: 12px;
            }

            .stat-card {
                padding: 14px;
            }
        }

        @media (min-width: 992px) {
            #sidebar-toggle.desktop-toggle {
                display: flex;
            }
        }

        /* ── UTILITIES ── */
        .text-primary-custom {
            color: var(--primary) !important;
        }

        .bg-primary-custom {
            background: var(--primary) !important;
        }

        .bg-primary-light {
            background: var(--primary-light) !important;
        }

        .border-primary-custom {
            border-color: var(--primary) !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .rounded-custom {
            border-radius: var(--radius) !important;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        /* Star rating */
        .stars {
            color: var(--warning);
            letter-spacing: 1px;
        }

        /* Timeline */
        .timeline-item {
            display: flex;
            gap: 14px;
            padding-bottom: 18px;
            position: relative;
        }

        .timeline-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 17px;
            top: 36px;
            width: 2px;
            bottom: 0;
            background: var(--border);
        }

        .timeline-dot {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            border: 2.5px solid;
        }

        /* Activity feed */
        .activity-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        /* Progress */
        .progress {
            border-radius: 20px;
            height: 6px;
            background: var(--surface2);
        }

        .progress-bar {
            border-radius: 20px;
        }

        /* Notification dropdown */
        .notif-item {
            padding: 10px 16px;
            border-bottom: 1px solid var(--border);
            transition: background .2s;
            cursor: pointer;
        }

        .notif-item:hover {
            background: var(--surface2);
        }

        .notif-item.unread {
            border-left: 3px solid var(--primary);
            background: var(--primary-light);
        }

        /* Settings tabs */
        .settings-nav .nav-link {
            border-radius: 10px;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
        }

        .settings-nav .nav-link.active {
            background: var(--primary);
            color: #fff;
        }

        /* Color Swatches */
        .color-swatch {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: border-color .2s;
        }

        .color-swatch.selected {
            border-color: var(--text);
        }

        /* Toggle switch */
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        /* Report/print */
        @media print {

            #sidebar,
            #topbar,
            #mobile-bottom-nav {
                display: none !important;
            }

            #main-content {
                margin: 0 !important;
            }
        }

        /* Mini sparklines via CSS */
        .sparkline {
            display: flex;
            align-items: flex-end;
            gap: 2px;
            height: 30px;
        }

        .sp-bar {
            border-radius: 2px;
            flex: 1;
            min-width: 4px;
        }

        /* Image upload area */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: var(--radius);
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .upload-zone:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        /* Category pills */
        .cat-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface2);
            border: 1.5px solid var(--border);
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
        }

        /* Kanban */
        .kanban-col {
            background: var(--surface2);
            border-radius: var(--radius);
            padding: 14px;
        }

        .kanban-card {
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
        }

        /* Step indicator */
        .step-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-num.done {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        .step-num.active {
            border-color: var(--primary);
            color: var(--primary);
        }




        /* ── TOAST ALERTS ── */
        #alert-stack {
            position: fixed;
            top: calc(var(--header-h) + 16px);
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
            min-width: 320px;
            max-width: 420px;
        }

        .alert-toast {
            pointer-events: all;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: var(--shadow-lg);
            border: 1.5px solid;
            position: relative;
            overflow: hidden;
            animation: toastIn .35s cubic-bezier(.21, 1.02, .73, 1) both;
        }

        .alert-toast.hiding {
            animation: toastOut .3s cubic-bezier(.4, 0, .2, 1) forwards;
        }

        .alert-toast::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            border-radius: var(--radius) 0 0 var(--radius);
        }

        .alert-toast.alert-success {
            border-color: #bbf7d0;
        }

        .alert-toast.alert-success::before {
            background: var(--success);
        }

        .alert-toast.alert-error {
            border-color: #fecaca;
        }

        .alert-toast.alert-error::before {
            background: var(--danger);
        }

        .toast-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .alert-success .toast-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .alert-error .toast-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .toast-body {
            flex: 1;
            min-width: 0;
            padding-top: 1px;
        }

        .toast-title {
            font-size: 13.5px;
            font-weight: 700;
            margin: 0 0 2px;
            font-family: 'Syne', sans-serif;
        }

        .alert-success .toast-title {
            color: #15803d;
        }

        .alert-error .toast-title {
            color: #b91c1c;
        }

        .toast-msg {
            font-size: 13px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.45;
        }

        .toast-close {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 20px;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
            transition: color .15s;
        }

        .toast-close:hover {
            color: var(--text);
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            border-radius: 0 0 var(--radius) var(--radius);
            animation: toastProgress 4s linear forwards;
        }

        .alert-success .toast-progress {
            background: var(--success);
        }

        .alert-error .toast-progress {
            background: var(--danger);
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(40px) scale(.95);
            }

            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes toastOut {
            to {
                opacity: 0;
                transform: translateX(50px) scale(.93);
            }
        }

        @keyframes toastProgress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        @media (max-width: 575.98px) {
            #alert-stack {
                right: 12px;
                left: 12px;
                min-width: unset;
            }
        }
    </style>
</head>

<body>

    @include('admin.includes.sidebar')

    <!-- ══════════════════ MAIN CONTENT ══════════════════ -->
    <div id="main-content">
        @include('admin.includes.topbar')

        <!-- ══════ PAGE SECTIONS ══════ -->
        <div class="page-content">

            @yield('content')

        </div>
        <!-- /page-content -->
    </div>
    <!-- /main-content -->

    @include('admin.includes.mobile-nav')


    {{-- ── TOAST ALERT STACK ── --}}
    <div id="alert-stack"></div>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () =>
            showToast('success', @json(session('success')))
        );
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () =>
            showToast('error', @json(session('error')))
        );
    </script>
    @endif

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () =>
            showToast('error', @json($errors -> first()))
        );
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ── NAVIGATION ──
        const pageMap = {
            dashboard: 'page-dashboard',
            analytics: 'page-analytics',
            products: 'page-products',
            categories: 'page-categories',
            inventory: 'page-inventory',
            coupons: 'page-coupons',
            reviews: 'page-reviews',
            orders: 'page-orders',
            returns: 'page-returns',
            shipping: 'page-shipping',
            payments: 'page-payments',
            customers: 'page-customers',
            staff: 'page-staff',
            vendors: 'page-vendors',
            pages: 'page-pages',
            banners: 'page-banners',
            blog: 'page-blog',
            emails: 'page-emails',
            support: 'page-support',
            reports: 'page-reports',
            settings: 'page-settings'
        };

        function navigate(page) {
            // Hide all sections
            document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
            // Show target
            const target = document.getElementById(pageMap[page]);
            if (target) target.classList.add('active');
            // Update sidebar active
            document.querySelectorAll('.nav-link-item').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.nav-link-item').forEach(l => {
                if (l.getAttribute('onclick') && l.getAttribute('onclick').includes("'" + page + "'")) l.classList.add('active');
            });
            // Update mobile bottom nav
            document.querySelectorAll('.mob-nav-item').forEach(l => l.classList.remove('active'));
            document.querySelectorAll('.mob-nav-item').forEach(l => {
                if (l.getAttribute('onclick') && l.getAttribute('onclick').includes("'" + page + "'")) l.classList.add('active');
            });
            // Close mobile sidebar if open
            closeMobileSidebar();
            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // ── SIDEBAR TOGGLE ──
        let sidebarCollapsed = false;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main-content');
            const isMobile = window.innerWidth < 992;
            if (isMobile) {
                sidebar.classList.toggle('mobile-open');
                document.getElementById('sidebar-overlay').classList.toggle('show');
            } else {
                sidebarCollapsed = !sidebarCollapsed;
                sidebar.classList.toggle('collapsed', sidebarCollapsed);
                main.classList.toggle('expanded', sidebarCollapsed);
            }
        }

        function closeMobileSidebar() {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebar-overlay').classList.remove('show');
        }

        document.getElementById('sidebar-overlay').addEventListener('click', closeMobileSidebar);

        // ── SETTINGS TABS ──
        function showSettingsTab(tab, el) {
            document.querySelectorAll('.settings-tab').forEach(t => t.classList.add('d-none'));
            document.getElementById('settab-' + tab).classList.remove('d-none');
            document.querySelectorAll('.settings-nav .nav-link').forEach(l => l.classList.remove('active'));
            if (el) el.classList.add('active');
            return false;
        }

        // ── HANDLE RESIZE ──
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeMobileSidebar();
            }
        });

        // Prevent default on settings nav links
        document.querySelectorAll('.settings-nav .nav-link').forEach(l => {
            l.addEventListener('click', e => e.preventDefault());
        });
    </script>

    <script>
        // ── TOAST ALERTS ──
        function showToast(type, msg) {
            const labels = {
                success: 'Success',
                error: 'Error'
            };
            const icons = {
                success: '<i class="bi bi-check-lg"></i>',
                error: '<i class="bi bi-x-lg"></i>'
            };
            const el = document.createElement('div');
            el.className = `alert-toast alert-${type}`;
            el.innerHTML = `
        <div class="toast-icon">${icons[type]}</div>
        <div class="toast-body">
            <p class="toast-title">${labels[type]}</p>
            <p class="toast-msg">${msg}</p>
        </div>
        <button class="toast-close" onclick="dismissToast(this.closest('.alert-toast'))">×</button>
        <div class="toast-progress"></div>
    `;
            document.getElementById('alert-stack').appendChild(el);
            setTimeout(() => dismissToast(el), 4200);
        }

        function dismissToast(el) {
            if (!el || el.classList.contains('hiding')) return;
            el.classList.add('hiding');
            setTimeout(() => el.remove(), 300);
        }
    </script>
</body>

</html>