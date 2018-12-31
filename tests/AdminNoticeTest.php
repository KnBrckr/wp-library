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

namespace PumaStudios\Library;

class AdminNoticeTest extends \WP_UnitTestCase
{

    public function test__construct()
    {
        $notice = new AdminNotice('class', 'Notice String');

        $this->assertInstanceOf(AdminNotice::class, $notice);
        $this->assertEquals(10, has_action('admin_notices', [$notice, 'displayAdminNotice']));
    }

    public function testDisplayAdminNotice()
    {
        $notice = new AdminNotice('class', 'Notice String');

        ob_start();
        $notice->displayAdminNotice();
        $output = ob_get_clean();

        $this->assertContains('Notice String', $output);
    }

    public function testError()
    {
        $notice = AdminNotice::error('Error Message');

        $this->assertEquals(10, has_action('admin_notices', [$notice, 'displayAdminNotice']));
        $this->assertEquals('error', $notice->class);
    }

    public function testLog()
    {
        $notice = AdminNotice::log('Log Message');

        $this->assertEquals(10, has_action('admin_notices', [$notice, 'displayAdminNotice']));
        $this->assertEquals('updated', $notice->class);
    }

    public function testWarn()
    {
        $notice = AdminNotice::warn('Warning Message');

        $this->assertEquals(10, has_action('admin_notices', [$notice, 'displayAdminNotice']));
        $this->assertEquals('update-nag', $notice->class);
    }
}
