$(document).ready(function () {

    /**
     * Initiate the grid 
     */
    $( ".ui-draggable" ).append( "<div class='drag_handler'></div>" );

    let grid = GridStack.initAll( {
        removable: '#trash',
        removeTimeout: 100,
        acceptWidgets: true,
        column:20,
        disableOneColumnMode: true,
        verticalMargin: 0,
        cellHeight: 'auto',
        float: true, 
        draggable: {
            handle: '.drag_handler'
        }
    });
    /**
     * When changing a table, 
     * add or remove rows 
     */
    $('#third-grid, #second-grid, #advanced-grid').on('change', function (event, items) {
        var height = $(items[0].el).find('.grid-stack-item-content').outerHeight();
        var table_height = $(items[0].el).find('table.variable_height').outerHeight();
        var diff = height - table_height;

        //add rows if it is higher 
        if (diff > 0) {
            var amount = Math.floor(diff / 17);
            for (i = 0; i < amount; i++) {
                const $clone = $(items[0].el).find('tbody tr').last().clone(true).removeClass('hide table-line');
                $clone.find('td').text('');
                $(items[0].el).find('table.variable_height').append($clone);
            }
            //remove rows if it is smaller
        } else if (diff < 0) {
            var amount = Math.ceil(Math.abs(diff) / 17);
            for (i = 0; i < amount; i++) {
                $(items[0].el).find('tbody tr').last().detach();
            }
        }
    });


    $('.newWidget').draggable({
        revert: 'invalid',
        scroll: false,
        appendTo: 'body',
        helper: 'clone',
        handle: '.drag_handler',
        stop: function (event, GridStackUI) {
            if (window.automatic_calculation) {
                calculateSkills();
            }
            $('.skill_edit').bind("contextmenu", function (e) {
                e.preventDefault();
                return false;
            });
        }
    });



    /**
     * For the contenteditable
     * should be editable with right click since left click activates the drag and drop 
     
    $(document).on("contextmenu", '*[contenteditable="true"]', function (e) {
        e.preventDefault();
        return false;
    });
*/

    /**
     * Get the grid and convert it to an array
     * @param string name 
     */
    function gridToArray(name) {
        result = $('#' + name + '.grid-stack > .grid-stack-item:visible').map(function (i, el) {
            el = $(el);
            var node = el.data('_gridstack_node');
            return {
                x: node.x,
                y: node.y,
                width: node.width,
                height: node.height,
                html: el.html()
            };
        }).toArray();
        return result;
    }


    /**
     * Load the data array to the grid 
     * 
     * @param string name 
     * @param array data 
     */
    function loadDataToGrid(name, data) {
        first_grid = $('#' + name + '.grid-stack').data('gridstack');

        first_grid.removeAll();
        var items = GridStackUI.Utils.sort(data);
        first_grid.batchUpdate();
        items.forEach(function (node) {
            var html = $($.parseHTML('<div>' + node.html + '</div>'));
            first_grid.addWidget(html, node);
        }, this);
        first_grid.commit();
    }
    
    
    /**
     * Export grid as JSON 
     */
    //trigger save on click
    $('#export_grid').click(function () {
        saveGrid();
    });

    function saveData(data, fileName) {
        var a = document.createElement("a");
        document.body.appendChild(a);
        a.style = "display: none";

        var json = JSON.stringify(data),
            blob = new Blob([json], {
                type: "octet/stream"
            }),
            url = window.URL.createObjectURL(blob);
        a.href = url;
        a.download = fileName;
        a.click();
        window.URL.revokeObjectURL(url);

    };

    function saveGrid() {

        var first_page = gridToArray('advanced-grid');
        var second_page = gridToArray('second-grid');
        var third_page = gridToArray('third-grid');

        var total = [first_page, second_page, third_page, window.automatic_calculation];
        var data = JSON.stringify(total, null, '  ');

        //get the last 
        var last_saved = localStorage.getItem("last_saved");
        var file = "export_characters.json";
        if (last_saved) {
            last_saved = last_saved.replace(' ', '_'); 
            file = "export_character_" + last_saved + ".json";
        }
        saveData(data, file);
        return false;
    }


    /**
     * Load the grid from the file 
     */
    //when the uploaded file is changed, put into div as json
    $('#json_file').on('change', function () {
        var file = this.files[0];
        var fr = new FileReader();
        fr.onload = function () {
            $('#output').text(fr.result);

        };
        fr.readAsText(file);
    });

    //when clicking the loadData button, import the grid
    $('#load_data').click(function (e) {
        e.preventDefault();
        var serializedData = $('#output').text();
        var data = JSON.parse(serializedData);
        var data = JSON.parse(data);

        loadDataToGrid('advanced-grid', data[0]);
        loadDataToGrid('second-grid', data[1]);
        loadDataToGrid('third-grid', data[2]);

        localStorage.removeItem("last_saved");
        //change the autocalc value 
        $('#auto_calc').prop('checked', data[3]);
        $("#auto_calc").trigger("change");
        $('.save_grid_local').hide(); 
        show_success('Der Charakter wurde aus der Datei geladen'); 
        $('#json_file').val('');
        close_dialog();
    });


/** 
 * Load/ Save for index DB 
 * https://developer.mozilla.org/de/docs/Web/API/IndexedDB_API/IndexedDB_verwenden
 */

if (indexedDB) {
// Database name 
  const dbName = "dungeonslayer_chars";
  
  var request = indexedDB.open(dbName, 1);
  
  request.onerror = function(event) {
  };
  request.onsuccess = function(event) {
    window.db = this.result;
    
    fillCharHTMLfromStorage();

    var last_saved = localStorage.getItem("last_saved");
    if (last_saved) {
        loadGridFromStorage(last_saved);
    }
    
  };
  request.onupgradeneeded = function(event) {
    window.db = event.target.result;
  
    // Create an objectStore to hold information about characters 
    var objectStore =  window.db.createObjectStore("characters", { keyPath: "name" });
  
    // Create an index to search customers by name.
    objectStore.createIndex("name", "name", { unique: true });
  
  }; 

    $('#undo_grid').click(function(e){
        e.preventDefault(); 
        localStorage.removeItem("last_saved");
        location.reload();
    }); 
    /**
     * Save grid in local Storage 
     */

    $('.save_grid_local').click(function (e) {
        e.preventDefault();
            var char_name = $('#char_name').val().toString();

            if (!char_name) {
                alert('Bitte gebe einen Characternamen an');
                return false;
            }
    
            //set the last_saved in the local storage 
            localStorage.setItem("last_saved", char_name);

            $('.char_name').text(char_name);
            $('.save_as').show();

            //get the current content and save in local storage 
            saveHTMLToLocalStorage(char_name);

            //reload the list of chars in the load window 
            fillCharHTMLfromStorage();

            close_dialog();
    });


    /**
     * Save the HTML of the grids in the Local storage 
     */
    function saveHTMLToLocalStorage(char_name) {

        //establish connection
        var transaction = window.db.transaction(["characters"], "readwrite");
        var objectStore = transaction.objectStore("characters");
        
        //json encode data and create array 
        var first_page = JSON.stringify(gridToArray('advanced-grid'));
        var second_page = JSON.stringify(gridToArray('second-grid'));
        var third_page = JSON.stringify(gridToArray('third-grid'));
        var data = {name: char_name, page_1: first_page, page_2: second_page, page_3: third_page, auto_calc: window.automatic_calculation}

        var request = objectStore.put(data);
        request.onsuccess = function(event) {

            show_success('Der Charakter wurde gespeichert'); 
        };
    }



    /**
     * Fill in the List in the 'load' popup from storage
     */
    function fillCharHTMLfromStorage() {
        
        var transaction =  window.db.transaction(["characters"]);
        var objectStore = transaction.objectStore("characters");
        var request = objectStore.getAll();
        request.onsuccess = function(event) {
            $('#load_char_list').html('');
            request.result.forEach(function (item) {
                var o = new Option(item.name);
                /// jquerify the DOM object 'o' so we can use the html method
                $(o).html(item.name);
                $("#load_char_list").append(o);
            });
            $('#char_list').show();
        }
    }

    /**
     * Load the Grid from the IndexDB
     */
    $('#load_local_data').click(function (e) {
        e.preventDefault();
        var char_name = $('#load_char_list').val();
        loadGridFromStorage(char_name, false);
        $('#load_char_list').val('');
        close_dialog();
    });

    function loadGridFromStorage(char_name, auto_load = true) {
        var transaction =  window.db.transaction(["characters"]);
        var objectStore = transaction.objectStore("characters");
        var request = objectStore.get(char_name);
        request.onsuccess = function() {
            if (char_name) {
                
                var page_1 = JSON.parse(request.result.page_1); 
                var page_2 = JSON.parse(request.result.page_2); 
                var page_3 = JSON.parse(request.result.page_3); 
                loadDataToGrid('advanced-grid', page_1);    
                loadDataToGrid('second-grid', page_2);    
                loadDataToGrid('third-grid', page_3);
    
                //set the last used name in storage
                localStorage.setItem("last_saved", char_name);

                //change the autocalc value    
                $('#auto_calc').prop('checked', request.result.auto_calc);
                $("#auto_calc").trigger("change");

                $('.char_name').text(char_name);
                $('#char_name').val(char_name);
                $('.save_as').show();

                fillCharHTMLfromStorage();
                if(auto_load){
                    show_success('Der Charakter "'+char_name+'" wurde automatisch geladen'); 
                } else {
                    show_success('Der Charakter "'+char_name+'" wurde geladen'); 
                }
                
            }
            
        }

    }

//if the browser does not support IndexDB 
}else {
    $('.open_save_dialog').hide(); 
    $('.save_grid_local').hide(); 
    $('#char_list').hide(); 
}

});