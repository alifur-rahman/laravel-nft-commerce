<?php
namespace App\Services;

use App\Models\CompanyInfo;

class CompanyInfoService
{
    public function __call($name, $data)
    {
    }
    public static function __callStatic($name, $data)
    {
        if ($name === 'com_name') {
            return (new self)->get_company_name();
        }
    }
    private function get_company_name()
    {
        $name = CompanyInfo::select('com_name')->first();
        if (isset($name->com_name) && $name->com_name != "") {
            $name = $name->com_name;
        }
        else {
            $name = "One Nft";
        }
        return $name;
    }
}
