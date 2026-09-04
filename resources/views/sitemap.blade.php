<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($routes as $route)
    <url>
        <loc>{{ route($route['name']) }}</loc>
        <changefreq>{{ $route['changefreq'] }}</changefreq>
        <priority>{{ $route['priority'] }}</priority>
    </url>
@endforeach
</urlset>
