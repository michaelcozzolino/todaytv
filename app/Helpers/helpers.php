<?php

use App\Classes\ValidTvTime;
use App\Models\TvGroup;

if (!function_exists('getNavbarItems')) {
    function getNavbarItems()
    {
        return [
            [
                'name' => 'Home',
                'route' => route('home'),
            ],
            [
                'name' => 'Prima serata',
                'route' => TvGroup::route(time: ValidTvTime::PRIME_TIME),
            ],
            [
                'name' => 'Seconda serata',
                'route' => TvGroup::route(time: ValidTvTime::SECOND_NIGHT),
            ],
        ];
    }
}

if (!function_exists('getTabs')) {
    function getTabs()
    {
        $tvGroups = TvGroup::getGroupedTvGroups();

        $tabs = [];

        foreach ($tvGroups as $tvGroup) {
            $data = [];

            $data['name'] = $tvGroup->name;

            $data['sub_tv_groups'] = is_null($tvGroup->sub_tv_groups)
                ? null
                : array_map(fn ($element) => $tvGroup->name . ' ' . $element, explode(',', $tvGroup->sub_tv_groups));

            $tabs[] = $data;
        }

        return $tabs;
    }
}

if (!function_exists('getHeadData')) {
    function getHeadData(array $info)
    {
        $headData = [];

        switch (Route::currentRouteName()) {
            case 'tv-show-details.show':
                $headData = [
                    'title' => $info['tv_show_detail']->title,
                    'description' => $info['tv_show_detail']->description,
                ];
                break;

            case 'channels.index':
                $headData = [
                    'title' => ucwords(__(unslug($info['tv_group']->name)) . ' - ' . __(unslug($info['time']))),
                    'description' => config('app.description'),
                ];
                break;

            case 'channels.show':
                $headData = [
                    'title' => $info['channel']->name,
                    'description' => $info['channel']->name . ' - Palinsesto televisivo di oggi',
                ];
                break;
            case 'privacy':
                $headData = [
                    'title' => 'Privacy Policy',
                ];
                break;
        }

        return $headData;
    }
}

if (!function_exists('unslug')) {
    function unslug(string $string)
    {
        return Str::of($string)->replace('-', ' ')->value;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile(string $filePath)
    {
        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }
}
