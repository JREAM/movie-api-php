$(function() {

  // Prevent Submitting an Empty Form
  $("#searchForm input").keyup(function(e) {
    $("#submitSearch").attr("disabled", false);
    if ($(this).val().length === 0) {
      $("#submitSearch").attr("disabled", true);
    }
  });

  // Hide the Active Search Properties until needed
  $("#queryLoader").hide();
  $("#searchRecordTotal").hide();

  // start:onSubmit
  $("#searchForm").submit(function(e) {
    e.preventDefault();

    // Show the loader
    $("#queryLoader").fadeIn()

    // Get the Query
    var query = $("#searchForm #query").val();

    // start:Post Search Query
    $.post("api/search.php", $("#searchForm").serialize(), function(data) {
      let searchData = $.parseJSON(data);

      if (searchData.total_results === 0) {
        $("#queryMessage").html('No results found for: ' + query);
        $("#queryMessage").addClass('alert-warning').removeClass('alert-danger');
        $("#queryLoader").fadeOut();
        return;
      }

      // Clear the Results so they don't stack
      $("#searchResults").html('');

      const totalDisplayed = searchData.results.length;
      const totalResults = searchData.total_results;

      // Display Count
      $("#searchRecordTotal").html(`Displaying ${totalDisplayed} out of ${totalResults} possible movies.`);
      $("#searchRecordTotal").show();

      // start:Each Iterate
      $.each(searchData.results, function(key, obj) {

        let overview = obj.overview.length > 0
          ? obj.overview.substring(0, 75) + '...'
          : '<i>No Description</i>';

        let date = obj.release_date
          ? obj.release_date.substring(0, 4)
          : "<i>Unknown</i>";

        let image = obj.poster_path
          ? `https://image.tmdb.org/t/p/w200/${obj.poster_path}`
          : 'https://via.placeholder.com/300x450';

        $("#searchResults").append(`
          <div class="col">
            <div class="card box-shadow h-100" data-id="${obj.id}">
              <a class="movieDetails pointer align-self-center img-thumbnail" data-id="${obj.id}">
                <img class="mr-3" height="200" src="${image}" alt="${obj.title}" />
              </a>

              <div class="card-body d-flex flex-column">
                <h5 class="card-title">${obj.title}</h5>
                <p class="card-text">
                  <small class="text-muted">Released in ${date}</small>
                </p>
                <p class="card-text">${overview}</p>
                <button class="movieDetails btn btn-light mt-auto" data-id="${obj.id}">More Details</button>
              </div>
            </div>
          </div>
        `);

        $("#queryLoader").fadeOut();
      });
      // end:Each Iterate

      // start:Movie Modal
      $(".movieDetails").on('click', function(e) {
        e.preventDefault();

        // API Call for Movie ID
        var id = parseInt($(this).data('id'));

        // start: API Get
        $.get(`api/movie.php?id=${id}`, function(data) {
          let movieData = $.parseJSON(data);
          // console.log(movieData);

          let overview = movieData.overview.length > 0
            ? movieData.overview
            : '<i>No Description</i>';

          let image = movieData.poster_path
            ? `https://image.tmdb.org/t/p/w200/${movieData.poster_path}`
            : 'https://via.placeholder.com/300x450';

          let date = movieData.release_date
            ? movieData.release_date.substring(0, 4)
            : "<i>Unknown</i>";

          let genres = '';
          $.each(movieData.genres, function(key, obj) {
            genres += `${obj.name}, `;
          });
          genres = genres.length
            ? genres.substring(0, genres.length - 2)
            : "<i>Unknown</i>";

          // Populate Modal (partials/modal.js included in index.php)
          $("#movieModal .modal-title").html(movieData.title)
          $("#movieModal .modal-body").html(`
            <div class="row">
              <div class="col-md-4">
                <img class="img-fluid img-thumbnail" src="${image}" alt="${data.title}" />
              </div>
              <div class="col ms-auto">
                <table class="table">
                  <tr>
                    <td class="fw-bold">Release Date</td>
                    <td>${date}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Runtime</td>
                    <td>${movieData.runtime} minutes</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Original Language</td>
                    <td>${movieData.original_language}</td>
                  </tr>
                  <tr>
                    <td class="fw-bold">Genre(s)</td>
                    <td>${genres}</td>
                  </tr>
                </table>
                <p>
                  ${overview}
                </p>
              </div>
            </div>
          `);

          // Modal Populated, now open it up!
          $('#movieModal').modal('show');

        }); // end:API Get

      }); // end:Movie Modal

    }); // end:Post Search Query

  }); // end:onSubmit

});
