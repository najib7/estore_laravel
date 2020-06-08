<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'title' => 'Estore',
    // 'copyright' => 'الحقوق غير محفوظة',


    'common' => [
        'control'               => 'Control',
        'name'                  => 'name',
        'image'                 => 'image',
        'search'                => 'search',
        'cancel'                => 'cancel',
        'save'                  => 'save',
        'add'                   => 'add',
        'price'                 => 'price',
        'quantity'              => 'quantity',
        'users'                 => 'users',
        'users_and_privileges'  => 'users and privileges',
        'privileges'            => 'privileges',
        'username'              => 'username',
        'email'                 => 'email',
        'password'              => 'password',
        'address'               => 'address',
        'first_name'            => 'first name',
        'last_name'             => 'last name',
        'gender'                => 'gender',
        'dob'                   => 'date of birthday',
        'phone'                 => 'phone',
        'male'                  => 'male',
        'female'                => 'female',
        'choose'                => 'choose',
        'choose_image'          => 'choose image',
        'close'                 => 'close',
        'full_name'             => 'full name',
        'last_login'            => 'last login',
        'groups'                => 'groups',
        'group'                 => 'group',
        'are_you_sure'          => 'are you sure',
        'confirm'               => 'confirm',
        'failed'                => 'failed',
        'clients'               => 'clients',
        'suppliers'             => 'suppliers',
        'supplier'              => 'supplier',
        'clients_and_suppliers' => 'clinets and suppliers',
        'store'                 => 'store',
        'purchases'             => 'purchases',
        'sales'                 => 'sales',
        'purchase_price'        => 'purchase price',
        'sale_price'            => 'sale price',
        'user'                  => 'user',
        'payment_status'        => 'payment status',
        'payment_type'          => 'payment type',
        'note'                  => 'note',
        // 'sum'                   => 'total',
        'no_records'            => 'no records',
        'create'                => 'create',
        'exit'                  => 'exit',
        'ok'                    => 'ok',
        'fails'                 => 'fails',
        'never'                 => 'never',
        'loading'               => 'loading',
        'delete'                => 'delete',
        'client'                => 'client',
        'discount'              => 'discount',
        'products'              => 'products',
        'show_invoice_details'  => 'shp invoice details',
        'number_of_products'    => 'number of products',
        'sum'                   => 'total',
        'records'               => 'records',
        'available'             => 'available',
        'out_stock'             => 'out of stock',
        'stock'                 => 'stock',
        'products_number'       => 'number of products',
        'profits'               => 'profits',
        'no_data'               => 'No data',
        'groups_and_privileges' => 'groups and privileges',
        'expenses' => 'expenses',


    ],

    'msg' => [
        'post_failed'   => 'خطأ في حفظ البيانات المرجو المحاولة لاحقا',
        'post_failed'   => 'Error saving data, please try again later',
        'update_failed' => 'Error updating data, please try again later',
        'fetch_failed'  => 'Error fetching data, please try again later',
        'deleted'       => 'Deleted successfully',
    ],

    'pagination' => [
        'first' => 'first',
        'prev'  => 'previous',
        'next'  => 'next',
        'last'  => 'last',
    ],


    'sidebar' => [
        'stats'               => 'statistics',
        'users'               => 'user',
        'store'               => 'store',
        'products'            => 'products',
        'list_products'       => 'products list',
        'products_categories' => 'products categories'
    ],


    'users' => [
        'title'          => 'users',
        'create'         => 'create new user',
        'edit'           => 'edit user ":user"',
        'user_details'   => 'details user ":user"',
        'created_at'     => 'join date',
        'updated_at'     => 'last data update',
        'last_login'     => 'last login',
        'confirm_delete' => 'The user ":user" will be deleted',
        'created'        => 'New user created successfully',
        'updated'        => 'User ":user" data has been modified',
        'deleted'        => 'The user ":user" has been deleted',
    ],


    'products' => [
        'id'                    => 'id of product',
        'create'                => 'create new product',
        'title'                 => 'products',
        'name'                  => 'product name',
        'category'              => 'product category',
        'quantity'              => 'quantity',
        'image'                 => 'product image',
        'price'                 => 'price',
        'select_category_group' => 'choose product category',
        'created'               => 'product ":product" created successfully',
        'updated'               => 'product ":product" updated successfully',
        'deleted'               => 'product ":product" deleted successfully',
        'confirm_delete'        => 'the product ":product" will be deleted',
        'choose'                => 'choose product',
        'store_quantity'        => 'store quantity',
        'price_discount'        => 'discount',
        'no_match_product'      => 'no product !!!',
        'stockout'              => 'stock out',
        'sales_count'           => 'sales count'
    ],


    'products_categories' => [
        'title'       => 'products cateogries',
        'description' => 'description',
        'create'      => 'create new product category',
        'edit'        => 'edit category ":category"',
        'created'     => 'product cateogry ":category" created successfully',
        'updated'     => 'product cateogry ":category" updated successfully',
        'deleted'     => 'product cateogry ":category" deleted successfully',
    ],


    'groups' => [
        'title'          => 'users groups',
        'name'           => 'group name',
        'description'    => 'group description',
        'create'         => 'create new users group',
        'edit'           => 'edit user group',
        'created'        => 'user group ":group" created successfully',
        'updated'        => 'user group ":group" updated successfully',
        'deleted'        => 'user group ":group" deleted successfully',
        'confirm_delete' => 'user group ":group" will be deleted',
        'select_group'   => 'choose group '
    ],


    'clients' => [
        'title'          => 'clients',
        'create'         => 'create new client',
        'edit'           => 'edit client',
        'created'        => 'client created successfully',
        'updated'        => 'client ":client" updated successfully',
        'deleted'        => 'client ":client" deleted successfully',
        'confirm_delete' => 'client ":client" will be deleted',
        'select'         => 'choose client',

    ],


    'suppliers' => [
        'title'          => 'suppliers',
        'create'         => 'create new supplier',
        'edit'           => 'edit supplier :supplier',
        'created'        => 'supplier created successfully',
        'updated'        => 'supplier ":supplier" updated successfully',
        'deleted'        => 'supplier ":supplier" deleted successfully',
        'confirm_delete' => 'supplier ":supplier" will be deleted',
        'select'         => 'choose supplier'

    ],


    'purchases' => [
        'title'           => 'purchases invoices',
        'create'          => 'new purchase',
        'add_invoice'     => 'add new invoice',
        'invoice_id'      => 'invoice id',
        'new_product'     => 'new product',
        'invoice_deleted' => 'invoice :id deleted successfully',
    ],


    'sales' => [
        'title'       => 'sales invoices',
        'create'      => 'new sale',
        'select'      => 'select',
        'add_invoice' => 'add new sale invoice',
        'add_detail'  => 'new sale',
    ],


    'payment_status' => [
        'not_paid' => 'not paid',
        'paid'     => 'paid',
        'expired'  => 'expired'
    ],


    'payment_type' => [
        'cash'          => 'cash',
        'check'         => 'check',
        'credit_card'   => 'credit card',
        'bank_transfer' => 'bank transfer'
    ],


    'stats' => [
        'products'     => 'products statistics',
        'purchases'    => 'purchases statistics',
        'sales'        => 'sales statistics',
        'last_count'   => 'statistics Last 7 days',
        'last_profits' => 'profits Last 7 days',

        'number_of_purchases' => 'number of purchases',
        'total_purchases'     => 'total purchases',

        'number_of_sales' => 'number of sales',
        'total_sales'     => 'total sales',
    ],



    'privileges' => [
        'show'                                 => 'show',
        'create'                               => 'create',
        'update'                               => 'update',
        'delete'                               => 'delete',
        'App\Models\Client'                    => 'clients',
        'App\Models\Group'                     => 'users groups',
        'App\Models\Product'                   => 'products',
        'App\Models\ProductCategory'           => 'products categories',
        'App\Models\Profile'                   => 'users profiles',
        'App\Models\Purchases\PurchaseDetails' => 'purchases details',
        'App\Models\Purchases\PurchaseInvoice' => 'purchases invoices',
        'App\Models\Sales\SaleDetails'         => 'sales details',
        'App\Models\Sales\SaleInvoice'         => 'sales invoices',
        'App\Models\Supplier'                  => 'suppliers',
        'App\Models\User'                      => 'users',
        'App\Models\UserPrivilege'             => 'users privlieges',
        'App\Models\test'                      => 'just for test',
        'created'                              => 'created successfully',
    ]

];
