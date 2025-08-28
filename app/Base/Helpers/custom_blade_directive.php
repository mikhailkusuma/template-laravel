<?php

use Illuminate\Support\Facades\Blade;

if (!function_exists("boot_custom_blade_directive")) {
    function boot_custom_blade_directive()
    {
        Blade::directive("generate_navbar", function ($expr) {
            $explodeArr = explode(';', $expr);
            $segment = [];
            $breadcrumbTitle = null;
            foreach ($explodeArr as $_explodeArr) {
                $currentSegment = [];
                $explodeSegment = explode(',', $_explodeArr);
                foreach ($explodeSegment as $_explodeSegment) {
                    $explodeSubSegment = explode('=', $_explodeSegment);
                    if ($explodeSubSegment[0] == 'h') {
                        $currentSegment['href'] = preg_replace("/(\'|\")+/", "", $explodeSubSegment[1]);
                    }
                    if ($explodeSubSegment[0] == 't') {
                        $currentSegment['title'] = preg_replace("/(\'|\")+/", "", $explodeSubSegment[1]);
                    }
                    if ($explodeSubSegment[0] == 'tt') {
                        $breadcrumbTitle = preg_replace("/(\'|\")+/", "", $explodeSubSegment[1]);
                    }
                }
                $segment[] = $currentSegment;
            }

            $breadcrumbBuilder = "";
            $breadcrumbTitle = $breadcrumbTitle ?? $segment[count($segment) - 1]['title'];

            foreach ($segment as $_segment) {
                $breadcrumbBuilder .= '<li class="breadcrumb-item">';
                if (array_key_exists("href", $_segment)) {
                    $breadcrumbBuilder .= '<a class="text-muted text-decoration-none" href="' . $_segment['href'] . '">' . $_segment['title'] . '</a>';
                } else {
                    $breadcrumbBuilder .= $_segment['title'];
                }
                $breadcrumbBuilder .= '</li>';
            }

            $strBuilder = '<div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">' . $breadcrumbTitle . '</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    ' . $breadcrumbBuilder . '
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>';

            return $strBuilder;
        });
    }
}
