<h1>{{ $subject }}</h1>
<br>
<p>Xin Chào {{ $name }},</p>
<br>
<p>{!! nl2br($body) !!}</p>
<br>
<p>Đây là email tự động, vui lòng không phản hồi lại email này</p>
<p>Trân trọng,</p>
<p>{{ config('app.name') }}</p>
