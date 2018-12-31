<?php
/**
 * Copyright (C) 2018 Kenneth J. Brucker <ken@pumastudios.com>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace PumaStudios\WpLibrary;

/**
 * Class AdminNotice
 *
 * WP defines the following classes for display via admin_notices hook:
 *  - updated (Green)
 *  - update-nag  (Yellow)
 *  - error (Red)
 *
 */
class AdminNotice
{

    /**
     * @var string The notice itself
     */
    public $notice;

    /**
     * @var string Class to be applied to notice
     */
    public $class;

    /**
     * AdminNotice constructor.
     *
     * @param string $class Class to apply to notice
     * @param string $notice Notice to be displayed on Admin Screen
     */
    public function __construct($class, $notice)
    {
        $this->class = $class;
        $this->notice = $notice;

        add_action('admin_notices', [$this, 'displayAdminNotice']);
    }

    /**
     * Queue log message in admin screen
     *
     * @param string $notice string for display in admin screen
     */
    public static function log($notice)
    {
        return new AdminNotice('updated', $notice);
    }

    /**
     * Queue warning message in admin screen
     *
     * @param string $notice string for display in admin screen
     */
    public static function warn($notice)
    {
        return new AdminNotice('update-nag', $notice);
    }

    /**
     * Queue error message in admin screen
     *
     * @param string $notice string for display in admin screen
     */
    public static function error($notice)
    {
        return new AdminNotice('error', $notice);
    }

    /**
     * Display queued message during admin_notices hook
     */
    public function displayAdminNotice()
    {
        printf('<div class=%s><p>%s</p></div>', esc_attr($this->class), esc_html($this->notice));
    }
}