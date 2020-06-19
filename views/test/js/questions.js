$(document).ready(function(){

    var questions = new Array();
    var questionIndex = 0;
    var currentQuestion = questions[questionIndex];
    var testAnswers = new Array();
    var testEAnswers = new Array();
    var testId = $('#test_id').val();
    var eItemCount = 0;
    var eCorrectCount = 0;
    var testCategory = $('#test_category').val();
    $('.tooltiped').tooltip();


      function getQuestions(){
        var test_id = $('#test_id').val();
        var divAppend = "";
        $.ajax({
          url: '../get',
          method: 'post',
          data: {test_id: test_id, test_category: testCategory},
          dataType: 'json',
          success: function(data){
            for (var i = 0; i < data['questions'].length; i++) {
              questions.push('question'+data['questions'][i].q_id);
              divAppend += "<div class='col s12 m10 l10 offset-m1 offset-l1 test z-depth-4' id='question"+data['questions'][i].q_id+"'>";
                divAppend += "<div class='row'>";
                  divAppend += "<div class='question'>";
                  if (data['questions'][i].qDifficulty == "Easy") {
                    divAppend += "Difficulty: <span style='color: green'>" +data['questions'][i].qDifficulty+"</span><p id='countquestion"+data['questions'][i].q_id+"'></p>";
                  }else if (data['questions'][i].qDifficulty == "Average") {
                    divAppend += "Difficulty: <span style='color: blue'>" +data['questions'][i].qDifficulty+"</span><p id='countquestion"+data['questions'][i].q_id+"'></p>";
                  }else {
                    divAppend += "Difficulty: <span style='color: red'>" +data['questions'][i].qDifficulty+"</span><p id='countquestion"+data['questions'][i].q_id+"'></p>";
                  }
                    divAppend += "<div class='collection with-header'>";
                      divAppend += "<div class='collection-header'>";
                        divAppend += "<h5>"+data['questions'][i].qDescription+"</h5>";
                      divAppend += "</div>";
                      switch (testCategory) {
                        case 'Multiple Choice':
                          for (var j in data['choices']) {
                            for (var c = 0; c < data['choices'][j].length; c++) {
                              if (c==0) {
                                data['choices'][j] = shuffle(data['choices'][j]);
                              }
                              if (data['choices'][j][c].q_id == data['questions'][i].q_id) {
                                var choice = 'A';
                                divAppend += "<a class='collection-item' id='question"+data['questions'][i].q_id+"choice"+(c+1)+"' type='"+data['choices'][j][c].mccIsAnswer+"'><strong>"+(c+10).toString(36).toUpperCase()+". </strong>"+data['choices'][j][c].mccDescription+"</a>";
                                choice++;
                              }
                            }
                          }
                          break;
                        case 'True or False':
                          for (var t in data['tfAnswers']) {
                            if (data['tfAnswers'][t].q_id == data['questions'][i].q_id) {
                              if (data['tfAnswers'][t].tfaDescription == 'True') {
                                divAppend += "<a class='collection-item' id='question"+data['questions'][i].q_id+"choice1' type='1'><strong>A. </strong>TRUE</a>";
                                divAppend += "<a class='collection-item' id='question"+data['questions'][i].q_id+"choice2' type='0'><strong>B. </strong>FALSE</a>";
                              }else {
                                divAppend += "<a class='collection-item' id='question"+data['questions'][i].q_id+"choice1' type='0'><strong>A. </strong>TRUE</a>";
                                divAppend += "<a class='collection-item' id='question"+data['questions'][i].q_id+"choice2' type='1'><strong>B. </strong>FALSE</a>";
                              }
                            }
                          }
                          break;
                        case 'Enumeration':
                          divAppend += "<div class='col s12 l12 m12 enum'>";
                          divAppend += "<div class='enumanswers row'>";
                          divAppend += "<form id='form"+data['questions'][i].q_id+"'>";
                          for (var y in data['eAnswers']) {
                            if (data['eAnswers'][y]['info'].q_id == data['questions'][i].q_id) {
                              testEAnswers[data['questions'][i].q_id] = data['eAnswers'][y]['ans'];
                              for (var x = 0; x < data['eAnswers'][y]['info'].eAnswerCount; x++) {
                                divAppend += "<div class='input-field col s6 l6 m6'><input type='text' id='answer"+(x+1)+data['questions'][i].q_id+"'><label for='answer"+(x+1)+"'>"+(x+1)+".</label></div>";
                              }
                            }
                          }
                          divAppend += "</form>";
                          divAppend += "</div>";
                          divAppend += "</div>";
                          break;
                      }
                    divAppend += "</div>";
                    divAppend += "<input type='hidden' class='selectedChoice'>";
                  divAppend += "</div>";
                  divAppend += "<div class='col s8 m8 l8 offset-m1 offset-l1 offset-s2'>";
                    divAppend += "<label>";
                      divAppend += "<input type='checkbox' name='skip' class='filled-in skip' value=''>";
                      divAppend += "<span>Mark question as unanswered</span>";
                    divAppend += "</label>";
                  divAppend += "</div>";
                  divAppend += "<div class='col s7 m2 l2 right'>";
                    divAppend += "<a class='btn pink waves-effect waves-light nextQuestion' disabled>next</a>";
                  divAppend += "</div>";
                divAppend += "</div>";
              divAppend += "</div>";
            }
            $('#questionDiv').append(divAppend);
            questions = shuffle(questions);
            var questionCount = questions.length;
            var qItemCount = 1;
            showQuestion(questions[questionIndex]);

            function showQuestion(questionId){
              if (questions.length > 0) {
                var question = "#" +questionId;
                $('#count'+questionId).html("Question: "+qItemCount+"/"+questionCount);
                $(question).fadeIn('600');
              }else {
                $('#alrtModalOk').hide();
                $('#imgLoad').show();
                alertModal('', 'Preparing test result..', 1000, function(){
                  $('#leaveTest').hide();
                  $('#result').fadeIn('600');
                  if (testCategory == 'Enumeration') {
                    enumPrepareResult(testAnswers, testId, eItemCount, eCorrectCount);
                  }else {
                    prepareResult(testAnswers, testId);
                  }
                  $('#alertModalOk').show();
                  $('#imgLoad').hide();
                });
              }
            }
            function hideQuestion(questionId){
              var question = "#" + questionId;
              $(question).fadeOut('600');
            }

            $('.nextQuestion').click(function(){
              hideQuestion(questions[questionIndex]);
              if ($('.skip').is(':checked')) {
                questionIndex++;
              }else {
                var qId = questions[questionIndex].replace('question', '');
                var eItemAnswers = new Array();
                if(testCategory == 'Enumeration'){
                  var answerLength = $("#"+questions[questionIndex]).find('input[type=text]').length;
                  eItemCount+=answerLength;
                  for (var c = 1; c <= answerLength; c++) {
                    eItemAnswers.push($('#answer'+c+qId).val());
                  }
                  var qAnswer = 0;
                  for (var i in eItemAnswers) {
                    for (var d in testEAnswers[qId]) {
                      if (eItemAnswers[i].toLowerCase() == testEAnswers[qId][d].eaDescription.split('+').join(' ').toLowerCase()) {
                        eCorrectCount++;
                        qAnswer++;
                      }
                    }
                  }
                  if (qAnswer == answerLength) {
                    testAnswers.push({q_id: qId, answer: 1});
                  }else {
                    testAnswers.push({q_id: qId, answer: 0});
                  }
                }else {
                  testAnswers.push({q_id: qId, answer: $('#testCount').val()});
                }
                questions.splice(questionIndex, 1);
                qItemCount++;
              }
              currentQuestion = questions[questionIndex];
              reset();
              if (questions[questionIndex] == null) {
                questionIndex = 0;
              }
              showQuestion(questions[questionIndex]);
            });

            function checkFields(array){
              var bool = 0;
              for (var field in array) {
                var value = $(array[field]).val();
                if (value != '') {
                  bool = 1;
                }
              }
              return bool;
            }

            function enumPrepareResult(testAnswers, testId, eItemCount, eCorrectCount){
              var wrong = 0, percentage;

              wrong = eItemCount - eCorrectCount;
              percentage = (eCorrectCount / eItemCount) * 100;
              setGrade(Math.round(percentage));
              $.ajax({
                url: '../prepare',
                method: 'post',
                data: {testAnswers: testAnswers, testId: testId, testCategory: testCategory, eItemCount: eItemCount, eCorrectCount: eCorrectCount},
                dataType: 'json',
                success: function(data){
                  createPieChart([wrong, eCorrectCount]);
                }
              });
            }


            function prepareResult(testAnswers, testId){
              var correct = 0, testItems = testAnswers.length, wrong = 0, percentage;
              for (var i in testAnswers) {
                if (testAnswers[i].answer == 1) {
                  correct++;
                }
              }
              wrong = testItems - correct;
              percentage = (correct / testItems) * 100;
              setGrade(Math.round(percentage));
              $.ajax({
                url: '../prepare',
                method: 'post',
                data: {testAnswers: testAnswers, testId: testId, testCategory: testCategory},
                dataType: 'json',
                success: function(data){
                  createPieChart([wrong, correct]);
                }
              });
            }


            $('input[type=text]').keyup(function(){
              var qId = questions[questionIndex].replace('question', '');
              var answerLength = $("#"+questions[questionIndex]).find('input[type=text]').length;
              var answers = new Array();
              for (var i = 1; i <= answerLength; i++) {
                answers.push('#answer'+i+qId);
              }
              if(checkFields(answers) == 1){
                $('.nextQuestion').attr('disabled', false);
                $('.skip').attr('disabled', true);
              }else {
                $('.nextQuestion').attr('disabled', true);
                $('.skip').attr('disabled', false);
              }
            });

            function reset(){
              $('.collection-item').removeClass('active');
              $('.collection-item').find('.material-icons').detach();
              $('.collection-item').attr('rel', '');
              $('.nextQuestion').attr('disabled', true);
              $('.selectedChoice').val('');
              $('.skip').prop('checked', false);
              $('.skip').attr('disabled', false);
            }


            $('.collection-item').click(function(){
              if ($(this).prop('rel') != 'selected') {
                if ($('.selectedChoice').val() != '') {
                  var selectedChoice = "#" + $('.selectedChoice').val();
                  $(selectedChoice).removeClass('active');
                  $(selectedChoice).find('.material-icons').detach();
                  $(selectedChoice).attr('rel', '');
                }
                $(this).addClass('active');
                $(this).append("<i class='material-icons right'>check</i>");
                $(this).attr('rel', 'selected');
                $('.selectedChoice').val($(this).attr('id'));
                $('.nextQuestion').attr('disabled', false);
                $('.skip').attr('disabled', true);
                $('#testCount').val($(this).attr('type'));
              }else{
                $(this).removeClass('active');
                $(this).find('.material-icons').detach();
                $(this).attr('rel', '');
                $('.nextQuestion').attr('disabled', true);
                $('.skip').attr('disabled', false);
              }
            });

            $('.skip').click(function(){
              if ($(this).is(':checked')) {
                $('.nextQuestion').attr('disabled', false);
              }else {
                $('.nextQuestion').attr('disabled', true);
              }
            });
          }
        });
      }


        $.ajax({
          url: '../has',
          method: 'post',
          data: {test_id: testId},
          success: function(data){
            if (data == 1) {
              alertModal('Redirecting', 'Tests are only available once everyday.', 3000, function(){
                window.location.replace('../view/'+testId);
              });
            }else {
              getQuestions();
            }
          }
        });




    function shuffle(array){
      var currentIndex = array.length, temporaryValue, randonIndex;
      while (0 !== currentIndex) {
        randomIndex = Math.floor(Math.random() * currentIndex)
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }
      return array;
    }

    $('#msgModal').modal({
      onCloseEnd:function(){
        $('#read').prop('checked', false);
      }
    });
    $('#alrtModal').modal();

    function confirmModal(title, msg, yescb){
      $('#msgTitle').text(title);
      $('#msgBody').text(msg);
      $('#msgModal').modal('open');
      $('#msgModalCancel').click(function(){
        $('#modalConfirm').modal('close');
      });
      $('#msgModalOk').click(function(){
        yescb();
        $('#msgModal').modal('close');
      });
    }
    function alertModal(title, msg, duration = 1500, cb){
      $('#alrtTitle').text(title);
      $('#alrtBody').text(msg);
      $('#alrtModal').modal('open');
      $('#alrtModalOk').click(function(){
        $('#alrtModal').modal('close');
        cb();
      });
      setTimeout(function () {
        $('#alrtModal').modal('close');
        cb();
      }, duration);
    }



    $('#read').click(function(){
      if ($(this).is(':checked')) {
        $('#msgModalOk').attr('disabled', false);
      }else {
        $('#msgModalOk').attr('disabled', true);
      }
    });

    $('#leaveTest').click(function(){
      confirmModal('Leaving test', 'Test progress will not be saved. Continue?', function(){
        window.location.replace($('#leaveTest').attr('rel'));
      });
    });

  function setGrade(percentage){
    var grade = '', newClass = "btn-small green";

      if(percentage >= 97 && percentage <= 100)
        grade = "1.00 PASSED";
      else if(percentage >= 94 && percentage <= 96)
        grade = "1.25 PASSED";
      else if(percentage >= 91 && percentage <= 93)
        grade = "1.50 PASSED";
      else if(percentage >= 88 && percentage <= 90)
        grade = "1.75 PASSED";
      else if(percentage >= 85 && percentage <= 87)
        grade = "2.00 PASSED";
      else if(percentage >= 82 && percentage <= 84)
        grade = "2.25 PASSED";
      else if(percentage >= 79 && percentage <= 81)
        grade = "2.50 PASSED";
      else if(percentage >= 76 && percentage <= 78)
        grade = "2.75 PASSED";
      else if(percentage == 75)
        grade = "3.00 PASSED";
      else if(percentage >= 65 && percentage <= 74){
        grade = "4.00 FAILED";
        newClass = "btn-small orange";
      }
      else{
        grade = "5.00 FAILED";
        newClass = "btn-small red";
      }
      $('#test_result').html(grade);
      $('#test_result').removeClass();
      $('#test_result').addClass(newClass);
    }

  function createPieChart(data){
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: data,
          backgroundColor: [
            window.chartColors.red,
            window.chartColors.green
          ],
          label: 'Test Result'
        }],
        labels: [
          'Wrong',
          'Correct'
        ]
      },
      options: {
        title: {
          display: true,
          text: 'Test result'
        },
        responsive: true
      }
    };
    var ctx = document.getElementById('chart-area').getContext('2d');
    window.myPie = new Chart(ctx, config);
  }
});
