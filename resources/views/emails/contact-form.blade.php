<x-mail::message>
# New Contact Form Submission

You have received a new message from the contact form.

**Name:** {{ $name }}  
**Email:** {{ $email }}  
**Topic:** {{ $topic }}  

**Message:**  
{{ $messageContent }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
