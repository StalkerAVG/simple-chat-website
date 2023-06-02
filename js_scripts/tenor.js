$(document).ready(function() {
    const gif_btn = $('.gif');
    const search = $("#search-input");
    const gif_cont = $("#gif-container");
    const search_cont = $(".gif-search");
    const close = $(".close-button");

    // Function to handle the search
    function performSearch() {
        var searchQuery = search.val();

        // Make a request to Tenor API to search for GIFs based on the user's query
        $.getJSON("https://api.tenor.com/v1/search?q=" + searchQuery + "&key=LIVDSRZULELA&limit=10", function(data) {
            // Clear the previous results
            gif_cont.empty();

            // Create a table for the GIFs
            var table = document.createElement("table");
            var row;

            // Display each GIF in the response
            data.results.forEach(function(result, index) {
                if (index % 2 === 0) {
                    // Create a new row for every two GIFs
                    row = document.createElement("tr");
                    table.appendChild(row);
                }

                var gifUrl = result.media[0].gif.url;

                // Create a table cell for each GIF and append it to the row
                var cell = document.createElement("td");
                var gifs = document.createElement("img");
                gifs.src = gifUrl;
                gifs.classList.add("gifs");
                // gifs.style.maxWidth = "100px"; // Set the maximum width of the GIF
                // gifs.style.maxHeight = "100px"; // Set the maximum height of the GIF

                gifs.addEventListener("click", function() {
                    var gifLink = gifUrl;

                    fetch('../php/insert.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'message=' + encodeURIComponent(gifLink)
                    })
                        .then(function(response) {
                            // Handle the response from the PHP file
                            console.log('GIF link sent successfully');
                        })
                        .catch(function(error) {
                            // Handle any errors
                            console.error('Error sending GIF link:', error);
                        });

                    search_cont.css('visibility', 'hidden');
                });

                cell.appendChild(gifs);
                row.appendChild(cell);
            });

            // Append the table to the GIF container
            gif_cont.append(table);
        });
    }

    // Event listener for the show search button click
    gif_btn.click(function() {
            search_cont.css('visibility', 'visible');
    });

     close.click(()=>{
            search_cont.css('visibility','hidden');
    });

    var typingTimer;
    var doneTypingInterval = 100; // Time in milliseconds

    // Event listener for input field changes
    $("#search-input").on("input", function() {
        clearTimeout(typingTimer);

        // Start a new timer
        typingTimer = setTimeout(performSearch, doneTypingInterval);
    });

    // Function to handle the search
    performSearch();
});
