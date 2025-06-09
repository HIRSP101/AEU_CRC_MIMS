{{-- <div class="flex flex-col max-h-screen">
    <footer class="bg-[#dc2626] text-white py-2.5">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 My Website. All rights reserved.</p>
        </div>
    </footer>
</div> --}}

</div>


@stack("JS")

<script>
    $("#openSidebar").click(() => {
        $(".module-content").toggle(400);
        $(".logo").toggleClass("w-10 w-20");
        $('#sidebar').toggleClass("w-60 collapsed-sidebar");
    });
</script>

</body>

</html>