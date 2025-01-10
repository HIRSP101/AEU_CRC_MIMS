import ajaxtoRoute from "./genericCalltoRoute.js";
import setuppagination from './pagination.js';
import { previewPic } from "./previewPic.js";
export function handleBranchform(array, ExcelObj)
{
    const attr_arr = [
        "bhei_id",
        "institute_kh",
        "type",
        "institute_type",
        "full_address", 
        "established_at",
        "registered_at",
        "image",
    ];
    
    setuppagination(array, attr_arr, "update-branch");
    previewPic();
    $(".hoverablebranch").on("click", function(e) {
        if ($(e.target).closest('td').hasClass('action')) {
            return;
        }

        $(this).toggleClass('bg-slate-300 marked');
    });

    $("#delete").on("click", function(e) {
        e.preventDefault();
        var arr = [];
        $(".marked").each(function () {
            arr.push($(this).attr('data-id'))
        });
        ajaxtoRoute("POST","/delete-branches", arr)
    })
    $(".del-one").click(function(e) {
        e.preventDefault();
        const confirmed = confirm("Are you sure you want to delete this item? This action cannot be undone.");
        if (confirmed) {
            ajaxtoRoute("POST","/delete-branch", [$(this).attr('data-id')])
        }
    })

}