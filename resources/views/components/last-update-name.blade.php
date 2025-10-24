@props(['name', 'updated_at'])
<p><strong>{{ $name }}</strong> (Vào lúc {{ \Carbon\Carbon::parse($updated_at)->setTimezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y') }})</p>
