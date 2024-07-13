<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Document</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        iframe {
            min-height: 600px;
        }
    </style>
</head>
<body>
    @php
        $linkType = \App\Helpers\FileHelper::getEmbededLinkType($link);
    @endphp
    @if ($linkType == 'google')
    <iframe src='https://docs.google.com/gview?url={{ $link }}&embedded=true' width='800px' frameborder='0'></iframe>
    @else
    <iframe src='https://view.officeapps.live.com/op/embed.aspx?src={{ $link }}' width='800px' frameborder='0'></iframe>
    @endif
</body>
</html>