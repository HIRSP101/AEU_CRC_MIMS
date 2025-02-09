<div class="flex flex-col max-h-screen">
    <footer class="bg-[#dc2626] text-white py-2.5">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 My Website. All rights reserved.</p>
        </div>
    </footer>
</div>

</div>


@stack("JS")

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
