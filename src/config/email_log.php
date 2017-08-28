<?php
    // Example: 'add_user' => 1
    return [
        'email_log_key' => 'email log',

        /*
   |--------------------------------------------------------------------------
   |Table Name
   |--------------------------------------------------------------------------
   |
   | Table name of the route log
   |
   |
   |
   */

        'table_name' => 'trn_email_log',


        /*
  |--------------------------------------------------------------------------
  |Available Columns
  |--------------------------------------------------------------------------
  |
  | Identify the required columns and set them as true, else false
  |
  |
  |
  */
        'columns'    => [
            'sent_email_address' => true,
            'subject'            => true,
            'body'               => true,
            'attachments'        => true,
        ]

    ];
