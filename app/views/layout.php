<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? $title ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<a class="navbar-brand" href="index.php">OrderMoscow</a>
				<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="index.php?page=FormOrder&action=create">Оформить доставку</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Инструкция</a>
						</li>
					</ul>
					<div class="d-flex">
						<a class="nav-link me-4" href="index.php?page=AllOrders">Все заказы</a>
					</div>
					<div class="d-flex">
						<a class="nav-link" href="#">Авторизация</a>
					</div>
				</div>
			</div>
		</nav>
		
		<div class="container mt-4">
			<?php echo $content; ?>
		</div>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>