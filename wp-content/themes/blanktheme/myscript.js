    (function($) {
        function updateClock() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var timeString = hours + ':' + minutes + ':' + seconds;
            $('#clock-widget').text(timeString);
        }

        $(document).ready(function() {
            updateClock();
            setInterval(updateClock, 1000);
        });
    })(jQuery);
