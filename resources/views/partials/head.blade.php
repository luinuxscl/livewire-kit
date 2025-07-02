<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ App\Models\Option::getValue('site_title') }}</title>
<meta name="description" content="{{ App\Models\Option::getValue('site_description') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')
@fluxAppearance
