<?php
/**
 * Royesh Message Inbox — Modern Admin Panel
 *
 * Provides a sleek, native, and responsive inbox for viewing, filtering,
 * managing, and searching contact messages and consultation requests.
 *
 * @package Royesh
 * @version 1.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ────────────────────────────────────────────────────────────────
// ۱) ایجاد جدول در پایگاه داده
// ────────────────────────────────────────────────────────────────

function royesh_create_inbox_table() {
    global $wpdb;
    $table   = $wpdb->prefix . 'royesh_messages';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        form_type   VARCHAR(50) NOT NULL DEFAULT 'contact',
        name        VARCHAR(200) NOT NULL DEFAULT '',
        phone       VARCHAR(50)  NOT NULL DEFAULT '',
        email       VARCHAR(200) NOT NULL DEFAULT '',
        subject     VARCHAR(255) NOT NULL DEFAULT '',
        message     TEXT         NOT NULL,
        is_read     TINYINT(1)   NOT NULL DEFAULT 0,
        submitted_at DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
        ip_address  VARCHAR(45)  NOT NULL DEFAULT '',
        PRIMARY KEY (id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    update_option('royesh_inbox_db_version', '1.2');
}
add_action('after_switch_theme', 'royesh_create_inbox_table');

function royesh_maybe_create_inbox_table() {
    if (get_option('royesh_inbox_db_version') !== '1.2') {
        royesh_create_inbox_table();
    }
}
add_action('init', 'royesh_maybe_create_inbox_table');


// ────────────────────────────────────────────────────────────────
// ۲) ذخیره پیام در جدول
// ────────────────────────────────────────────────────────────────

function royesh_save_message(array $data) {
    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '';

    $inserted = $wpdb->insert($table, [
        'form_type'    => sanitize_text_field($data['form_type'] ?? 'contact'),
        'name'         => sanitize_text_field($data['name']      ?? ''),
        'phone'        => sanitize_text_field($data['phone']     ?? ''),
        'email'        => sanitize_email($data['email']          ?? ''),
        'subject'      => sanitize_text_field($data['subject']   ?? ''),
        'message'      => sanitize_textarea_field($data['message'] ?? ''),
        'is_read'      => 0,
        'submitted_at' => current_time('mysql'),
        'ip_address'   => $ip,
    ], ['%s','%s','%s','%s','%s','%s','%d','%s','%s']);

    return $inserted ? $wpdb->insert_id : false;
}


// ────────────────────────────────────────────────────────────────
// ۳) آمارهای صندوق پیام
// ────────────────────────────────────────────────────────────────

function royesh_inbox_stats() {
    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';

    $total        = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table");
    $unread       = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE is_read = 0");
    $contact      = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE form_type = 'contact'");
    $consultation = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE form_type = 'consultation'");

    return compact('total', 'unread', 'contact', 'consultation');
}

function royesh_unread_count() {
    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';
    return (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE is_read = 0");
}


// ────────────────────────────────────────────────────────────────
// ۴) ثبت منوی ادمین + badge تعداد پیام‌های نخوانده
// ────────────────────────────────────────────────────────────────

function royesh_register_inbox_menu() {
    $unread = royesh_unread_count();
    $badge  = $unread > 0
        ? ' <span class="awaiting-mod count-' . $unread . '"><span class="pending-count">' . number_format_i18n($unread) . '</span></span>'
        : '';

    add_menu_page(
        __('صندوق پیام‌ها', 'royesh'),
        __('صندوق پیام‌ها', 'royesh') . $badge,
        'manage_options',
        'royesh-inbox',
        'royesh_render_inbox_page',
        'dashicons-email-alt',
        25
    );
}
add_action('admin_menu', 'royesh_register_inbox_menu');


// ────────────────────────────────────────────────────────────────
// ۵) استایل‌های مستقیم و بدون وابستگی به هوک برای لود ۱۰۰٪ تضمینی
// ────────────────────────────────────────────────────────────────

function royesh_render_inbox_inline_styles() {
    ?>
    <style id="royesh-inbox-styles">
        .royesh-wrap,
        .royesh-wrap * {
            font-family: inherit !important;
            box-sizing: border-box;
        }

        .royesh-wrap {
            margin: 15px 20px 20px 0;
            max-width: 1200px;
            direction: rtl;
            text-align: right;
        }

        /* سربرگ صفحه */
        .royesh-top-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #c3c4c7;
        }
        .royesh-top-header h1 {
            font-size: 20px;
            font-weight: 700;
            color: #1d2327;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .royesh-top-header h1 .dashicons {
            font-size: 24px;
            width: 24px;
            height: 24px;
            color: #014235;
        }

        /* کارت‌های آماری بالا */
        .royesh-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }
        @media (max-width: 960px) {
            .royesh-stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 600px) {
            .royesh-stats-grid { grid-template-columns: 1fr; }
        }

        .royesh-stat-box {
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 6px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #1d2327;
            transition: all 0.15s ease;
        }
        .royesh-stat-box:hover {
            border-color: #014235;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            color: #014235;
        }
        .royesh-stat-box.is-active {
            border-color: #014235;
            background: #f0f7f5;
            border-width: 1.5px;
        }
        .royesh-stat-title {
            font-size: 12px;
            font-weight: 600;
            color: #646970;
            margin-bottom: 4px;
        }
        .royesh-stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #1d2327;
            line-height: 1;
        }
        .royesh-stat-box.is-active .royesh-stat-value {
            color: #014235;
        }
        .royesh-stat-icon-wrap {
            width: 38px;
            height: 38px;
            border-radius: 6px;
            background: #f0f0f1;
            color: #50575e;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .royesh-stat-box.is-unread .royesh-stat-icon-wrap {
            background: #e6f3ee;
            color: #014235;
        }

        /* نوار ابزار و جستجو */
        .royesh-toolbar-wrap {
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 6px 6px 0 0;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            border-bottom: none;
        }
        .royesh-bulk-btns {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        .royesh-btn-custom {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #8c8f94;
            background: #f6f7f7;
            color: #2c3338;
            text-decoration: none;
            height: 32px;
            line-height: 1;
            transition: all 0.15s ease;
        }
        .royesh-btn-custom:hover {
            background: #f0f0f1;
            border-color: #014235;
            color: #014235;
        }
        .royesh-btn-custom.btn-danger {
            color: #b32d2e;
            border-color: #e5a4a5;
            background: #fff;
        }
        .royesh-btn-custom.btn-danger:hover {
            background: #b32d2e;
            color: #ffffff;
            border-color: #b32d2e;
        }
        .royesh-btn-custom.btn-primary {
            background: #014235;
            color: #ffffff;
            border-color: #014235;
        }
        .royesh-btn-custom.btn-primary:hover {
            background: #012e25;
            color: #ffffff;
        }

        /* دکمه‌های عملیات جدول (کاملاً تفکیک‌شده و با کنتراست بالا) */
        .royesh-action-group {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .royesh-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            border: 1px solid transparent;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .royesh-action-btn .dashicons {
            font-size: 17px;
            width: 17px;
            height: 17px;
            line-height: 1;
            display: inline-block;
            transition: transform 0.2s ease;
        }
        .royesh-action-btn:hover .dashicons {
            transform: scale(1.15);
        }

        /* ۱. دکمه مشاهده */
        .royesh-action-btn.action-view {
            background-color: #e6f3ee;
            border-color: #a3d9c9;
            color: #004F40;
        }
        .royesh-action-btn.action-view .dashicons {
            color: #004F40;
        }
        .royesh-action-btn.action-view:hover {
            background-color: #004F40;
            border-color: #004F40;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,79,64,0.3);
        }
        .royesh-action-btn.action-view:hover .dashicons {
            color: #ffffff;
        }

        /* ۲. دکمه تغییر وضعیت خوانده / نخوانده */
        .royesh-action-btn.action-toggle-read {
            background-color: #eef2f7;
            border-color: #c8d7e6;
            color: #2271b1;
        }
        .royesh-action-btn.action-toggle-read .dashicons {
            color: #2271b1;
        }
        .royesh-action-btn.action-toggle-read:hover {
            background-color: #2271b1;
            border-color: #2271b1;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(34,113,177,0.3);
        }
        .royesh-action-btn.action-toggle-read:hover .dashicons {
            color: #ffffff;
        }

        /* ۳. دکمه حذف */
        .royesh-action-btn.action-delete {
            background-color: #fdf2f2;
            border-color: #f8b4b4;
            color: #d63638;
        }
        .royesh-action-btn.action-delete .dashicons {
            color: #d63638;
        }
        .royesh-action-btn.action-delete:hover {
            background-color: #d63638;
            border-color: #d63638;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(214,54,56,0.3);
        }
        .royesh-action-btn.action-delete:hover .dashicons {
            color: #ffffff;
        }

        .royesh-search-box {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .royesh-search-box input[type="search"] {
            border: 1px solid #8c8f94;
            border-radius: 4px;
            padding: 4px 10px;
            font-size: 13px;
            height: 32px;
            width: 220px;
            background: #ffffff;
        }
        .royesh-search-box input[type="search"]:focus {
            border-color: #014235;
            box-shadow: 0 0 0 1px #014235;
            outline: none;
        }

        /* جدول استاندارد و خوانا */
        .royesh-table-box {
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 0 0 6px 6px;
            overflow: hidden;
        }
        .royesh-table-main {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }
        .royesh-table-main thead th {
            background: #f6f7f7;
            border-bottom: 1px solid #c3c4c7;
            padding: 10px 14px;
            font-size: 12px;
            font-weight: 700;
            color: #2c3338;
        }
        .royesh-table-main tbody tr {
            border-bottom: 1px solid #f0f0f1;
            transition: background-color 0.1s ease;
        }
        .royesh-table-main tbody tr:last-child {
            border-bottom: none;
        }
        .royesh-table-main tbody tr:hover {
            background-color: #f9fafb;
        }
        .royesh-table-main tbody tr.is-unread-row {
            background-color: #f2f9f6;
            font-weight: 600;
        }
        .royesh-table-main tbody tr.is-unread-row:hover {
            background-color: #e6f4ef;
        }
        .royesh-table-main td {
            padding: 12px 14px;
            font-size: 13px;
            color: #2c3338;
            vertical-align: middle;
        }

        .royesh-sender-link {
            color: #1d2327;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .royesh-sender-link:hover {
            color: #014235;
            text-decoration: underline;
        }

        .royesh-unread-badge {
            width: 8px;
            height: 8px;
            background-color: #014235;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
        }

        .royesh-type-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        .royesh-type-badge.type-contact {
            background: #eef2f6;
            color: #2c3338;
            border: 1px solid #d0d7de;
        }
        .royesh-type-badge.type-consultation {
            background: #fdf5e6;
            color: #8c5b00;
            border: 1px solid #fae1b8;
        }

        /* کارت نمایش پیام تکی */
        .royesh-single-card {
            background: #ffffff;
            border: 1px solid #c3c4c7;
            border-radius: 6px;
            overflow: hidden;
        }
        .royesh-single-head {
            background: #f6f7f7;
            border-bottom: 1px solid #c3c4c7;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .royesh-single-head h2 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #1d2327;
        }
        .royesh-single-body {
            padding: 20px;
        }
        .royesh-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 14px 18px;
            margin-bottom: 20px;
        }
        @media (max-width: 782px) {
            .royesh-info-grid { grid-template-columns: 1fr; }
        }
        .royesh-info-item .info-label {
            font-size: 11px;
            font-weight: 600;
            color: #646970;
            margin-bottom: 2px;
            display: block;
        }
        .royesh-info-item .info-val {
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
        }
        .royesh-info-item .info-val a {
            color: #014235;
            text-decoration: none;
        }
        .royesh-info-item .info-val a:hover {
            text-decoration: underline;
        }

        .royesh-msg-content-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 18px 20px;
            font-size: 14px;
            line-height: 1.8;
            color: #2c3338;
            white-space: pre-wrap;
            border-right: 4px solid #014235;
        }

        /* حالت خالی */
        .royesh-empty-box {
            padding: 60px 20px;
            text-align: center;
            color: #646970;
        }
        .royesh-empty-box .dashicons {
            font-size: 48px;
            width: 48px;
            height: 48px;
            color: #a7aaad;
            margin-bottom: 12px;
        }
        .royesh-empty-box p {
            font-size: 14px;
            margin: 0;
        }
    </style>
    <?php
}


// ────────────────────────────────────────────────────────────────
// ۶) پردازش اکشن‌های ادمین (حذف، تغییر وضعیت خوانده/نخوانده)
// ────────────────────────────────────────────────────────────────

function royesh_inbox_handle_actions() {
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['page']) || $_GET['page'] !== 'royesh-inbox') return;

    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';

    // حذف تکی
    if (isset($_GET['action'], $_GET['msg_id']) && $_GET['action'] === 'delete') {
        check_admin_referer('royesh_delete_msg_' . $_GET['msg_id']);
        $wpdb->delete($table, ['id' => (int) $_GET['msg_id']], ['%d']);
        wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=deleted'));
        exit;
    }

    // علامت‌گذاری تکی خوانده / نخوانده
    if (isset($_GET['action'], $_GET['msg_id']) && in_array($_GET['action'], ['mark_read', 'mark_unread'], true)) {
        check_admin_referer('royesh_toggle_msg_' . $_GET['msg_id']);
        $is_read = $_GET['action'] === 'mark_read' ? 1 : 0;
        $wpdb->update($table, ['is_read' => $is_read], ['id' => (int) $_GET['msg_id']], ['%d'], ['%d']);
        wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=updated'));
        exit;
    }

    // عملیات گروهی (Bulk Actions)
    if (isset($_POST['royesh_bulk_action'], $_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'royesh_bulk_inbox_nonce')) {
        $bulk_action = sanitize_text_field($_POST['royesh_bulk_action']);
        $ids = isset($_POST['msg_ids']) ? array_map('intval', (array) $_POST['msg_ids']) : [];

        if ($bulk_action === 'delete_all') {
            $wpdb->query("DELETE FROM $table");
            wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=all_deleted'));
            exit;
        }

        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '%d'));

            if ($bulk_action === 'delete_selected') {
                $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id IN ($placeholders)", ...$ids));
                wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=selected_deleted'));
                exit;
            } elseif ($bulk_action === 'mark_read_selected') {
                $wpdb->query($wpdb->prepare("UPDATE $table SET is_read = 1 WHERE id IN ($placeholders)", ...$ids));
                wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=selected_read'));
                exit;
            } elseif ($bulk_action === 'mark_unread_selected') {
                $wpdb->query($wpdb->prepare("UPDATE $table SET is_read = 0 WHERE id IN ($placeholders)", ...$ids));
                wp_redirect(admin_url('admin.php?page=royesh-inbox&status_msg=selected_unread'));
                exit;
            }
        }
    }
}
add_action('admin_init', 'royesh_inbox_handle_actions');


// ────────────────────────────────────────────────────────────────
// ۷) رندر صفحه پیشرفته Inbox
// ────────────────────────────────────────────────────────────────

function royesh_render_inbox_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('دسترسی غیرمجاز', 'royesh'));
    }

    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';
    $stats = royesh_inbox_stats();

    // لود مستقیم و ۱۰۰٪ تضمینی استایل‌ها
    royesh_render_inbox_inline_styles();

    // ── نمایش تکی پیام ──────────────────────────────────────────
    if (isset($_GET['view'], $_GET['msg_id'])) {
        $id  = (int) $_GET['msg_id'];
        $msg = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id));

        if (!$msg) {
            echo '<div class="wrap"><div class="notice notice-error"><p>' . esc_html__('پیام مورد نظر یافت نشد.', 'royesh') . '</p></div></div>';
            return;
        }

        // علامت‌گذاری خودکار به عنوان خوانده‌شده هنگام باز شدن
        if (!$msg->is_read) {
            $wpdb->update($table, ['is_read' => 1], ['id' => $id], ['%d'], ['%d']);
            $msg->is_read = 1;
        }

        $delete_url = wp_nonce_url(
            admin_url('admin.php?page=royesh-inbox&action=delete&msg_id=' . $id),
            'royesh_delete_msg_' . $id
        );
        $toggle_unread_url = wp_nonce_url(
            admin_url('admin.php?page=royesh-inbox&action=mark_unread&msg_id=' . $id),
            'royesh_toggle_msg_' . $id
        );

        $type_label = $msg->form_type === 'consultation'
            ? __('درخواست مشاوره', 'royesh')
            : __('فرم تماس با ما', 'royesh');
        $type_class = $msg->form_type === 'consultation' ? 'type-consultation' : 'type-contact';
        ?>
        <div class="wrap royesh-wrap">
            
            <div class="royesh-top-header">
                <h1>
                    <span class="dashicons dashicons-email-alt"></span>
                    <?php esc_html_e('مشاهده و جزئیات پیام', 'royesh'); ?>
                </h1>
                <div style="display:flex;gap:8px;align-items:center;">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox')); ?>" class="royesh-btn-custom">
                        ← <?php esc_html_e('بازگشت به صندوق پیام‌ها', 'royesh'); ?>
                    </a>
                    <a href="<?php echo esc_url($toggle_unread_url); ?>" class="royesh-btn-custom">
                        <?php esc_html_e('علامت‌گذاری به عنوان نخوانده', 'royesh'); ?>
                    </a>
                    <a href="<?php echo esc_url($delete_url); ?>" class="royesh-btn-custom btn-danger"
                       onclick="return confirm('<?php esc_attr_e('آیا از حذف این پیام اطمینان دارید؟', 'royesh'); ?>');">
                        <span class="dashicons dashicons-trash" style="font-size:14px;width:14px;height:14px;"></span>
                        <?php esc_html_e('حذف پیام', 'royesh'); ?>
                    </a>
                </div>
            </div>

            <div class="royesh-single-card">
                <div class="royesh-single-head">
                    <h2><?php echo esc_html($msg->subject ?: __('(بدون موضوع)', 'royesh')); ?></h2>
                    <span class="royesh-type-badge <?php echo esc_attr($type_class); ?>">
                        <?php echo esc_html($type_label); ?>
                    </span>
                </div>

                <div class="royesh-single-body">
                    <div class="royesh-info-grid">
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('نام فرستنده:', 'royesh'); ?></span>
                            <span class="info-val"><?php echo esc_html($msg->name ?: '—'); ?></span>
                        </div>
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('شماره تماس:', 'royesh'); ?></span>
                            <span class="info-val" dir="ltr">
                                <?php if ($msg->phone): ?>
                                    <a href="tel:<?php echo esc_attr($msg->phone); ?>"><?php echo esc_html($msg->phone); ?></a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('آدرس ایمیل:', 'royesh'); ?></span>
                            <span class="info-val" dir="ltr">
                                <?php if ($msg->email): ?>
                                    <a href="mailto:<?php echo esc_attr($msg->email); ?>"><?php echo esc_html($msg->email); ?></a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('زمان ارسال:', 'royesh'); ?></span>
                            <span class="info-val"><?php echo esc_html(mysql2date('j F Y — H:i', $msg->submitted_at)); ?></span>
                        </div>
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('آدرس IP فرستنده:', 'royesh'); ?></span>
                            <span class="info-val" dir="ltr"><?php echo esc_html($msg->ip_address ?: '—'); ?></span>
                        </div>
                        <div class="royesh-info-item">
                            <span class="info-label"><?php esc_html_e('شناسه پیام:', 'royesh'); ?></span>
                            <span class="info-val">#<?php echo esc_html($msg->id); ?></span>
                        </div>
                    </div>

                    <div style="font-size:13px;font-weight:700;color:#1d2327;margin-bottom:8px;">
                        <?php esc_html_e('متن کامل پیام / درخواست:', 'royesh'); ?>
                    </div>
                    <div class="royesh-msg-content-box"><?php echo esc_html($msg->message ?: __('(متن پیامی ثبت نشده است)', 'royesh')); ?></div>
                </div>
            </div>

        </div>
        <?php
        return;
    }

    // ── فیلتر و جستجو در لیست پیام‌ها ───────────────────────────
    $filter_type = isset($_GET['filter_type']) ? sanitize_text_field($_GET['filter_type']) : 'all';
    $search_term = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    $where = ["1=1"];
    $args  = [];

    if ($filter_type === 'unread') {
        $where[] = "is_read = 0";
    } elseif ($filter_type === 'contact') {
        $where[] = "form_type = 'contact'";
    } elseif ($filter_type === 'consultation') {
        $where[] = "form_type = 'consultation'";
    }

    if (!empty($search_term)) {
        $where[] = "(name LIKE %s OR phone LIKE %s OR email LIKE %s OR subject LIKE %s OR message LIKE %s)";
        $like = '%' . $wpdb->esc_like($search_term) . '%';
        $args[] = $like;
        $args[] = $like;
        $args[] = $like;
        $args[] = $like;
        $args[] = $like;
    }

    $where_sql = implode(' AND ', $where);
    if (!empty($args)) {
        $query = $wpdb->prepare("SELECT * FROM $table WHERE $where_sql ORDER BY submitted_at DESC", ...$args);
    } else {
        $query = "SELECT * FROM $table WHERE $where_sql ORDER BY submitted_at DESC";
    }

    $messages = $wpdb->get_results($query);

    // پیام‌های اطلاع‌رسانی
    $status_msg = isset($_GET['status_msg']) ? sanitize_text_field($_GET['status_msg']) : '';
    $notice_text = match($status_msg) {
        'deleted'          => __('پیام با موفقیت حذف شد.', 'royesh'),
        'all_deleted'      => __('تمامی پیام‌های صندوق با موفقیت حذف شدند.', 'royesh'),
        'selected_deleted' => __('پیام‌های انتخاب‌شده با موفقیت حذف شدند.', 'royesh'),
        'selected_read'    => __('پیام‌های انتخاب‌شده به عنوان خوانده‌شده علامت‌گذاری شدند.', 'royesh'),
        'selected_unread'  => __('پیام‌های انتخاب‌شده به عنوان نخوانده علامت‌گذاری شدند.', 'royesh'),
        'updated'          => __('وضعیت پیام با موفقیت به‌روزرسانی شد.', 'royesh'),
        default            => '',
    };
    ?>

    <div class="wrap royesh-wrap">

        <?php if ($notice_text): ?>
            <div class="notice notice-success is-dismissible" style="margin: 0 0 16px 0;">
                <p><?php echo esc_html($notice_text); ?></p>
            </div>
        <?php endif; ?>

        <!-- سربرگ بالا -->
        <div class="royesh-top-header">
            <h1>
                <span class="dashicons dashicons-email-alt"></span>
                <?php esc_html_e('صندوق پیام‌ها و درخواست‌ها', 'royesh'); ?>
            </h1>
            <div style="font-size: 13px; color: #646970;">
                <?php echo sprintf(esc_html__('مجموع کل: %s پیام', 'royesh'), number_format_i18n($stats['total'])); ?>
            </div>
        </div>

        <!-- کارت‌های آمار و فیلتر سریع -->
        <div class="royesh-stats-grid">
            <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox')); ?>" class="royesh-stat-box <?php echo $filter_type === 'all' ? 'is-active' : ''; ?>">
                <div class="royesh-stat-details">
                    <div class="royesh-stat-title"><?php esc_html_e('همه پیام‌ها', 'royesh'); ?></div>
                    <div class="royesh-stat-value"><?php echo number_format_i18n($stats['total']); ?></div>
                </div>
                <div class="royesh-stat-icon-wrap">
                    <span class="dashicons dashicons-email"></span>
                </div>
            </a>

            <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox&filter_type=unread')); ?>" class="royesh-stat-box is-unread <?php echo $filter_type === 'unread' ? 'is-active' : ''; ?>">
                <div class="royesh-stat-details">
                    <div class="royesh-stat-title"><?php esc_html_e('پیام‌های جدید (نخوانده)', 'royesh'); ?></div>
                    <div class="royesh-stat-value" style="color:#014235;"><?php echo number_format_i18n($stats['unread']); ?></div>
                </div>
                <div class="royesh-stat-icon-wrap">
                    <span class="dashicons dashicons-email-alt2"></span>
                </div>
            </a>

            <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox&filter_type=contact')); ?>" class="royesh-stat-box <?php echo $filter_type === 'contact' ? 'is-active' : ''; ?>">
                <div class="royesh-stat-details">
                    <div class="royesh-stat-title"><?php esc_html_e('فرم‌های تماس', 'royesh'); ?></div>
                    <div class="royesh-stat-value"><?php echo number_format_i18n($stats['contact']); ?></div>
                </div>
                <div class="royesh-stat-icon-wrap">
                    <span class="dashicons dashicons-phone"></span>
                </div>
            </a>

            <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox&filter_type=consultation')); ?>" class="royesh-stat-box <?php echo $filter_type === 'consultation' ? 'is-active' : ''; ?>">
                <div class="royesh-stat-details">
                    <div class="royesh-stat-title"><?php esc_html_e('درخواست‌های مشاوره', 'royesh'); ?></div>
                    <div class="royesh-stat-value"><?php echo number_format_i18n($stats['consultation']); ?></div>
                </div>
                <div class="royesh-stat-icon-wrap">
                    <span class="dashicons dashicons-businessperson"></span>
                </div>
            </a>
        </div>

        <form method="post" action="" id="royesh-inbox-form">
            <?php wp_nonce_field('royesh_bulk_inbox_nonce'); ?>
            <input type="hidden" name="royesh_bulk_action" id="royesh_bulk_action" value="">

            <!-- نوار ابزار اقدامات گروهی و جستجو -->
            <div class="royesh-toolbar-wrap">
                <div class="royesh-bulk-btns">
                    <label style="font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:6px;cursor:pointer;margin-left:8px;">
                        <input type="checkbox" id="royesh-select-all" style="margin:0;">
                        <?php esc_html_e('انتخاب همه', 'royesh'); ?>
                    </label>

                    <button type="button" class="royesh-btn-custom" onclick="royeshDoBulk('mark_read_selected')">
                        <?php esc_html_e('علامت به عنوان خوانده‌شده', 'royesh'); ?>
                    </button>

                    <button type="button" class="royesh-btn-custom" onclick="royeshDoBulk('mark_unread_selected')">
                        <?php esc_html_e('علامت به عنوان نخوانده', 'royesh'); ?>
                    </button>

                    <button type="button" class="royesh-btn-custom btn-danger" onclick="royeshDoBulk('delete_selected')">
                        <span class="dashicons dashicons-trash" style="font-size:14px;width:14px;height:14px;"></span>
                        <?php esc_html_e('حذف انتخاب‌شده‌ها', 'royesh'); ?>
                    </button>
                </div>

                <div class="royesh-search-box">
                    <input type="search" name="s" value="<?php echo esc_attr($search_term); ?>" placeholder="<?php esc_attr_e('جستجو در پیام‌ها...', 'royesh'); ?>" />
                    <button type="submit" class="royesh-btn-custom" style="height:32px;">
                        <?php esc_html_e('جستجو', 'royesh'); ?>
                    </button>
                    <?php if (!empty($search_term)): ?>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox')); ?>" class="royesh-btn-custom btn-danger">
                            <?php esc_html_e('پاکسازی', 'royesh'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- جدول لیست پیام‌ها -->
            <div class="royesh-table-box">
                <?php if (empty($messages)): ?>
                    <div class="royesh-empty-box">
                        <span class="dashicons dashicons-email-alt"></span>
                        <p><?php esc_html_e('هیچ پیامی در این بخش یافت نشد.', 'royesh'); ?></p>
                    </div>
                <?php else: ?>
                    <table class="royesh-table-main">
                        <thead>
                            <tr>
                                <th style="width: 32px; text-align: center;"></th>
                                <th style="width: 24px;"></th>
                                <th><?php esc_html_e('فرستنده', 'royesh'); ?></th>
                                <th><?php esc_html_e('شماره تماس', 'royesh'); ?></th>
                                <th><?php esc_html_e('موضوع / عنوان', 'royesh'); ?></th>
                                <th><?php esc_html_e('نوع فرم', 'royesh'); ?></th>
                                <th><?php esc_html_e('زمان دریافت', 'royesh'); ?></th>
                                <th style="text-align: center; width: 120px;"><?php esc_html_e('عملیات', 'royesh'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $msg):
                                $is_unread     = (int) $msg->is_read === 0;
                                $row_class     = $is_unread ? 'is-unread-row' : '';
                                $view_url      = admin_url('admin.php?page=royesh-inbox&view=1&msg_id=' . $msg->id);
                                $toggle_action = $is_unread ? 'mark_read' : 'mark_unread';
                                $toggle_url    = wp_nonce_url(
                                    admin_url('admin.php?page=royesh-inbox&action=' . $toggle_action . '&msg_id=' . $msg->id),
                                    'royesh_toggle_msg_' . $msg->id
                                );
                                $delete_url    = wp_nonce_url(
                                    admin_url('admin.php?page=royesh-inbox&action=delete&msg_id=' . $msg->id),
                                    'royesh_delete_msg_' . $msg->id
                                );
                                $type_label    = $msg->form_type === 'consultation' ? __('درخواست مشاوره', 'royesh') : __('فرم تماس', 'royesh');
                                $type_class    = $msg->form_type === 'consultation' ? 'type-consultation' : 'type-contact';
                            ?>
                            <tr class="<?php echo esc_attr($row_class); ?>">
                                <td style="text-align: center;">
                                    <input type="checkbox" name="msg_ids[]" value="<?php echo esc_attr($msg->id); ?>" class="royesh-msg-cb">
                                </td>
                                <td>
                                    <?php if ($is_unread): ?>
                                        <span class="royesh-unread-badge" title="<?php esc_attr_e('پیام جدید', 'royesh'); ?>"></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url($view_url); ?>" class="royesh-sender-link">
                                        <?php echo esc_html($msg->name ?: __('(بدون نام)', 'royesh')); ?>
                                    </a>
                                </td>
                                <td dir="ltr" style="text-align: right;">
                                    <?php echo esc_html($msg->phone ?: '—'); ?>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url($view_url); ?>" style="color:inherit;text-decoration:none;">
                                        <?php echo esc_html(mb_strimwidth($msg->subject ?: ($msg->message ?: __('(بدون موضوع)', 'royesh')), 0, 45, '…')); ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="royesh-type-badge <?php echo esc_attr($type_class); ?>">
                                        <?php echo esc_html($type_label); ?>
                                    </span>
                                </td>
                                <td style="font-size: 12px; color: #646970;">
                                    <?php echo esc_html(mysql2date('j F Y — H:i', $msg->submitted_at)); ?>
                                </td>
                                <td style="text-align: center;">
                                    <div class="royesh-action-group">
                                        <a href="<?php echo esc_url($view_url); ?>" class="royesh-action-btn action-view" title="<?php esc_attr_e('مشاهده کامل پیام', 'royesh'); ?>">
                                            <span class="dashicons dashicons-visibility"></span>
                                        </a>
                                        <a href="<?php echo esc_url($toggle_url); ?>" class="royesh-action-btn action-toggle-read" title="<?php echo $is_unread ? esc_attr__('علامت‌گذاری به عنوان خوانده‌شده', 'royesh') : esc_attr__('علامت‌گذاری به عنوان نخوانده', 'royesh'); ?>">
                                            <span class="dashicons <?php echo $is_unread ? 'dashicons-yes-alt' : 'dashicons-email-alt'; ?>"></span>
                                        </a>
                                        <a href="<?php echo esc_url($delete_url); ?>" class="royesh-action-btn action-delete" title="<?php esc_attr_e('حذف پیام', 'royesh'); ?>"
                                           onclick="return confirm('<?php esc_attr_e('آیا از حذف این پیام اطمینان دارید؟', 'royesh'); ?>');">
                                            <span class="dashicons dashicons-trash"></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </form>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectAll = document.getElementById('royesh-select-all');
        var checkboxes = document.querySelectorAll('.royesh-msg-cb');

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(function(cb) {
                    cb.checked = selectAll.checked;
                });
            });
        }
    });

    function royeshDoBulk(action) {
        var checked = document.querySelectorAll('.royesh-msg-cb:checked');
        if (checked.length === 0) {
            alert('لطفاً حداقل یک پیام را از جدول انتخاب کنید.');
            return;
        }

        if (action === 'delete_selected' && !confirm('آیا از حذف پیام‌های انتخاب‌شده اطمینان دارید؟')) {
            return;
        }

        var form = document.getElementById('royesh-inbox-form');
        var actionInput = document.getElementById('royesh_bulk_action');
        if (form && actionInput) {
            actionInput.value = action;
            form.submit();
        }
    }
    </script>
    <?php
}
