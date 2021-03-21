$(document).ready(function () {
    /**
     * Table edit stuff on the right side 
     * Adding rows and columns with js
     * 
     * for the html see add_tables.php
     */
    const $tableID = $('.table-add-container  ');
    const newTr = `
    <tr class="hide">
        <td class="pt-3-half" contenteditable="true">Example</td>
        <td class="pt-3-half" contenteditable="true">Example</td>
        <td class="pt-3-half" contenteditable="true">Example</td>
        <td class="pt-3-half" contenteditable="true">Example</td>
        <td class="pt-3-half" contenteditable="true">Example</td>
        <td class="pt-3-half">
        <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a></span>
        <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a></span>
        </td>
        <td>
        <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0 waves-effect waves-light">Remove</button></span>
        </td>
    </tr>`;
    $('.table-add').on('click', function (e) {
        e.preventDefault();
        const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');
        if ($tableID.find('tbody tr').length === 0) {
            $('tbody').append(newTr);
        }
        $tableID.find('table').append($clone);
    });
    $('.table-add-column').on('click', function (e) {
        e.preventDefault();
        const $clone = $tableID.find('thead tr th').last().prev('th').clone(true, true);
        $clone.insertBefore('.table-add-container   thead tr th.remove_in_element');
        const $clone2 = $tableID.find('tbody tr td').last().prev('td').clone(true, true);
        $clone2.insertBefore('.table-add-container   tbody tr td.remove_in_element');
    });
    $('.table-remove-column').on('click', function (e) {
        e.preventDefault();
        

        if ($tableID.find('thead th').length === 2) {
            alert('Die Tabelle muss mindestens eine Spalte enthalten'); 
            return false; 
        }
        $tableID.find(' thead th').last().prev('th').detach();
        $(".table-add-container   tbody tr").each(function (index) {
            $(this).find("td").last().prev('td').detach();
        });
    });

    $tableID.on('click', '.table-remove', function (e) {
        e.preventDefault();
        $(this).parents('tr').detach();
    });

});