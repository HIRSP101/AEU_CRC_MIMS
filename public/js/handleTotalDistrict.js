import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from "./paginationDistrict.js";
export function handleTotalDistrict(array) {
    const attr_arr = ["district_id", "district_name", "branch_kh"];
    setuppagination(array, attr_arr, "update-district");

    $("#districtTableBody").on("click", ".btn-delete", function (e) {
        e.preventDefault();
        const districtId = $(this).attr("data-id");
        console.log("fghjk", districtId);

        const confirmDelete = confirm(
            "Are you sure you want to delete this district?"
        );
        if (confirmDelete) {
            ajaxtoRoute("POST", "/deletedistrict", [districtId]);
        }
    });
}
