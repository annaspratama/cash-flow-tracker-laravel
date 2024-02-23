@props(['url'])
{{-- <tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr> --}}
<tr>
<td align="center">
<img src="{{ asset('images/cash-flow-tracker-logo.png') }}" height="100px" width="100px" alt="Cash Flow Tracker Logo">
</td>
</tr>