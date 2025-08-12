<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>ZeroPHP API文档</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.2/swagger-ui.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.2/swagger-ui-bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.52.2/swagger-ui-standalone-preset.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #fafafa;
        }
        .swagger-ui .topbar {
            background-color: #3b82f6;
            border-bottom: 1px solid #3b82f6;
        }
        .swagger-ui .info .title {
            color: #3b82f6;
        }
    </style>
</head>
<body>
    <div id="swagger-ui"></div>

    <script>
        // 初始化Swagger UI
        const ui = SwaggerUIBundle({
            spec: <?php echo $swaggerJson; ?>,
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        });
    </script>
</body>
</html>