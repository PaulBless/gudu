(function($) {
    "use strict";

    $(document).ready(function() {
        // get application storage data
        const optionsData = localStorage.getItem('guser');
        const user_rec = JSON.parse(optionsData);
        console.log(user_rec);

        // set data links and info based on user settings data from localstorage
        $('.username_link').html(user_rec.uname);
        $('.tokenValue').html(user_rec.ubalance);

        $('.logout').click(function() {
            // clear application settings storage data
            localStorage.removeItem('guser');
        });

    });

})(window.jquery)