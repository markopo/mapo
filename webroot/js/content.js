/**
 * Created by marko on 28/12/2014.
 */

(function() {
    var readOnlyTable = $("table.readonly");

    readOnlyTable.find("input[type='text']").attr("readonly");
    readOnlyTable.find("textarea").attr("readonly");
    readOnlyTable.find("select").attr("disabled");



})();

