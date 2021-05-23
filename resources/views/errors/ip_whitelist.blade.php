<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IP address not whitelisted</title>
</head>
    
<body style="margin: 0;">

    <div>
        Your IP <strong>(<?php echo $remoteIp ?>)</strong> isn't whitelisted to access this environment.
    </div>

</body>

</html>