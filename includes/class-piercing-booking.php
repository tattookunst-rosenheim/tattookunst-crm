<?php

if (!defined('ABSPATH')) {
    exit;
}

class PiercingBooking {

    public static function init() {
        add_shortcode(
            'tattookunst_piercing_beratung',
            [__CLASS__, 'render_shortcode']
        );
    }

    public static function render_shortcode() {
        $template = dirname(__FILE__) . '/../templates/piercing-beratung-form.php';
        $consent_script = dirname(__FILE__) . '/../assets/js/piercing-consent.js';

        if (!file_exists($template)) {
            return '<p>Das Buchungsformular konnte nicht geladen werden.</p>';
        }

        if (file_exists($consent_script)) {
            wp_enqueue_script(
                'tattookunst-piercing-consent',
                plugins_url('../assets/js/piercing-consent.js', __FILE__),
                [],
                (string) filemtime($consent_script),
                true
            );
        }

        $piercing_categories = self::get_piercing_categories();
        $appointment_days = self::get_appointment_days();

        ob_start();
        include $template;
        return ob_get_clean();
    }

    private static function get_appointment_days() {
        $timezone = wp_timezone();
        $now = new DateTimeImmutable('now', $timezone);
        $day = $now->setTime(0, 0);
        $appointment_days = [];
        $valid_days_found = 0;

        while ($valid_days_found < 16) {
            $day = $day->modify('+1 day');
            $weekday = (int) $day->format('N');

            if ($weekday < 2 || $weekday > 5) {
                continue;
            }

            $slots = [];

            foreach (['16:00', '16:20', '16:40', '17:00', '17:20', '17:40'] as $time) {
                $slot = new DateTimeImmutable(
                    $day->format('Y-m-d') . ' ' . $time,
                    $timezone
                );

                if ($slot <= $now) {
                    continue;
                }

                $slots[] = [
                    'value' => $slot->format('Y-m-d H:i:s'),
                    'time' => $slot->format('H:i'),
                ];
            }

            if (empty($slots)) {
                continue;
            }

            $appointment_days[] = [
                'date' => $day->format('Y-m-d'),
                'weekday' => wp_date('l', $day->getTimestamp(), $timezone),
                'label' => wp_date('d.m.Y', $day->getTimestamp(), $timezone),
                'slots' => $slots,
            ];

            $valid_days_found++;
        }

        return $appointment_days;
    }

    private static function get_piercing_categories() {
        return [
            'ohr' => [
                'label' => 'Ohr-Piercings',
                'body_location' => 'Ohr',
                'items' => [
                    ['name' => 'Ohrloch', 'price' => 35],
                    ['name' => 'Ohrlöcher', 'price' => 45],
                    ['name' => 'Upper Lobe', 'price' => 49],
                    ['name' => 'Transverse Lobe', 'price' => 49],
                    ['name' => 'Tragus', 'price' => 49],
                    ['name' => 'Anti-Tragus', 'price' => 49],
                    ['name' => 'Helix', 'price' => 49],
                    ['name' => 'Forward Helix', 'price' => 49],
                    ['name' => 'Conch', 'price' => 49],
                    ['name' => 'Flat', 'price' => 49],
                    ['name' => 'Rook', 'price' => 49],
                    ['name' => 'Daith', 'price' => 49],
                    ['name' => 'Snug', 'price' => 49],
                    ['name' => 'Orbital', 'price' => 49],
                    ['name' => 'Industrial', 'price' => 59],
                ],
            ],
            'gesicht' => [
                'label' => 'Gesichts-Piercings',
                'body_location' => 'Gesicht',
                'items' => [
                    ['name' => 'Augenbraue', 'price' => 49],
                    ['name' => 'Nostril Stecker', 'price' => 49],
                    ['name' => 'Nostril Ring', 'price' => 49],
                    ['name' => 'Septum', 'price' => 49],
                ],
            ],
            'mund' => [
                'label' => 'Mund-Piercings',
                'body_location' => 'Mund',
                'items' => [
                    ['name' => 'Labret', 'price' => 49],
                    ['name' => 'Vertical Labret / Eskimo', 'price' => 49],
                    ['name' => 'Medusa', 'price' => 49],
                    ['name' => 'Madonna / Monroe', 'price' => 49],
                    ['name' => 'Jestrum', 'price' => 49],
                    ['name' => 'Dahlia', 'price' => 85],
                    ['name' => 'Cyber Bites', 'price' => 85],
                    ['name' => 'Angel Bites', 'price' => 85],
                    ['name' => 'Dolphin Bites', 'price' => 85],
                    ['name' => 'Spider Bites', 'price' => 85],
                    ['name' => 'Snake Bites', 'price' => 85],
                    ['name' => 'Shark Bites', 'price' => 85],
                    ['name' => 'Zunge', 'price' => 49],
                ],
            ],
            'koerper' => [
                'label' => 'Körper-Piercings',
                'body_location' => 'Körper',
                'items' => [
                    ['name' => 'Bauchnabel', 'price' => 49],
                    ['name' => 'Dermal Anchor', 'price' => 65],
                    ['name' => 'Brustwarze', 'price' => 59],
                    ['name' => 'Intim Frau', 'price' => 59],
                ],
            ],
        ];
    }
}
