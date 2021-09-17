
$("#secondPlay").click(function(){
      reset();
      start();
      $('#secondPlay').prop("disabled", true);
    });

    $(".label").click(function(){
      $(this).addClass("player");
    });

    $("#reset").click(reset);

    $(".input").click(function(){
      if($(this).val() ==0){
        $(this).val(2);
        start();
      }
      
    });
    function reset(){
      $('#secondPlay').prop("disabled", false);
      $(".input").val(0);
      $(".label").removeClass("ai");
      $(".label").removeClass("player");
    }

    function start(){
      $.ajax({
          type: 'POST',
          url: 'algoritma.php',
          dataType: 'json',
          data: {
            "inpt1":$("#inpt1").val(), 
            "inpt2":$("#inpt2").val(),
            "inpt3":$("#inpt3").val(),
            "inpt4":$("#inpt4").val(),
            "inpt5":$("#inpt5").val(),
            "inpt6":$("#inpt6").val(),
            "inpt7":$("#inpt7").val(),
            "inpt8":$("#inpt8").val(),
            "inpt9":$("#inpt9").val(),
          },
          success: function(msg){
            console.log(msg);
            switch(msg.index){
              case 1: $("#box1").addClass("ai");
                      $("#inpt1").val(1);
                      break;
              case 2: $("#box2").addClass("ai");
                      $("#inpt2").val(1);
                      break;
              case 3: $("#box3").addClass("ai");
                      $("#inpt3").val(1);
                      break;   
              case 4: $("#box4").addClass("ai");
                      $("#inpt4").val(1);
                      break;
              case 5: $("#box5").addClass("ai");
                      $("#inpt5").val(1);
                      break;
              case 6: $("#box6").addClass("ai");
                      $("#inpt6").val(1);
                      break;
              case 7: $("#box7").addClass("ai");
                      $("#inpt7").val(1);
                      break;
              case 8: $("#box8").addClass("ai");
                      $("#inpt8").val(1);
                      break;
              case 9: $("#box9").addClass("ai");
                      $("#inpt9").val(1);
                      break;                                                     
            }

            if(msg.statusAi =='ai'){
              // await sleep(1000);
              alert("You Loss !");
            }
            else if(msg.statusPlayer =='player'){
              // await sleep(1000);
              alert("You Win !");
            }
            else if(msg.full == true){
              alert("Draw");
            }
          }
      });

    }