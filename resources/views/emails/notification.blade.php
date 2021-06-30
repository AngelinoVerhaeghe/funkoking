@component('mail::message')
# We got your message!

<p class="lead">We contact u as soon as possible with the best solution.</p>
<p class="lead">This was your notification:</p>

<hr>

<p><strong>Ordernumber:</strong> {{ $data['ordernumber'] }}</p>
<p><strong>Subject:</strong>  {{ $data['subject'] }}</p>
<p><strong>Description:</strong>  {{ $data['description'] }}</p>

<hr>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
