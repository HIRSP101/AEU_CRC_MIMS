import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from "./pagination.js";
export function handleTotalmem(array, ExcelObj) {
    const attr_arr = [
        "member_id",
        "name_kh",
        "gender",
        "date_of_birth",
        "institute_id",
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
}

export function filterByDate(dateStr) {
    const [startDate, endDate] = dateStr.split(" to ");

    $.ajax({
        url: `/branch/${branchId}/village/${villageId}/school/${schoolId}`,
        method: "GET",
        data: {
            start_date: startDate,
            end_date: endDate,
        },
        success: function (response) {
            const filteredData = response.data;
            const attr_arr = [
                "member_id",
                "name_kh",
                "gender",
                "date_of_birth",
                "institute_id",
                "member_type",
                "education_level",
                "registration_date",
            ];
            setuppagination(filteredData, attr_arr, "update-member");
        },
        error: function (err) {
            console.error("Error fetching filtered data:", err);
        },
    });
}
