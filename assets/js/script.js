$(document).ready(function () {
/**
 * Popup Window functions 
 */
  $('.open_dialog').on('click', function(e){
    e.preventDefault(); 
    var name = $(this).attr('data-dialog'); 
    console.log(name);
    $('.dialog').hide(); 
    $('#dialog').show(); 
    $('.dialog_'+name).fadeIn(); 
    $('#black_overlay').fadeIn(); 
    
    $("html, body").animate({ scrollTop: 0 }, "slow");
  }); 

  $('.close_dialog').click(function(e){
    e.preventDefault(); 
    close_dialog(); 
  }); 
  function close_dialog(){
    $('#dialog').fadeOut(); 
    $('#black_overlay').fadeOut(); 
  }

  $('.scroll_to').click(function(e){
    e.preventDefault(); 
    var ele = $(this).attr('href');
    console.log(ele);
    $("html, body").animate({
      scrollTop: $(ele).offset().top
  }, 300);
  }); 


/**
 * Change font stuff
 */

$('#fonts').on('change', function(){
  var selected = $("#fonts :selected").val();
  $("body").removeClass();
  $('body').addClass(selected);
}); 

$('#change_font').click(function(e){
  e.preventDefault(); 
    var selected = $("#font_selection :selected").val();
    var tr = window.getSelection().getRangeAt(0);
    var span = document.createElement("span");
    span.classList.add(selected);
    tr.surroundContents(span);

}); 
const pickr = new Pickr({
  el: '.pickr-container',
  theme: 'classic',
  default: '#42445a',
  lockOpacity: true,
  components: {
    palette: true,
    preview: true,
    opacity: false,
    hue: true,   
    interaction: {
        hex: false,  
        rgba: false,
        hsla: false, 
        hsva: false, 
        cmyk: false,
        input: true,
        cancel: false, 
        clear: false, 
        save: true,  
    }
  }
}); 
pickr.on('save', (color, instance) => {
  pickr.hide();
});

$('#change_color').click(function(e){
  e.preventDefault(); 
    var tr = window.getSelection().getRangeAt(0);
    var span = document.createElement("span");
    var color = pickr.getColor(); 
    span.style.cssText = "color:"+color.toHEXA();
    tr.surroundContents(span);

}); 


/**
 * Toggling the view in the sidebar
 */

$('.area_toggle').on('click',function(e){
  e.preventDefault(); 
  var ele = $(this).attr('data-toggle');
  $('.'+ele).toggle(300, function() {
    // Animation complete.
  });
  $(this).toggleClass('hide_icon'); 
}); 

/**
 * Changing the Skill in the add Skill edit 
 */
  $('#change_image').click(function(e) {
    e.preventDefault(); 
    
    var title = $('#new_item_title').val(); 
    var text = $('#new_item_text').val(); 
    var radioValue = $("input[name='icon']:checked"). val();
    $('.top-items-edit .item_title').html(title); 
    $('.top-items-edit .item_text').html(text); 
    if(radioValue){
        $('.top-items-edit .item_image').html('<img src="./assets/img/icons/'+radioValue+'" />');
    } 
    close_dialog(); 
  }); 

/**
 * On Attributes edit calculate the Skills 
 */
  $(document).on( 'input','.dungeonslayer-content .attrib_edit', function(){
    calculateSkills(); 
  }); 


  function calculateSkills(){
    var attribs = [];

    //get all the current attributes 
    $('.attrib_edit').each(function(){
      var skill = $(this).attr('data-attr'); 
      var text = $(this).text(); 
      attribs[skill] =text; 
    
      //when all the attributes have been looped through 
      if(attribs.length = 9){

        // get the Equipment value 
        attribs['pa'] = parseInt($('.dungeonslayer-content .pa_result').text()); 
        $('.dungeonslayer-content .skill_item').each(function(){
          //workaround for problem with geist und geschick: usually first replaces the ge and then the gei is not replaced. Now rename gei to sk
          var value = $(this).children('.item_text').text().toLowerCase().replace('ä', 'a').replace('ö', 'o').replace('gei', 'sk');
          var new_v = value;  
          for (key in attribs) {
            if( value.indexOf(key) >= 0){
              if(attribs[key]){              
                new_v = new_v.replace(key, attribs[key]); 
              }
            }          
          };
          try {
            old_v = new_v;   
            //for the perception: replace the 8 
            new_v = new_v.replace('oder 8', ''); 
            var res = eval(new_v); 
            if(typeof(res) == "number" && res > 0){
              
              if(old_v.indexOf('oder 8') >= 0 && res < 8){
                res = 8; 
              }
              $(this).children('.skill_edit').text(res); 
            }
          } catch (e) {
          }

        });
      }
    });
  }

  $(document).on( 'input','.dungeonslayer-content .nsc_attrib_edit', function(){
    var attribs = [];

    //get all the current attributes 
    $(this).closest('.dungeonslayer-content').find('.nsc_attrib_edit').each(function(){
      var skill = $(this).attr('data-attr'); 
      var text = $(this).text(); 
      attribs[skill] =text; 
    
      //when all the attributes have been looped through 
      if(attribs.length = 11){
        $(this).closest('.dungeonslayer-content').find('.nsc_skill').each(function(){
          //workaround for problem with geist und geschick: usually first replaces the ge and then the gei is not replaced. Now rename gei to sk
          var value = $(this).children('.skill_edit').attr('data-calc');
          var new_v = value;  
          for (key in attribs) {
            if( value.indexOf(key) >= 0){
              if(attribs[key]){              
                new_v = new_v.replace(key, attribs[key]); 
              }
            }          
          };
          console.log(new_v);
          try {
            old_v = new_v;   
            var res = eval(new_v); 
            
            if(typeof(res) == "number" && res > 0){

              $(this).children('.skill_edit').text(res); 
            }
          } catch (e) {
          }

        });
      }
    });
  }); 




/** 
 * On edit the Equipment table, calculate total equipment stats  
 */
  $(document).on('input','.dungeonslayer-content .pa_edit', function(){
    var total = 0; 
    $('.dungeonslayer-content .pa_edit').each(function(){
      var text = parseInt($(this).text()); 
      if(typeof(text) == "number" && text > 0){
        total += text; 
      }
    }); 
    $('.dungeonslayer-content .pa_result').text(total);
    calculateSkills(); 
  }); 

/**
 * Initiate the grid 
 */

  var $grid = $('#advanced-grid').gridstack({
      removable: '#trash',
      removeTimeout: 100,
      acceptWidgets: true,
      verticalMargin: 0,
      cellHeight: 'auto',
      float : true

  });

  var $grid = $('#second-grid').gridstack({
    removable: '#trash',
    removeTimeout: 100,
    acceptWidgets: true,
    verticalMargin: 0,
    cellHeight: 'auto',
    float : true

});
$('#third-grid').gridstack({
  removable: '#trash',
  removeTimeout: 100,
  acceptWidgets: true,
  verticalMargin: 0,
  cellHeight: 'auto',
  float : true
});

$('#third-grid, #second-grid, #advanced-grid').on('change', function(event, items) {
  console.log(items[0].el);
   var height = $(items[0].el).find('.grid-stack-item-content').outerHeight(); 
   var table_height = $(items[0].el).find('table.variable_height').outerHeight(); 
   var diff = height - table_height; 
   if(diff > 0){
     var amount = Math.floor(diff/17); 
     for (i = 0; i < amount; i++) {
      const $clone =  $(items[0].el).find('tbody tr').last().clone(true).removeClass('hide table-line');
      $clone.find('td').text(''); 

      $(items[0].el).find('table.variable_height').append($clone);
     }
     
     console.log('added '+amount);
   } else if(diff < 0){
      var amount = Math.ceil(Math.abs(diff)/17); 
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
      stop: function(event, GridStackUI){
        calculateSkills(); 
        $('.skill_edit').bind("contextmenu", function(e) {
          e.preventDefault();
          return false;
        });
      }
  }).click(function() {
      $(this).draggable({ disabled: false });
  }).dblclick(function() {
      $(this).draggable({ disabled: true });
  }).bind("contextmenu", function(e) {
      e.preventDefault();
  });



/**
 * For the contenteditable
 * should be editable with right click since left click activates the drag and drop 
 */
  $(document).on( "contextmenu", '*[contenteditable="true"]', function(e) {
    e.preventDefault();
    return false;
  });



/**
 * Save and load the grid 
 * Gridstack github example: 
 * https://github.com/gridstack/gridstack.js/blob/115c3d259c0cba3188644983d20c45eb1cf6de63/demo/serialization.html
 */

var saveData = (function () {
  var a = document.createElement("a");
  document.body.appendChild(a);
  a.style = "display: none";
  return function (data, fileName) {
      var json = JSON.stringify(data),
          blob = new Blob([json], {type: "octet/stream"}),
          url = window.URL.createObjectURL(blob);
      a.href = url;
      a.download = fileName;
      a.click();
      window.URL.revokeObjectURL(url);
  };
}());

$('#json_file').on('change', function(){
  var file = this.files[0];
  var fr = new FileReader();
  fr.onload = function() {
      console.log("Done");
      $('#output').text(fr.result);
  };
  fr.onerror = function() {
      console.log("Error reading the file");
  };
  console.log("Reading...");
  fr.readAsText(file);
}); 


  
  this.saveGrid = function () {
      first_page = $('#advanced-grid.grid-stack > .grid-stack-item:visible').map(function (i, el) {
        el = $(el);
        var node = el.data('_gridstack_node');
        console.log(el.html());
        return {
          x: node.x,
          y: node.y,
          width: node.width,
          height: node.height, 
          html: el.html()
        };
      }).toArray();
      second_page = $('#second-grid.grid-stack > .grid-stack-item:visible').map(function (i, el) {
        el = $(el);
        var node = el.data('_gridstack_node');
        console.log(el.html());
        return {
          x: node.x,
          y: node.y,
          width: node.width,
          height: node.height, 
          html: el.html()
        };
      }).toArray();

      var total = [first_page, second_page]; 
      var data = JSON.stringify(total, null, '  '); 

      saveData(data, 'export_characters.json');
      return false;
    }.bind(this);

    this.loadGrid = function () {

      var serializedData = $('#output').text();  
      var data = JSON.parse(serializedData); 
      var data = JSON.parse(data); 

      first_grid = $('#advanced-grid.grid-stack').data('gridstack');

      first_grid.removeAll();
      var items = GridStackUI.Utils.sort(data[0]);
      first_grid.batchUpdate();
      items.forEach(function (node) {
        var html =  $($.parseHTML('<div>'+node.html+'</div>')); 
        console.log(html);
        first_grid.addWidget(html, node);
      }, this);
      first_grid.commit();

      second_grid = $('#second-grid.grid-stack').data('gridstack');

      second_grid.removeAll();
      var items = GridStackUI.Utils.sort(data[1]);
      second_grid.batchUpdate();
      items.forEach(function (node) {
        var html =  $($.parseHTML('<div>'+node.html+'</div>')); 
        second_grid.addWidget(html, node);
      }, this);
      second_grid.commit();


      close_dialog(); 
      return false;
    }.bind(this);
    $('#load_data').click(this.loadGrid); 
    $('#save_grid').click(this.saveGrid);



/**
 * Table edit stuff on the right side 
 * Adding rows and columns 
 */
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
      $tableID.find(' thead th').last().prev('th').detach();
      $( ".top-items-edit #table tbody tr" ).each(function( index ) {
          $( this ).find( "td" ).last().prev('td').detach();
      }); 
  
    });
 
  $tableID.on('click', '.table-remove', function () {
    $(this).parents('tr').detach();
  });


/**
 * Sticky Sidebar 
 **/
if(($(document).scrollTop() > 275)) {
  $('.top-items-edit').removeClass('relative');
  $('.top-items-edit').addClass('fixed');
} else {
  $('.top-items-edit').removeClass('fixed');
  $('.top-items-edit').addClass('relative');
}

    $(window).scroll(function(){
      if(($(document).scrollTop() > 275)) {
              $('.top-items-edit').removeClass('relative');
              $('.top-items-edit').addClass('fixed');
      } else {
              $('.top-items-edit').removeClass('fixed');
              $('.top-items-edit').addClass('relative');
      }
  });
});