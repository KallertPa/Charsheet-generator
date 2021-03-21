
  

  $(document).ready(function () {

    

    function printPDF() {

        var pdf = new jsPDF();
        pdf.canvas.height = 72 * 11;
        pdf.canvas.width = 72 * 8.5;
        html = $('#advanced-grid').html(); 
        pdf.fromHTML(html, 0, 0, {
            // options
        },
        function (bla) { pdf.save('saveInCallback.pdf'); },
        0);
    }; 

    $('.print').click(function(){
        printPDF(); 
    });
  }); 