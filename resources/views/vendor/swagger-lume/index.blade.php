<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('swagger-lume.api.title') }}</title>

    <!-- ✅ CDN oficial do Swagger UI -->
    <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4/swagger-ui.css" />
</head>
<body>
<div id="swagger-ui"></div>

<script src="https://unpkg.com/swagger-ui-dist@4/swagger-ui-bundle.js"></script>
<script src="https://unpkg.com/swagger-ui-dist@4/swagger-ui-standalone-preset.js"></script>
<script>
    window.onload = () => {
        SwaggerUIBundle({
            url: "{{ $urlToDocs }}",
            dom_id: '#swagger-ui',
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        });
    };
</script>
</body>
</html