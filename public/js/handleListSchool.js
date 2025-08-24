import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from "./paginationSchool.js";

export function handleListSchool(array, type = "school") {
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
    const attr_arr2 = ["bhei_id", "institute_kh", "registered_at", "branch_kh"];

    if (type === "school") {
        setuppagination(array, attr_arr, "update-school");
    } else if (type === "institute") {
        setuppagination(array, attr_arr2, "update-school");
    }

    $("#schoolTableBody").on("click", ".btn-delete", function (e) {
        e.preventDefault();
        const schoolId = $(this).attr("data-id");

        const confirmDelete = confirm(
            "Are you sure you want to delete this school?"
        );
        if (confirmDelete) {
            ajaxtoRoute("POST", "/deleteschool", [schoolId]);
        }
    });
}
