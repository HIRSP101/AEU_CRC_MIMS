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
    ];

    setuppagination(array, attr_arr, "update-member");

    $(".table table tbody").on("click", ".hoverablebranch", function (e) {
        if ($(e.target).closest("td").hasClass("action")) {
            return;
        }
        $(this).toggleClass("bg-slate-300 marked");
    });

    $("#delete").on("click", function (e) {
        e.preventDefault();
        var arr = [];
        $(".marked").each(function () {
            arr.push($(this).attr("data-id"));
        });
        ajaxtoRoute("POST", "/deletemember", arr);
    });
    $(".del-one").click(function (e) {
        e.preventDefault();
        ajaxtoRoute("POST", "/deletemember", [$(this).attr("data-id")]);
    });
}
