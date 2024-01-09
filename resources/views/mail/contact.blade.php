@component('mail::message')
    # Dear Customer Service,

    You have new enquiry from mobile app

    # Student Details:

    Registration No. : {{$reg_id}}
    Student Name: {{$name}}
    Student Mobile Number: {{$mobile}}
    message: {{$message}}

    Please do needful.

    Best Regards,
@endcomponent
