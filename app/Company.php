<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
    	'company_name', 'company_shortname', 'company_logo', 'company_address', 'company_phone', 'company_fax', 'company_email', 'company_homepage', 'company_pic'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public static function companyList() {
    	$companies = self::all();
    	$list = array();
    	foreach ($companies as $company) {
    		$list[$company->id] = $company->company_name;
    	}
    	return $list;
    }
}
