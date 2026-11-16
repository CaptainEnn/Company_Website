<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(isset($title) ? $title : config('app.name')) ?></title>
  <meta name="description" content="<?= e(isset($metaDesc) ? $metaDesc : '') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
  <?php /* TODO: require partials/header.php */ ?>
  <main><?php require $viewFile; ?></main>
  <?php /* TODO: require partials/footer.php */ ?>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
