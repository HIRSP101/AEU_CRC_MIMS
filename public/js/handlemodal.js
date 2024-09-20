$(document).ready(function() {
    $("#toggleButton").click(function() {
        $(".collapsibleContent").slideToggle();
        $(this).toggleClass('flipped');
    });
    $('#dropdownToggle').on('click', function() {
        $('#dropdownMenu').toggleClass('hidden');
    });
    $('#cancel').on('click', function() {
        $('#usermodal').addClass('hidden');
    })
    $('#accountsetting').on('click', function() {
        $('#usermodal').toggleClass('hidden');
        $('#dropdownMenu').addClass('hidden');
    })
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#dropdownToggle').length && !$(e.target).closest('#dropdownMenu').length) {
            $('#dropdownMenu').addClass('hidden');
        }
        if (!$(e.target).closest('#usermodal')) {
            $('#usermodal').addClass('hidden');
        }
    });
    $('#saveprofile').on('click', function(e) {
        var username = new FormData($('#userform')[0]);
        var password = new FormData($('#userpassform')[0]);
        console.log(username, password == undefined ? password : "password is undefined!!!!!");
        $("#userform").submit();
        $("#userpassform").submit();
    })
    $("#openSidebar").click(function () {
        $("#sidebar").removeClass('-translate-x-full');
    })
    $("#closeSidebar").click(function () {
        $("#sidebar").addClass('-translate-x-full');
    })

});
