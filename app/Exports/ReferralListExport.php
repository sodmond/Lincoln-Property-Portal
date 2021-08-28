<?php

namespace App\Exports;

use App\Customer;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ReferralListExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $date;

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getWeek()
    {
        $wk = Customer::selectRaw("WEEK('".$this->date."') AS wknum")->first();
        //dd($wk);
        return $wk->wknum;
    }

    public function collection()
    {
        $refList = Customer::whereRaw("WEEK(created_at) = WEEK('".$this->date."')")
            ->select('firstname', 'lastname', 'email', 'gender', 'dob', 
                DB::raw('LPAD(phone, 11, 0)'), 'state', 'country',
                'ref_code', 'acct_name', 'bank_name', DB::raw('LPAD(acct_num, 10, 0)'),
                'ref_by', 'created_at'
            )->orderBy('created_at')
            ->get();
        return $refList;
    }

    public function headings() : array
    {
        return [
            'FIRSTNAME',
            'LASTNAME',
            'EMAIL',
            'GENDER',
            'DATE OF BIRTH',
            'PHONE',
            'STATE',
            'COUNTRY',
            'REF CODE',
            'ACCOUNT NAME',
            'BANK NAME',
            'ACCOUNT NUMBER',
            'REFERRED BY',
            'CREATED AT',
        ];
    }
}
