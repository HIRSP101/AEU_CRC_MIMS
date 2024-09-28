</div>

@stack("JS")
<!-- <script src="{{ asset('js/script.js') }}"></script> -->
<script>
    $("#openSidebar").click(() => {
        $(".module-content").toggle(400);
        if ($(".logo").hasClass("w-20")) {
            $(".logo").removeClass("w-20");
            $(".logo").addClass("w-10");
        } else {
            $(".logo").removeClass("w-10");
            $(".logo").addClass("w-20");
        }
    });
</script>

</body>

</html>