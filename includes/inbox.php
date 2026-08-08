<?php
/**
 * Royesh Message Inbox — Admin Panel
 *
 * جدول پایگاه داده، منوی ادمین، صندوق پیام با badge خوانده/نخوانده
 *
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ────────────────────────────────────────────────────────────────
// ۱) ایجاد جدول در پایگاه داده (اجرا هنگام فعال شدن تم)
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

    update_option('royesh_inbox_db_version', '1.0');
}
add_action('after_switch_theme', 'royesh_create_inbox_table');

// اجرا در صورت عدم وجود جدول (اولین بارگذاری)
function royesh_maybe_create_inbox_table() {
    if (get_option('royesh_inbox_db_version') !== '1.0') {
        royesh_create_inbox_table();
    }
}
add_action('init', 'royesh_maybe_create_inbox_table');


// ────────────────────────────────────────────────────────────────
// ۲) ذخیره پیام در جدول
// ────────────────────────────────────────────────────────────────

/**
 * ذخیره پیام ورودی در صندوق پیام
 *
 * @param array $data
 * @return int|false  شناسه رکورد یا false در صورت خطا
 */
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
// ۳) شمارش پیام‌های خوانده‌نشده
// ────────────────────────────────────────────────────────────────

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
        __('صندوق پیام', 'royesh'),
        __('صندوق پیام', 'royesh') . $badge,
        'manage_options',
        'royesh-inbox',
        'royesh_render_inbox_page',
        'dashicons-email-alt',
        25
    );
}
add_action('admin_menu', 'royesh_register_inbox_menu');


// ────────────────────────────────────────────────────────────────
// ۵) استایل‌های صفحه ادمین
// ────────────────────────────────────────────────────────────────

function royesh_inbox_admin_styles($hook) {
    if ($hook !== 'toplevel_page_royesh-inbox') return;

    echo '<style>
        /* ── Inbox Layout ────────────────────────────── */
        .royesh-inbox-wrap { max-width: 1100px; margin: 24px auto; font-family: inherit; direction: rtl; }
        .royesh-inbox-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; flex-wrap: wrap; gap: 12px; }
        .royesh-inbox-header h1 { font-size: 22px; font-weight: 700; color: #1e1e1e; display: flex; align-items: center; gap: 10px; }
        .royesh-inbox-header h1 .dashicons { font-size: 26px; color: #014235; }

        /* ── Action Bar ──────────────────────────────── */
        .royesh-action-bar { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
        .royesh-btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; text-decoration: none; }
        .royesh-btn-danger { background: #dc3545; color: #fff; }
        .royesh-btn-danger:hover { background: #bb2d3b; color: #fff; }
        .royesh-btn-secondary { background: #f0f0f1; color: #3c434a; border: 1px solid #c3c4c7; }
        .royesh-btn-secondary:hover { background: #e4e4e4; color: #1d2327; }
        .royesh-btn-success { background: #014235; color: #fff; }
        .royesh-btn-success:hover { background: #012d24; color: #fff; }

        /* ── Table ───────────────────────────────────── */
        .royesh-inbox-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .royesh-inbox-table thead th { background: #014235; color: #fff; padding: 12px 16px; font-size: 13px; font-weight: 600; text-align: right; }
        .royesh-inbox-table tbody tr { border-bottom: 1px solid #f0f0f1; transition: background 0.15s; }
        .royesh-inbox-table tbody tr:hover { background: #f9f9f9; }
        .royesh-inbox-table tbody tr.royesh-unread { background: #f0faf6; font-weight: 600; }
        .royesh-inbox-table tbody tr.royesh-unread:hover { background: #e6f5ef; }
        .royesh-inbox-table td { padding: 12px 16px; font-size: 13px; color: #3c434a; vertical-align: middle; }
        .royesh-inbox-table td a { color: #014235; text-decoration: none; font-weight: 600; }
        .royesh-inbox-table td a:hover { text-decoration: underline; }
        .royesh-unread-dot { width: 8px; height: 8px; border-radius: 50%; background: #014235; display: inline-block; margin-left: 6px; flex-shrink: 0; }
        .royesh-badge-type { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .royesh-badge-contact { background: #e8f5f2; color: #014235; }
        .royesh-badge-consultation { background: #fff3e0; color: #e65100; }

        /* ── Single Message ──────────────────────────── */
        .royesh-message-card { background: #fff; border-radius: 14px; padding: 28px 32px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 760px; }
        .royesh-message-card h2 { font-size: 20px; font-weight: 700; margin-bottom: 20px; color: #1e1e1e; border-bottom: 2px solid #014235; padding-bottom: 12px; }
        .royesh-meta-row { display: flex; gap: 8px; margin-bottom: 8px; align-items: flex-start; }
        .royesh-meta-label { font-size: 12px; font-weight: 700; color: #014235; min-width: 90px; padding-top: 2px; }
        .royesh-meta-value { font-size: 14px; color: #3c434a; }
        .royesh-message-body { margin-top: 20px; background: #f9f9f9; border-right: 3px solid #014235; padding: 16px 18px; border-radius: 8px; font-size: 14px; line-height: 1.8; color: #1d2327; white-space: pre-wrap; }

        /* ── Empty State ─────────────────────────────── */
        .royesh-empty { text-align: center; padding: 60px 20px; color: #999; }
        .royesh-empty .dashicons { font-size: 48px; display: block; margin-bottom: 12px; color: #ccc; }
        .royesh-empty p { font-size: 15px; }

        /* ── Checkbox ────────────────────────────────── */
        .royesh-inbox-table td input[type=checkbox] { width: 16px; height: 16px; cursor: pointer; accent-color: #014235; }
    </style>';
}
add_action('admin_head', 'royesh_inbox_admin_styles');


// ────────────────────────────────────────────────────────────────
// ۶) پردازش اکشن‌های ادمین (حذف، علامت خوانده)
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
        wp_redirect(admin_url('admin.php?page=royesh-inbox&deleted=1'));
        exit;
    }

    // حذف دسته‌ای
    if (isset($_POST['royesh_bulk_action'], $_POST['_wpnonce']) && $_POST['royesh_bulk_action'] === 'delete_all') {
        check_admin_referer('royesh_bulk_inbox');
        $wpdb->query("DELETE FROM $table");
        wp_redirect(admin_url('admin.php?page=royesh-inbox&deleted=all'));
        exit;
    }

    // حذف انتخابی
    if (isset($_POST['royesh_bulk_action'], $_POST['_wpnonce'], $_POST['msg_ids'])
        && $_POST['royesh_bulk_action'] === 'delete_selected'
    ) {
        check_admin_referer('royesh_bulk_inbox');
        $ids = array_map('intval', (array) $_POST['msg_ids']);
        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '%d'));
            $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id IN ($placeholders)", ...$ids));
        }
        wp_redirect(admin_url('admin.php?page=royesh-inbox&deleted=selected'));
        exit;
    }
}
add_action('admin_init', 'royesh_inbox_handle_actions');


// ────────────────────────────────────────────────────────────────
// ۷) رندر صفحه Inbox
// ────────────────────────────────────────────────────────────────

function royesh_render_inbox_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('دسترسی غیرمجاز', 'royesh'));
    }

    global $wpdb;
    $table = $wpdb->prefix . 'royesh_messages';

    // ── نمایش پیام تکی ──────────────────────────────────────────
    if (isset($_GET['view'], $_GET['msg_id'])) {
        $id  = (int) $_GET['msg_id'];
        $msg = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $id));

        if (!$msg) {
            echo '<div class="notice notice-error"><p>' . esc_html__('پیام یافت نشد.', 'royesh') . '</p></div>';
            return;
        }

        // علامت خوانده‌شده
        if (!$msg->is_read) {
            $wpdb->update($table, ['is_read' => 1], ['id' => $id], ['%d'], ['%d']);
        }

        $delete_url = wp_nonce_url(
            admin_url('admin.php?page=royesh-inbox&action=delete&msg_id=' . $id),
            'royesh_delete_msg_' . $id
        );

        $type_label = $msg->form_type === 'consultation'
            ? __('درخواست مشاوره', 'royesh')
            : __('فرم تماس', 'royesh');
        $type_class = $msg->form_type === 'consultation' ? 'royesh-badge-consultation' : 'royesh-badge-contact';
        ?>
        <div class="royesh-inbox-wrap">
            <div class="royesh-inbox-header">
                <h1>
                    <span class="dashicons dashicons-email-alt"></span>
                    <?php esc_html_e('نمایش پیام', 'royesh'); ?>
                </h1>
                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                    <a href="<?php echo esc_url(admin_url('admin.php?page=royesh-inbox')); ?>" class="royesh-btn royesh-btn-secondary">
                        ← <?php esc_html_e('بازگشت به صندوق', 'royesh'); ?>
                    </a>
                    <a href="<?php echo esc_url($delete_url); ?>" class="royesh-btn royesh-btn-danger"
                       onclick="return confirm('<?php esc_attr_e('آیا از حذف این پیام اطمینان دارید؟', 'royesh'); ?>')">
                        <span class="dashicons dashicons-trash" style="font-size:16px;"></span>
                        <?php esc_html_e('حذف پیام', 'royesh'); ?>
                    </a>
                </div>
            </div>

            <div class="royesh-message-card">
                <h2><?php echo esc_html($msg->subject ?: __('(بدون موضوع)', 'royesh')); ?></h2>

                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('نوع فرم:', 'royesh'); ?></span>
                    <span class="royesh-meta-value">
                        <span class="royesh-badge-type <?php echo esc_attr($type_class); ?>"><?php echo esc_html($type_label); ?></span>
                    </span>
                </div>
                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('فرستنده:', 'royesh'); ?></span>
                    <span class="royesh-meta-value"><?php echo esc_html($msg->name); ?></span>
                </div>
                <?php if ($msg->phone): ?>
                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('تلفن:', 'royesh'); ?></span>
                    <span class="royesh-meta-value" dir="ltr"><?php echo esc_html($msg->phone); ?></span>
                </div>
                <?php endif; ?>
                <?php if ($msg->email): ?>
                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('ایمیل:', 'royesh'); ?></span>
                    <span class="royesh-meta-value" dir="ltr"><?php echo esc_html($msg->email); ?></span>
                </div>
                <?php endif; ?>
                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('تاریخ:', 'royesh'); ?></span>
                    <span class="royesh-meta-value"><?php echo esc_html(mysql2date('j F Y — H:i', $msg->submitted_at)); ?></span>
                </div>
                <?php if ($msg->ip_address): ?>
                <div class="royesh-meta-row">
                    <span class="royesh-meta-label"><?php esc_html_e('آی‌پی:', 'royesh'); ?></span>
                    <span class="royesh-meta-value" dir="ltr"><?php echo esc_html($msg->ip_address); ?></span>
                </div>
                <?php endif; ?>

                <div class="royesh-message-body"><?php echo esc_html($msg->message); ?></div>
            </div>
        </div>
        <?php
        return;
    }

    // ── لیست پیام‌ها ─────────────────────────────────────────────
    $messages = $wpdb->get_results("SELECT * FROM $table ORDER BY submitted_at DESC");
    $unread   = royesh_unread_count();

    $notice = '';
    if (isset($_GET['deleted'])) {
        $notice = match($_GET['deleted']) {
            'all'      => __('همه پیام‌ها با موفقیت حذف شدند.', 'royesh'),
            'selected' => __('پیام‌های انتخاب‌شده حذف شدند.', 'royesh'),
            default    => __('پیام حذف شد.', 'royesh'),
        };
    }
    ?>
    <div class="royesh-inbox-wrap">

        <?php if ($notice): ?>
        <div class="notice notice-success is-dismissible"><p><?php echo esc_html($notice); ?></p></div>
        <?php endif; ?>

        <div class="royesh-inbox-header">
            <h1>
                <span class="dashicons dashicons-email-alt"></span>
                <?php esc_html_e('صندوق پیام', 'royesh'); ?>
                <?php if ($unread > 0): ?>
                    <span style="background:#014235;color:#fff;font-size:12px;padding:2px 10px;border-radius:20px;font-weight:700;">
                        <?php echo number_format_i18n($unread); ?> <?php esc_html_e('نخوانده', 'royesh'); ?>
                    </span>
                <?php endif; ?>
            </h1>
            <div style="font-size:13px;color:#666;"><?php echo number_format_i18n(count($messages)); ?> <?php esc_html_e('پیام دریافتی', 'royesh'); ?></div>
        </div>

        <?php if (empty($messages)): ?>
        <div class="royesh-empty">
            <span class="dashicons dashicons-email-alt"></span>
            <p><?php esc_html_e('هیچ پیامی در صندوق وجود ندارد.', 'royesh'); ?></p>
        </div>
        <?php else: ?>

        <form method="post" action="">
            <?php wp_nonce_field('royesh_bulk_inbox'); ?>
            <input type="hidden" name="royesh_bulk_action" id="royesh_bulk_action" value="">

            <div class="royesh-action-bar">
                <button type="submit" class="royesh-btn royesh-btn-danger"
                        onclick="document.getElementById('royesh_bulk_action').value='delete_all';return confirm('<?php esc_attr_e('آیا از حذف تمام پیام‌ها اطمینان دارید؟', 'royesh'); ?>');">
                    <span class="dashicons dashicons-trash" style="font-size:15px;"></span>
                    <?php esc_html_e('حذف همه پیام‌ها', 'royesh'); ?>
                </button>
                <button type="submit" class="royesh-btn royesh-btn-secondary"
                        onclick="document.getElementById('royesh_bulk_action').value='delete_selected';var c=document.querySelectorAll('.royesh-msg-cb:checked');if(c.length===0){alert('<?php esc_attr_e('لطفاً حداقل یک پیام را انتخاب کنید.', 'royesh'); ?>');return false;}return confirm('<?php esc_attr_e('پیام‌های انتخاب‌شده حذف شوند؟', 'royesh'); ?>');">
                    <span class="dashicons dashicons-trash" style="font-size:15px;"></span>
                    <?php esc_html_e('حذف انتخاب‌شده‌ها', 'royesh'); ?>
                </button>
                <label style="font-size:13px;color:#555;display:flex;align-items:center;gap:5px;cursor:pointer;">
                    <input type="checkbox" id="royesh-select-all" onclick="document.querySelectorAll('.royesh-msg-cb').forEach(cb=>cb.checked=this.checked);">
                    <?php esc_html_e('انتخاب همه', 'royesh'); ?>
                </label>
            </div>

            <table class="royesh-inbox-table">
                <thead>
                    <tr>
                        <th style="width:36px;"></th>
                        <th><?php esc_html_e('فرستنده', 'royesh'); ?></th>
                        <th><?php esc_html_e('تلفن', 'royesh'); ?></th>
                        <th><?php esc_html_e('موضوع', 'royesh'); ?></th>
                        <th><?php esc_html_e('نوع', 'royesh'); ?></th>
                        <th><?php esc_html_e('تاریخ ارسال', 'royesh'); ?></th>
                        <th><?php esc_html_e('وضعیت', 'royesh'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg):
                        $row_class  = !$msg->is_read ? 'royesh-unread' : '';
                        $view_url   = admin_url('admin.php?page=royesh-inbox&view=1&msg_id=' . $msg->id);
                        $type_label = $msg->form_type === 'consultation' ? __('مشاوره', 'royesh') : __('تماس', 'royesh');
                        $type_class = $msg->form_type === 'consultation' ? 'royesh-badge-consultation' : 'royesh-badge-contact';
                    ?>
                    <tr class="<?php echo esc_attr($row_class); ?>">
                        <td><input type="checkbox" name="msg_ids[]" value="<?php echo esc_attr($msg->id); ?>" class="royesh-msg-cb"></td>
                        <td>
                            <?php if (!$msg->is_read): ?>
                                <span class="royesh-unread-dot"></span>
                            <?php endif; ?>
                            <a href="<?php echo esc_url($view_url); ?>"><?php echo esc_html($msg->name ?: '—'); ?></a>
                        </td>
                        <td dir="ltr"><?php echo esc_html($msg->phone ?: '—'); ?></td>
                        <td><?php echo esc_html(mb_strimwidth($msg->subject ?: __('(بدون موضوع)', 'royesh'), 0, 50, '…')); ?></td>
                        <td><span class="royesh-badge-type <?php echo esc_attr($type_class); ?>"><?php echo esc_html($type_label); ?></span></td>
                        <td><?php echo esc_html(mysql2date('j F Y', $msg->submitted_at)); ?></td>
                        <td>
                            <?php if ($msg->is_read): ?>
                                <span style="color:#888;font-size:12px;">✓ <?php esc_html_e('خوانده‌شده', 'royesh'); ?></span>
                            <?php else: ?>
                                <span style="color:#014235;font-size:12px;font-weight:700;">● <?php esc_html_e('جدید', 'royesh'); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>

        <?php endif; ?>
    </div>
    <?php
}
