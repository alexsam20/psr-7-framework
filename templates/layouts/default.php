<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $this->params['title'] ?? ''; ?> - App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php echo $this->renderBlock('meta'); ?>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <style>
        .app { display: flex; min-height: 100vh; flex-direction: column; }
        .app-content { padding: 20px; flex: 1; }
        .app-footer {padding-bottom: 1em }
    </style>
</head>
<body class="app">

<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
        <div class="container">
            <a class="navbar-brand" href="/">Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="form-inline">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav">
                        <!--<li><a class="nav-link" href="/blog"><i class="bi bi-circle-square"></i> Blog</a></li>-->
                        <li><a class="nav-link" href="/about"><i class="bi bi-bookmarks-fill"></i> About</a></li>
                        <li><a class="nav-link" href="/cabinet"><i class="bi bi-person-fill"></i> Cabinet</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="app-content">
    <main class="container">
        <? echo $this->renderBlock('breadcrumbs'); ?>
        <? echo $content; ?>

    </main>
</div>

<footer class="app-footer">
    <div class="container">
        <div class="border-top pt-3">
            <p>&copy; 2021 - <?php echo date('Y'); ?> - My App</p>
        </div>
    </div>
</footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</html>