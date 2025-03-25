import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from "./paginationSchool.js";
export function handleListSchool(array) {
    const attr_arr = [
        "school_id",
        "school_name",
        "type",
        "village_name",
        "registration_date",
        "branch_kh",
        "district",
        "khom",
    ];
    setuppagination(array, attr_arr, "update-school");

    $("#schoolTableBody").on("click", ".btn-delete", function (e) {
        e.preventDefault();
        const schoolId = $(this).attr("data-id");
        console.log("fghjk", schoolId);

        const confirmDelete = confirm(
            "Are you sure you want to delete this school?"
        );
        if (confirmDelete) {
            ajaxtoRoute("POST", "/deleteschool", [schoolId]);
        }
    });
}
