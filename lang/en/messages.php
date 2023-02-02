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
    'no_data' => 'No data found',
    'book_not_found' => 'Book not found',

    //roles
    'role'                    => [
        'roles'     => 'Roles',
        'role'     => 'Role',
        'new_role'  => 'New Role',
        'edit_role' => 'Edit Role',
        'show_role' => 'Show Role',
        'select_role' => 'Select Role',
    ],

    //user keys
    'user'                    => [
        'account_id'            => 'Account ID',
        'users'                 => 'Users',
        'user'                  => 'User',
        'name'                  => 'Name',
        'email'                 => 'Email',
        'username'              => 'Username',
        'phone'                 => 'Phone',
        'designation'           => 'Designation',
        'gender'                => 'Gender',
        'select_gender'         => 'Select Gender',
        'country'               => 'Country',
        'select_country'        => 'Select Country',
        'male'                  => 'Male',
        'female'                => 'Female',
        'qualification'         => 'Qualification',
        'dob'                   => 'Date Of Birth',
        'blood_group'           => 'Blood Group',
        'select_blood_group'    => 'Select Blood Group',
        'password'              => 'Password',
        'password_confirmation' => 'Confirm Password',
        'address'               => 'Address',
        'city'                  => 'City',
        'zip'                   => 'Zip',
        'address_details'       => 'Address Details',
        'address_not_found'     => 'No Address details found',
        'education'             => 'Education',
        'edit_profile'          => 'Edit Profile',
        'change_password'       => 'Change Password',
        'logout'                => 'Logout',
        'new_user'              => 'New User',
        'edit_user'             => 'Edit User',
        'user_details'          => 'User Details',
        'want_activities'       => 'Interested In Activities',
        'dont_want_activities'  => 'Not Interested In Activities',
        'new_user_pass_tooltip' => 'Leave it blank and a random password will be generated for the user',
        'edit_user_pass_tooltip'=> 'Leave it blank if you don\'t want to change the password',
        'personal_info'         => 'Personal Information',
    ],

    //common keys
    'common'                  => [
        'status'            => 'Status',
        'action'            => 'Action',
        'save'              => 'Save',
        'please_wait'       => 'Please Wait',
        'cancel'            => 'Cancel',
        'back'              => 'Back',
        'created_on'        => 'Created On',
        'last_updated'      => 'Last Updated',
        'n/a'               => 'N/A',
        'new'               => 'New',
        'total'             => 'Total',
        'add'               => 'Add',
        'active'            => 'Active',
        'name'              => 'Name',
        'edit'              => 'Edit',
        'delete'            => 'Delete',
        'view'              => 'View',
        'view_attachment'   => 'View Attachment',
        'de_active'         => 'Deactivate',
        'description'       => 'Description',
        'created_at'        => 'Created On',
        'updated_at'        => 'Last Updated',
        'is_available'      => 'Is Available',
        'choose'            => 'Choose',
        'yes'               => 'Yes',
        'no'                => 'No',
        'address'           => 'Address',
        'export_to_excel'   => 'Export to Excel',
        'reset'             => 'Reset',
        'actions'           => 'Actions',
        'filter_options'    => 'Filter Options',
        'filter'            => 'Filter',
        'user_details'      => 'User',
        'details'           => 'Details',
        'no_data_available' => 'No data available in table',
        'confirm'           => 'Confirm',
        'all'               => 'All',
        'inactive'          => 'Inactive',
        'available'         => 'Available',
        'not_available'     => 'Not Available',
        'search'            => 'Search',
        'dynamic_field'     => 'This is a dynamic field, which means you can add new records by typing the name and they will be saved in the database.',
        'total_books'       => 'Total Books',
        'image'             => 'Image',
        'featured'          => 'Featured',
        'select_date_range' => 'Select Date Range',
    ],

    //Settings keys
    'setting'                 => [
        'app_name'           => 'App Name',
        'company_name'       => 'Company Name',
        'app_logo'           => 'App Logo',
        'currency'           => 'Current Currency',
        'library_address'    => 'Library Address',
        'library_email'      => 'Hospital Email',
        'library_phone'      => 'Hospital Phone',
        'library_from_day'   => 'Hospital From Day',
        'library_from_time'  => 'Hospital From Time',
        'about_us'           => 'About Us',
        'image_validation'   => 'The image must be of pixel 90 x 60.',
        'favicon'            => 'Favicon',
        'favicon_validation' => 'The image must be of pixel 34 x 34.',
        'social_details'     => 'Social Details',
    ],

    //Profile keys
    'profile'                 => [
        'profile'         => 'Profile',
        'change_language' => 'Change Language',
        'language'        => 'Language',
        'edit_profile'    => 'Edit Profile',
        'first_name'      => 'First Name',
        'last_name'       => 'Last Name',
        'email'           => 'Email',
        'phone'           => 'Phone',
    ],

    //Dashboard keys
    'dashboard'               => [
        'dashboard'                  => 'Dashboard',
        'total_invoices'             => 'Invoice Amount',
        'total_bills'                => 'Bill Amount',
        'total_payments'             => 'Payment Amount',
        'total_advance_payments'     => 'Advance Payment Amount',
        'notice_boards'              => 'Notice Boards',
        'title'                      => 'Title',
        'doctors'                    => 'Doctors',
        'available_beds'             => 'Available Beds',
        'patients'                   => 'Patients',
        'income_and_expense_report'  => 'Income and Expense Report',
        'income_and_expense_reports' => 'Income and Expense Reports',
        'no_enquiries_yet'           => 'No Enquiries Yet',
        'no_notice_yet'              => 'No Notice Yet',
        'today_circulations'         => 'Today\'s Book Circulations',
        'circulation_statistics'     => 'Circulation Statistics By Status',
        'users_activities_by_country'=> 'Users Activities By Country',
        'books_statistics_by_class'  => 'Books Statistics By Class',
    ],

    //Email keys
    'email'                   => [
        'to'         => 'To',
        'subject'    => 'Subject',
        'message'    => 'Message',
        'attachment' => 'Attachment',
    ],

    //Messages keys
    'message'                 => [
        'message'          => 'Message',
        'messages'         => 'Messages',
        'send_to'          => 'Send To',
        'subject'          => 'Subject',
        'new_message'      => 'New Message',
        'messages_details' => 'Message Details',
        'sender_name'      => 'Sender Name',
        'date'             => 'Date',
        'select_user'      => 'Select User',
    ],

    //Notifications keys
    'notification'            => [
        'notifications'                       => 'Notifications',
        'mark_all_as_read'                    => 'Mark All As Read',
        'you_don`t_have_any_new_notification' => 'You don`t have any new notification',
    ],

    //Front Settings keys
    'front_setting'           => [
        'front_setting_details'                  => 'Front Setting Details',
        'about_us_details'                       => 'About Us Details',
        'appointment_details'                    => 'Appointment Details',
        'terms_condition_details'                => 'T&C Details',
        'about_us_title'                         => 'Title',
        'about_us_mission'                       => 'Mission',
        'about_us_image'                         => 'Image',
        'about_us_description'                   => 'Description',
        'home_page_image'                        => 'Home Page Image',
        'home_page_title'                        => 'Home Page Title',
        'home_page_description'                  => 'Home Page Description',
        'home_page_box_title'                    => 'Home Page Box Title',
        'home_page_box_description'              => 'Home Page Box Description',
        'home_page_experience'                   => 'Home Page Experience',
        'home_page_step_1_title'                 => 'Home Page Step 1 Title',
        'home_page_step_1_description'           => 'Home Page Step 1 Description',
        'home_page_step_2_title'                 => 'Home Page Step 2 Title',
        'home_page_step_2_description'           => 'Home Page Step 2 Description',
        'home_page_step_3_title'                 => 'Home Page Step 3 Title',
        'home_page_step_3_description'           => 'Home Page Step 3 Description',
        'home_page_step_4_title'                 => 'Home Page Step 4 Title',
        'home_page_step_4_description'           => 'Home Page Step 4 Description',
        'terms_conditions'                       => 'Terms & Conditions',
        'privacy_policy'                         => 'Privacy Policy',
        'home_page_certified_doctor_image'       => 'Home Page Certified Doctor Image',
        'home_page_certified_doctor_text'        => 'Home Page Certified Doctor Text',
        'home_page_certified_doctor_title'       => 'Home Page Certified Doctor Title',
        'home_page_certified_doctor_description' => 'Home Page Certified Doctor Description',
        'home_page_certified_box_title'          => 'Home Page Certified Box Title',
        'home_page_certified_box_description'    => 'Home Page Certified Box Description',
    ],

    //Change Password keys
    'change_password'         => [
        'change_password'  => 'Change Password',
        'current_password' => 'Current Password',
        'new_password'     => 'New Password',
        'confirm_password' => 'Confirm Password',
        'password_tips'    => 'Use 8 or more characters with a mix of letters, numbers & symbols.'
    ],

    //Front Service keys
    'front_services'          => [
        'new_service'  => 'New Service',
        'edit_service' => 'Edit Service',
    ],

    //Web Home keys
    'web_home'                => [
        'home'                                               => 'Home',
        'services'                                           => 'Services',
        'doctors'                                            => 'Doctors',
        'about_us'                                           => 'About Us',
        'contact'                                            => 'Contact',
        'make_appointment'                                   => 'Make Appointment',
        'working_hours'                                      => 'Working Hours',
        'testimonials'                                       => 'Testimonials',
        'terms_of_service'                                   => 'Terms of Service',
        'privacy_policy'                                     => 'Privacy Policy',
        'patients'                                           => 'Patients',
        'years_experience'                                   => 'Years Experience',
        'sign_up'                                            => 'Sign Up',
        'available_doctors'                                  => 'Available Doctors',
        'select_doctors'                                     => 'Select Doctors',
        'contact_doctors'                                    => 'Contact Doctor',
        'easy_solutions'                                     => 'Easy Solutions',
        '4_easy_step_and_get_the_world_best_treatment'       => '4 Easy Step and Get the World Best Treatment',
        'book_an_appointment'                                => 'Book an Appointment',
        'select_doctor'                                      => 'Select Doctor',
        'book_now'                                           => 'Book Now',
        'patients_beds'                                      => 'Patients Beds',
        'doctors_nurses'                                     => 'Doctors & Nurses',
        'happy_patients'                                     => 'Happy Patients',
        'book_appointment'                                   => 'Book Appointment',
        'our_services'                                       => 'Our Services',
        'we_offer_different_services_to_improve_your_health' => 'We Offer Different Services To Improve Your Health',
        'professional_doctors'                               => 'Professional Doctors',
        'we_are_experienced_healthcare_professionals'        => 'We are Experienced Healthcare Professionals',
        'our_testimonials'                                   => 'Our Testimonials',
        'what_our_patient_say_about_medical_treatments'      => 'What Our Patients Say About Our Medical Treatments',
    ],

    //Web Contact keys
    'web_contact'             => [
        'call_today'                     => 'Call Today',
        'open_hours'                     => 'Open Hours',
        'our_location'                   => 'Our Location',
        'send_us_a_message'              => 'Send Us a Message',
        'your_name'                      => 'Your Name',
        'your_email'                     => 'Your Email',
        'phone_number'                   => 'Phone Number',
        'select_enquiry'                 => 'Select Enquiry',
        'your_message'                   => 'Your Message',
        'send_message'                   => 'Send Message',
        'enter_your_name'                => 'Enter your name',
        'enter_your_email'               => 'Enter your email',
        'contact_no'                     => 'Contact No',
        'please_enter_your_phone_number' => 'Please enter your phone number',
        'write_your_message'             => 'Write your message',
        'type_your_message'              => 'Type your message',
    ],

    //Web Menu keys
    'web_menu'                => [
        'about'                  => 'About',
        'our_features'           => 'Our Features',
        'appointment'            => 'Appointment',
        'working_hours'          => 'Working Hours',
        'login'                  => 'Login',
        'useful_link'            => 'Useful Link',
        'contact_information'    => 'Contact Information',
        'copyright'              => 'Copyright',
        'all_rights_reserved_by' => 'All Rights Reserved by',
    ],

    //Working Hours keys
    'web_working_hours'       => [
        'opening_hours'        => 'Opening Hours',
        'no_yet_opening_hours' => 'No yet Opening Hours',
    ],

    //Books keys
    'books'                   => [
        'books' => 'Books',
        'book' => 'Book',
        'book_information' => 'Book Information',
        'return_book' => 'Return Book',
        'new_book' => 'New Book',
        'edit_book' => 'Edit Book',
        'import_book' => 'Import Book',
        'isbn' => 'ISBN',
        'library_number' => 'Library Number',
        'author' => 'Author(s)',
        'junior' => 'Junior',
        'source' => 'Source',
        'publish_date' => 'Publish Date',
        'short_description' => 'Short Description',
        'long_description' => 'Long Description',
        'book_image' => 'Book Image',
        'book_cover_image' => 'Cover Image',
        'book_status' => 'Book Status',
        'title' => 'Title',
        'details' => 'Details',
        'cover' => 'Cover',
        'select_publisher'  => 'Select Publisher',
        'select_genre'  => 'Select Genre',
        'select_language'  => 'Select Language',
        'select_author'  => 'Select Author(s)',
        'select_class'  => 'Select Class',
        'select_topic'  => 'Select Topic',
        'search_book'   => 'Search by Book title, isbn or library number',
        'statuses' => [
            'available' => 'Available',
            'borrowed' => 'Borrowed',
            'lost' => 'Lost',
            'damaged' => 'Damaged',
            'maintenance' => 'Maintenance',
        ],
    ],

    //Circulations keys
    'circulations'            => [
        'circulations' => 'Circulations',
        'circulation' => 'Circulation',
        'circulation_information' => 'Circulation Information',
        'new_circulation' => 'New Circulation',
        'edit_circulation' => 'Edit Circulation',
        'circulation_records' => 'Circulation Records',
        'borrowed_date' => 'Borrowed Date',
        'issue_date' => 'Issue Date',
        'return_date' => 'Return Date',
        'returned_date' => 'Returned Date',
        'reminder' => 'Reminder',
        'select_book' => 'Select Book',
        'select_member'  => 'Select Member',
        'note' => 'Note',
        'max_borrowed' => 'The user has already borrowed 3 books.',
        'issuer' => 'Issuer',
    ],

    //Classes keys
    'classes'                 => [
        'classes'       => 'Classes',
        'class'         => 'Class',
        'new_class'     => 'New Class',
        'edit_class'    => 'Edit Class',
        'code'          => 'Code',
    ],

    //Authors keys
    'authors'                 => [
        'authors' => 'Authors',
        'author' => 'Author',
        'new_author' => 'New Author',
        'edit_author' => 'Edit Author',
        'bio' => 'Bio',
    ],

    //Publishers keys
    'publishers'              => [
        'publishers' => 'Publishers',
        'publisher' => 'Publisher',
        'new_publisher' => 'New Publisher',
        'edit_publisher' => 'Edit Publisher',

    ],

    //Members keys
    'members'                 => [
        'members' => 'Members',
        'member' => 'Member',
        'member_information' => 'Member Information',
        'new_member' => 'New Member',
        'edit_member' => 'Edit Member',
        'member_id' => 'Member ID',
    ],

    //Topics keys
    'topics'                  => [
        'topics'    => 'Topics',
        'topic'     => 'Topic',
        'new_topic' => 'New Topic',
        'edit_topic' => 'Edit Topic',
        'color'     => 'Color',
    ],

    //Genres keys
    'genres'                  => [
        'genres'    => 'Genres',
        'genre'     => 'Genre',
        'new_genre' => 'New Genre',
        'edit_genre' => 'Edit Genre',
    ],

    //Languages keys
    'languages'               => [
        'languages'    => 'Languages',
        'language'     => 'Language',
        'new_language' => 'New Language',
        'edit_language' => 'Edit Language',
    ],

];
