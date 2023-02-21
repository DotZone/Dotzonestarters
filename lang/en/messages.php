<?php

return [

    /*
    |--------------------------------------------------------------------------
    | All Titles and static string in blade files
    |--------------------------------------------------------------------------
    |
    */
    'create_success' => 'Created successfully',
    'update_success' => 'Updated successfully',
    'delete_success' => 'Deleted successfully',
    'restore_success' => 'Restored successfully',
    'force_delete_success' => 'Deleted successfully',
    'create_error' => 'Error in creating',
    'update_error' => 'Error in updating',
    'delete_error' => 'Error in deleting',
    'restore_error' => 'Error in restoring',
    'show_success' => 'Show successfully',
    'force_delete_error' => 'Error in deleting',
    'data_retrieved_successfully' => 'Data retrieved successfully',
    'data_retrieved_error' => 'Error in retrieving data',
    'no_data_found' => 'No data found',
    'no_records_found' => 'No records found',
    'no_records_found_in_trash' => 'No records found in trash',
    'no_data_available' => 'No data available in table',
    'all_rights_reserved' => 'All rights reserved',
    'powered_by' => 'Powered by',
    'are_you_sure' => 'Are you sure?',
    'you_wont_be_able_to_revert_this' => 'You won\'t be able to revert this!',
    'yes_delete_it' => 'Yes, delete it!',
    'yes_restore_it' => 'Yes, restore it!',

    // common keys
    'common'                  => [
        'status'            => 'Status',
        'save'              => 'Save',
        'please_wait'       => 'Please wait...',
        'continue'          => 'Continue',
        'cancel'            => 'Cancel',
        'back'              => 'Back',
        'created_at'        => 'Created At',
        'updated_at'        => 'Updated At',
        'n/a'               => 'N/A',
        'total'             => 'Total',
        'new'               => 'New',
        'add'               => 'Add',
        'create'            => 'Create',
        'edit'              => 'Edit',
        'update'            => 'Update',
        'delete'            => 'Delete',
        'restore'           => 'Restore',
        'view'              => 'View',
        'show'              => 'Show',
        'view_attachment'   => 'View Attachment',
        'is_available'      => 'Is Available',
        'yes'               => 'Yes',
        'no'                => 'No',
        'export_to_excel'   => 'Export to Excel',
        'reset'             => 'Reset',
        'action'            => 'Action',
        'actions'           => 'Actions',
        'filter_options'    => 'Filter Options',
        'filter'            => 'Filter',
        'details'           => 'Details',
        'confirm'           => 'Confirm',
        'all'               => 'All',
        'active'            => 'Active',
        'inactive'          => 'Inactive',
        'available'         => 'Available',
        'not_available'     => 'Not Available',
        'search'            => 'Search',
        'dynamic_field'     => 'This is a dynamic field, which means you can add new records by typing the name and they will be saved in the database.',
        'featured'          => 'Featured',
        'not_featured'      => 'Not Featured',
        'choose'            => 'Choose',
        'select'            => 'Select',
        'select_date_range' => 'Select Date Range',
        'select_date'       => 'Select Date',
        'select_time'       => 'Select Time',
        'select_file'       => 'Select File',
        'select_image'      => 'Select Image',
        'select_video'      => 'Select Video',
        'select_audio'      => 'Select Audio',
        'select_document'   => 'Select Document',
        'name'              => 'Name',
        'title'             => 'Title',
        'description'       => 'Description',
        'image'             => 'Image',
        'date'              => 'Date',
        'attachment'        => 'Attachment',
        'attachments'       => 'Attachments',
        'download'          => 'Download',
        'download_attachment' => 'Download Attachment',
        'download_attachments' => 'Download Attachments',
        'download_selected' => 'Download Selected',
        'download_all'      => 'Download All',
        'delete_selected'   => 'Delete Selected',
        'delete_all'        => 'Delete All',
        'delete_attachment' => 'Delete Attachment',
        'delete_attachments' => 'Delete Attachments',
        'delete_confirm'    => 'Are you sure you want to delete this record?',
        'delete_confirm_selected' => 'Are you sure you want to delete selected records?',
        'delete_confirm_all' => 'Are you sure you want to delete all records?',
        'delete_confirm_attachment' => 'Are you sure you want to delete this attachment?',
    ],

    // select2 keys
    'select2'                 => [
        'no_results_found' => 'No results found',
        'no_matches_found' => 'No matches found',
        'loading_more_results' => 'Loading more results',
        'searching' => 'Searching',
    ],

    // roles
    'role'                    => [
        'roles'     => 'Roles',
        'role'     => 'Role',
        'new_role'  => 'New Role',
        'edit_role' => 'Edit Role',
        'show_role' => 'Show Role',
        'delete_role' => 'Delete Role',
        'select_role' => 'Select Role',
    ],

    // permissions
    'permission'              => [
        'permissions'   => 'Permissions',
        'permission'    => 'Permission',
        'new_permission'  => 'New Permission',
        'edit_permission' => 'Edit Permission',
        'show_permission' => 'Show Permission',
        'delete_permission' => 'Delete Permission',
        'select_permission' => 'Select Permission',
    ],

    // user keys
    'user'                    => [
        'users'     => 'Users',
        'user'      => 'User',
        'new_user'  => 'New User',
        'edit_user' => 'Edit User',
        'show_user' => 'Show User',
        'delete_user' => 'Delete User',
        'select_user' => 'Select User',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
    ],

    // Settings keys
    'setting'                 => [
        'app_name'           => 'App Name',
        'company_name'       => 'Company Name',
        'app_logo'           => 'App Logo',
        'currency'           => 'Current Currency',
        'default_address'    => 'Default Address',
        'default_email'      => 'Default Email',
        'default_phone'      => 'Default Phone',
        'default_from_day'   => 'From Day',
        'default_from_time'  => 'From Time',
        'about_us'           => 'About Us',
        'image_validation'   => 'The image must be of pixel 90 x 60.',
        'favicon'            => 'Favicon',
        'favicon_validation' => 'The image must be of pixel 34 x 34.',
        'social_details'     => 'Social Details',

    ],

    // Profile keys
    'profile'                 => [
        'profile'         => 'Profile',
        'profile_details' => 'Profile Details',
        'profile_image'   => 'Profile Image',
        'image_validation' => 'The image must be of pixel 90 x 90.',
    ],

    // Dashboard keys
    'dashboard'               => [
        'dashboard'                  => 'Dashboard',
        'total_users'                => 'Total Users',
    ],

    // Email keys
    'email'                   => [
        'to'         => 'To',
        'subject'    => 'Subject',
        'message'    => 'Message',
        'attachment' => 'Attachment',
    ],

    // Messages keys
    'message'                 => [
        'message'          => 'Message',
        'messages'         => 'Messages',
        'send_to'          => 'Send To',
        'subject'          => 'Subject',
        'new_message'      => 'New Message',
        'messages_details' => 'Message Details',
        'sender_name'      => 'Sender Name',
    ],

    // Notifications keys
    'notification'            => [
        'notifications'                       => 'Notifications',
        'mark_all_as_read'                    => 'Mark All As Read',
        'you_don`t_have_any_new_notification' => 'You don`t have any new notification',
    ],

    // Change Password keys
    'change_password'         => [
        'change_password'  => 'Change Password',
        'current_password' => 'Current Password',
        'new_password'     => 'New Password',
        'confirm_password' => 'Confirm Password',
        'password_tips'    => 'Use 8 or more characters with a mix of letters, numbers & symbols.'
    ],


];
