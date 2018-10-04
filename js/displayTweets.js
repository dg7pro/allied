$(document).ready(function() {
    //i variable declared to increment and assign a new class each time to the div
    var i = 1;

    //get the last 10 Twitter post and stores them in a JSON array
    $.getJSON('tweets_json.php?count=10', function(data) {
        listTweets(data);
    });

    /**
     * Function to create the tweet div and append the tweet in the div
     * @param data
     */
    function listTweets(data) {
        $.each(data, function(index) {
            //logs data to console
            //(data[index]);

            /**
             * Creates a new tweet div
             * if i = 1 need to set active
             */
            if(i == 1) {
                $('#tweetList').append('<div class="tweet-' + i + ' item active"></div>');
            } else {
                $('#tweetList').append('<div class="tweet-' + i + ' item"></div>');
            }

            //append the variable data into the new tweet div
            $('.tweet-' + i + '').append(checkURL(data[index]['text']));

            //increments the value of i
            increment();
        });
    }

    //function to increment the value of i
    function increment(){
        i++;
        return i;
    }

    /**
     * Function to convert string value words with http and https with links
     * @param text
     * @returns {string}
     * @constructor
     */
    function checkURL(text) {
        var url1 = /(^|&lt;|\s)(www\..+?\..+?)(\s|&gt;|$)/g,
            url2 = /(^|&lt;|\s)(((https?|ftp):\/\/|mailto:).+?)(\s|&gt;|$)/g;

        var html = $.trim(text);
        if (html) {
            html = html
                .replace(url1, '$1<a class="blue-link" target="_blank" href="http://$2">$2</a>$3')
                .replace(url2, '$1<a class="blue-link" target="_blank" href="$2">$2</a>$5');
        }
        return html;
    }

});