<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

class HelpersTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_unslug()
    {
        $this->assertEquals('hello world', unslug('hello-world'));
    }

    public function test_get_navbar_items()
    {
        $this->assertEquals(
            [
                [
                    'name' => 'Home',
                    'route' => config('app.url'),
                ],
                [
                    'name' => 'Prima serata',
                    'route' => config('app.url') . '/channels/tv-groups/digitale-terrestre/times/prime-time',
                ],
                [
                    'name' => 'Seconda serata',
                    'route' => config('app.url') . '/channels/tv-groups/digitale-terrestre/times/second-night',
                ],
            ],
            getNavbarItems(),
        );
    }

    public function test_get_tabs()
    {
        $this->assertEquals(
            [
                [
                    'name' => 'Digitale terrestre',
                    'sub_tv_groups' => null,
                ],
                //                [
                //                    'name' => 'Premium',
                //                    'sub_tv_groups' => null,
                //                ],
                [
                    'name' => 'Sky',
                    'sub_tv_groups' => [
                        'Sky Bambini',
                        'Sky Cinema',
                        'Sky Doc e Lifestyle',
                        'Sky Intrattenimento',
                        'Sky Sport',
                    ],
                ],
            ],
            getTabs(),
        );
    }

    public function test_delete_file()
    {
        $filePath = public_path('test_delete_file.txt');

        fopen($filePath, 'w');

        $this->assertTrue(file_exists($filePath));

        deleteFile($filePath);

        $this->assertFalse(file_exists($filePath));
    }
}
