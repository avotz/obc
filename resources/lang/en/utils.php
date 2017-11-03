<?php 

return [
    
        'activity'  => [
            '1' => 'Consumer',
            '2' => 'Supplier'
           
        ],
        'role'  => [
            '1' => 'default',
            '2' => 'warning',
            '3' => 'info',
            '4' => 'success'
           
        ],
        /*'way_to_pay'  => [
            '0' => 'Cash',
            '30' => 'Credit 30 days',
            '45' => 'Credit 45 days',
            '60' => 'Credit 60 days',
            '90' => 'Credit 90 days'
         
        ],*/
        'way_of_delivery'  => [
            '0' => '',
            '1' => 'Pickup',
            '2' => 'At Home',
            '3' => 'Shipping Charge',
        ],
        
        /*'delivery_time'  => [
            '0' => 'Immediate',
            '1' => '1 day',
            '2' => '2 days',
            '3' => '3 days',
         
        ],*/
        'geo_type'  => [
            '1' => 'National',
            '2' => 'Regional',
            '3' => 'International',
            '4' => 'Global'
           
        ],
        'public'  => [
            '0' => 'Private',
            '1' => 'Public',
            'colors' =>[
                '0' => 'danger',
                '1' => 'info'
            ]
           
        ],
        'purchase_status_color'  => [
            '0' => 'warning',
            '1' => 'success',
            '2' => 'danger',
            
           
        ],
        'purchase_status'  => [
            '0' => 'Pending',
            '1' => 'Granted',
            '2' => 'Rejected',
            
           
        ],
        'day' => 'Day',
        'days' => 'Days',
        'credit' => 'Credit',
        'immediate' => 'Immediate',
        'cash' => 'Cash',
    
    ];