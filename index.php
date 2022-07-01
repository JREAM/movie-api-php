<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bit9.ai - Test</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/global.css">
</head>
<body class="bg-light">

<?php require('./partials/navigation.php');?>

<main role="main" class="container">

  <h1>Movie Search</h1>
  <p class="lead">
    When searching is required, we've got you covered.
  </p>

  <!-- FORM:Search-->
  <form method="post" id="searchForm">
    <div class="my-3 p-3 bg-tint rounded box-shadow">
      <div class="form-group row">
        <div class="col-sm-9">
          <input type="text" name="query" id="query" class="form-control form-control-lg box-shadow" autofocus maxlength="50" placeholder="Type a term to search for in a movie!" />
        </div>
        <div class="col d-grid gap-2">
          <button type="submit" id="submitSearch" class="btn btn-lg btn-primary box-shadow" disabled="disabled">Search</button>
        </div>
      </div>
    </div>
  </form>
  <!-- /FORM:Search-->

  <div class="mx-auto loader-center">
    <span id="queryLoader" class="loader"></span>
  </div>

  <!-- SEARCH:Results-->
  <div class="my-3 p-3 box-shadow bg-tint rounded">
    <div id="searchResults" class="row row-cols-1 row-cols-md-3 g-4">
      <!-- Dynamic (replaced) -->
      <p class="text-muted pt-3 pb-3 mb-0 small">
        Search for a movie above.
      </p>
      <!-- /Dynamic (replaced) -->
    </div>
    <p id="searchRecordTotal" class="text-muted small text-center pt-4"></p>
  </div>
  <!-- /SEARCH:Results-->

</main>


<?php require('./partials/modal.php');?>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="./scripts/global.js"></script>
</body>
</html>

