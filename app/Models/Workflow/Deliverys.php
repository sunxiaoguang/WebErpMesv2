<?php

namespace App\Models\Workflow;

use App\Models\User;
use App\Models\Workflow\Orders;
use App\Models\Companies\Companies;
use App\Models\Workflow\OrderLines;
use App\Models\Workflow\DeliveryLines;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies\companiesContacts;
use App\Models\Companies\companiesAddresses;
use App\Models\Accounting\AccountingPaymentMethod;
use App\Models\Accounting\AccountingPaymentConditions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliverys extends Model
{
    use HasFactory;

    protected $fillable = ['CODE', 
                            'LABEL', 
                            'companies_id', 
                            'companies_contacts_id',   
                            'companies_addresses_id',  
                            'statu',  
                            'user_id',
                            'comment',
                            'order_id',
                        ];

    public function companie()
    {
        return $this->belongsTo(Companies::class, 'companies_id');
    }

    public function contact()
    {
        return $this->belongsTo(companiesContacts::class, 'companies_contacts_id');
    }

    public function adresse()
    {
        return $this->belongsTo(companiesAddresses::class, 'companies_addresses_id');
    }

    public function UserManagement()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Orders()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function DeliveryLines()
    {
        return $this->hasMany(DeliveryLines::class)->orderBy('ORDRE');
    }

    public function GetPrettyCreatedAttribute()
    {
        return date('d F Y', strtotime($this->created_at));
    }
}