import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from "./pagination.js";
export function handleTotalmem(array, ExcelObj) {
    const attr_arr = [
        "member_id",
        "name_kh",
        "gender",
        "date_of_birth",
        "school_name",
        "member_type",
        "education_level",
        "registration_date",
    ];

    setuppagination(array, attr_arr, "update-member");

    $(".table table tbody").on("click", ".hoverablebranch", function (e) {
        if ($(e.target).closest("td").hasClass("action")) {
            return;
        }
        $(this).toggleClass("bg-slate-300 marked");
    });

    $(".table table tbody").on("dblclick", ".hoverablebranch", function (e) {
        e.preventDefault();
        const userId = $(this).attr("data-id");
        console.log(userId);
        window.location.href = `/member/${userId}`;
    });

    $("#delete").on("click", function (e) {
        e.preventDefault();
        var arr = [];
        $(".marked").each(function () {
            arr.push($(this).attr("data-id"));
        });

        if (arr.length === 0) {
            alert("Please select at least one user to delete");
            return;
        }

        const confirmDelete = confirm(
            "Are you sure you want to delete the selected users?"
        );

        if (confirmDelete) {
            ajaxtoRoute("POST", "/deletemember", arr);
        }
    });

    $(".table table tbody").on("click", ".del-one", function (e) {
        e.preventDefault();
        const userId = $(this).attr("data-id");
        console.log(userId);
        const confirmDelete = confirm(
            "Are you sure you want to delete this user?"
        );
        if (confirmDelete) {
            ajaxtoRoute("POST", "/deletemember", [userId]);
        }
    });

    // Date filtering range
    $("#dateRange").flatpickr({
        mode: "range",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates) {
            if (selectedDates.length === 2) {
                const startDate = selectedDates[0];
                const endDate = selectedDates[1];

                const filteredArray = array.filter((item) => {
                    if (!item.registration_date) {
                        return false;
                    }
                    const regDate = new Date(item.registration_date);
                    return regDate >= startDate && regDate <= endDate;
                });

                setuppagination(filteredArray, attr_arr, "update-member");
            }
        },
    });
}
