$(document).ready(function () {
  var enableBtns = false; // enable show translate or answer

  // for normal test start
  $(".js-start-test").on("click", function () {
    if (!$(".js-test").length) {
      $(".md-noexam").modal("show");
      return;
    }

    $(".js-test").show();
    $(".js-resul-test").hide();
    $(".js-show-resultexercise").hide();

    enableQuestions();
    hideResult();
    hideAnswers();
    hideTranslations();
  });


   // for normal reultest start
  $(".js-show-resultexercise").on("click", function () {
    if (!$(".js-resul-test").length) {
      $(".md-noexam").modal("show");
      return;
    }

    $(".js-test").hide();
    $(".js-resul-test").show();

    disableQuestions();
    showResult();
    showAnswers(true);

    $("#show_question_result input").each(function(){
        var attr = $(this).attr("checked");
        if (typeof attr !== 'undefined' && attr !== false) {        
            $(this).prop("checked", true);
        }
    });
  });



  $(".js-answer-input").on("change", function () {
    var name = $(this).attr("name");

    $('.question-2__query[data-name="' + name + '"]').parents(".question-2__group").children(".question-2__query").addClass("is-selected");
  });

  enableQuestions();

  $(".js-finish-test").on("click", function () {
    enableBtns = true;

    disableQuestions();
    showResult();
    calcAndShowModal();
    showAnswers(enableBtns);
  });

  $(".js-reset-test").on("click", function () {
    enableQuestions();
    hideResult();
    hideAnswers();
    hideTranslations();
  });

  $(".js-show-answer").on("click", function () {
    showAnswers(enableBtns);
  });

  $(".js-show-translate").on("click", function () {
    showTranslations(enableBtns);
  });
});

function setRadiohecked(obj){
  var name = $(obj).attr("name");
  $("input[name='"+name+"']").removeAttr("checked");  
  $(obj).attr("checked", '');
}

function enableQuestions() {
  $(".js-answer-input").prop("disabled", false);
  $(".js-answer-input").prop("checked", false);
}

function disableQuestions() {
  $(".js-answer-input").prop("disabled", true);
}

function calcAndShowModal() {
  var question = $(".js-answer-input.correct").length;
  var correct = $(".js-answer-input.correct:checked").length;
  var point = Array.from($(".js-answer-input.correct:checked"), function (el) {
    return parseFloat($(el).data("point"));
  }).reduce(function (total, item) {
    return total + item;
  }, 0);

  $(".js-result").html(`<div>Bạn trả lời đúng ${correct}/${question} câu.</div><div>Số điểm: ${point}</div>`);
  $(".md-result").modal("show");

  var result = $("#ex_question_list").html();

  //update point + total_question
  updatePointQuestion(point, question, result);

}

function showResult() {
  $(".js-question").addClass("show-result");
}

function hideResult() {
  $(".js-question").removeClass("show-result");
}

function showTranslations(isEnable) {
  if (isEnable) {
    $(".js-test-translation").show();
  }
}

function hideTranslations() {
  $(".js-test-translation").hide();
}

function showAnswers(isEnable) {
  if (isEnable) {
    $(".js-answer").show();
  }

  $(".js-answer").addClass("show-answer");
  $(".question-2__query").addClass("show-answer");

  // kiểm tra kết quả lưu vào csdl
  // updateResulQuestion()

  // ENd


}

function hideAnswers() {
  $(".js-answer").removeClass("show-answer");
  $(".question-2__query").removeClass("show-answer");
  $(".question-2__query").removeClass("is-selected");
}