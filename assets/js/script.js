var height = $('#advanced-grid').width() / 10;

        $('#advanced-grid').gridstack({
            removable: '#trash',
            removeTimeout: 100,
            acceptWidgets: true,
            verticalMargin: 0,
            cellHeight: 'auto'

        });
        $('.newWidget').draggable({
            revert: 'invalid',
            scroll: false,
            appendTo: 'body',
            helper: 'clone'
        }).click(function() {
            $(this).draggable({ disabled: false });
        }).dblclick(function() {
            $(this).draggable({ disabled: true });
        });
        $(document).ready(function () {


            //hide all popups 
            $('.dialog').hide(); 
            $("#add_item").click(function () {
                $('.dialog').hide(); 
                $('#dialog').show(); 
            });

            $('.close_dialog').click(function(){
                $('.dialog').hide(); 
            }); 


            $("#add_table").click(function () {
                $('.dialog').hide(); 
                $('#dialog_table').show(); 
            });

            $('#change_image').click(function() {
                $('.dialog').hide(); 
                var title = $('#new_item_title').val(); 
                var text = $('#new_item_text').val(); 
                var radioValue = $("input[name='icon']:checked"). val();
                $('.top-items-edit .item_title').html(title); 
                $('.top-items-edit .item_text').html(text); 
                if(radioValue){
                    $('.top-items-edit .item_image').html('<img src="./assets/img/'+radioValue+'" />');
                } 
                $('.dialog').hide(); 
            }); 

            $('#change_table').click(function() {
                
                
                var columns =  $('#new_table_columns').val(); 
                var rows = $('#new_table_rows').val();
                var content = "<table>";
                content += '<tr>';
                for(i=0; i<columns; i++){
                    var title=  $('#new_table_column_title_'+i).val(); 
                    content += '<th>' + title + '</th>';
                }
                content += '</tr>';
                for(j=0; j<rows; j++){
                    content += '<tr>';
                    for(k=0; k<columns; k++){
                        content += '<td></td>'
                    }
                    content += '</tr>';
                }
                
                content += "</table>"

                $('.top-items-edit .added_table').append(content);

                $('.dialog').hide(); 
            }); 

            $('#new_table_columns').change(function(){
                var number =  $('#new_table_columns').val(); 
                $('#new_table_columns_title').html(''); 
                for (var i = 0; i < number; i++) {
                    $('#new_table_columns_title').append('<label class="width-100" for="new_table_column_title_'+i+'">Überschrift '+(i+1)+' </label> <input type="text" id="new_table_column_title_'+i+'" placeholder="text" /><br />');
                }
            });

            
           
  


        const $tableID = $('.top-items-edit #table');

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

 $('.table-add').on('click', () => {
   const $clone = $tableID.find('tbody tr').last().clone(true).removeClass('hide table-line');

   if ($tableID.find('tbody tr').length === 0) {

     $('tbody').append(newTr);
   }

   $tableID.find('table').append($clone);
 });
 $('.table-add-column').on('click', () => {
    const $clone = $tableID.find('thead tr th').last().prev('th').clone(true, true);
    $clone.insertBefore('.top-items-edit #table thead tr th.remove_in_element');

    const $clone2 = $tableID.find('tbody tr td').last().prev('td').clone(true, true);
 
    $clone2.insertBefore('.top-items-edit #table tbody tr td.remove_in_element');
  });
  
 $('.table-remove-column').on('click', () => {
    $tableID.find(' thead tr th').last().prev('th').detach();
    $( ".top-items-edit #table tbody tr" ).each(function( index ) {
        $( this ).find( "td" ).last().prev('td').detach();
    }); 
 
  });
 
 $tableID.on('click', '.table-remove', function () {

   $(this).parents('tr').detach();
 });



});