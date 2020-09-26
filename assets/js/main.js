$(Function() {

    //cache the window object
    var $window = $(window);

    // parallax background effect
    $('section[data-type="background"]').each(function () {

        var $bgobj = $(this); //assigning the object

        $(window).scroll(function () {

            //scroll the background at var speed
            //the yPos is a negative value because we're scrolling it UP!

            var yPos = -(window.scrollTop() / $bgobj.data('speed'));

            //put together out final background position
            var coords = '50% ' + yPos + 'px';

            //Move the background 
            $bgobj.css({
                backgroundPosition
            });
        });
    });
});



<script>
    function signedup(){
        alert("You Have succesfully registered, login to your profile");
    }
    </script>
   
   <script>
    function login_rest (){
        $("rest_login_modal").modal("show");
    }
    </script>