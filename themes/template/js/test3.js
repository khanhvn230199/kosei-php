var testSkill = 1;
var restTime = true;
var remainingTime = 0;
var playList = [];
var interval;
var testId = $(".js-test").data("testId");
var oldData = localStorage.testData ? JSON.parse(localStorage.testData) : {};
var currentPlay = 0;

$(document).ready(function () {
  var token = true;

  collectAudioFiles();

  $(".js-toggle-test").on("click", function () {
    if (!token) return;
    token = false;

    $(this).hide();

    loadPlayList();

    setTimeout(prepareTest, 2000);
  });
});

function collectAudioFiles() {
  $(".js-sound").each(function () {
    let url = $(this).data("url");
    playList.push(new Audio(url));
  });
}

function loadPlayList(query) {
  var $loading = $(".js-test-loading");

  $loading.addClass("show");
  $loading.find("span").html($loading.data("text"));

  playList.forEach(function (audio) {
    audio.play();
    audio.pause();
    audio.currentTime = 0;
  });
}

function prepareTest() {
  let totalTime = 0;
  let $loading = $(".js-test-loading");
  let loadingText = $loading.data("text");

  $loading.find("span").html(loadingText);

  $(".js-test-loading").removeClass("show");
  $(".js-toggle-test").show();

  $(".js-test-skill").each(function () {
    if (!$(this).data("timer")) {
      let time = getTotalDuration(playList);
      $(this).data("timer", time);
      totalTime += time;
    } else {
      totalTime += parseInt($(this).data("timer"));
    }
  });

  // debugger;

  $(".js-toggle-test").text($(".js-toggle-test").data("start"));

  updateTotalTime(totalTime);
  loadingTest();
  attachClickEvent();

  if (oldData && oldData[testId]) {
    $(".md-continue").modal("show");
  }
}

function attachClickEvent() {
  $(".js-start-test").on("click", function () {
    startTest();
  });

  $(".js-complete-test").on("click", function () {
    completeTest();
  });

  $(".js-show-answer").on("click", function () {
    showAnswers();
  });

  $(".js-show-result").on("click", function () {
    $(".md-test-result").modal("show");
  });

  $(".js-toggle-test").on("click", function () {
    var type = $(this).data("btn");
    switch (type) {
      case "start":
        startTest();
        break;
      case "complete":
        completeTest();
        break;
      case "answer":
        calcAndShowModal();
        break;
      default:
        break;
    }
  });

  $(".js-answer-input").on("change", function () {
    var name = $(this).attr("name");

    $('.question-2__query[data-name="' + name + '"]').parents(".question-2__group").children(".question-2__query").addClass("is-selected");
  });

  $(".js-continue-test").on("click", function (e) {
    e.preventDefault();

    $(".md-continue").modal("hide");

    testSkill = oldData[testId].testSkill;

    currentPlay = oldData[testId].currentPlay || 0;

    if (currentPlay) {
      $(`.js-test-skill[data-skill="${testSkill}"]`).show();
    }

    if (!oldData[testId].restTime) {
      $(`.js-test-skill[data-skill="${testSkill}"]`).data("timer", oldData[testId].remainingTime);
    }

    loadingTest();

    oldData[testId].answer.forEach(function (id) {
      var $input = $(`[data-answer-id=${id}]`);
      var name = $input.attr("name");

      $input.prop("checked", true);

      $('.question-2__query[data-name="' + name + '"]').parents(".question-2__group").children(".question-2__query").addClass("is-selected");
    });
  });
}

function startTest() {
  var time = parseInt($(`.js-test-skill[data-skill="${testSkill}"]`).data("timer"));

  restTime = false;

  showTest();

  $(".js-resting-time").hide();
  $(".js-toggle-test").html($(".js-toggle-test").data("submit")).data("btn", "complete");
  stopTimer();
  startTimer(time, ".js-test-timer", ".js-complete-test");
  showStickyTimer();
}

function completeTest() {
  restTime = true;

  $("html, body").animate({
    scrollTop: 0
  }, 10);

  stopTimer();
  hideTest();
  hideStickyTimer();
  stopPlayList();

  if (testSkill == $(".js-test-skill").length) {
    $(".js-toggle-test").html($(".js-toggle-test").data("result")).data("btn", "answer");
    summary();
    return;
  }

  $(".js-toggle-test").html($(".js-toggle-test").data("continue")).data("btn", "start");
  $(".js-resting-time").show();
  startTimer(300, ".js-rest-timer", ".js-start-test");
  testSkill = testSkill + 1;
  loadingTest();
  saveTheProcess();
}

function loadingTest() {
  var testSection = $(`.js-test-skill[data-skill="${testSkill}"]`);
  var time = parseInt($(testSection).data("timer"));
  $(".js-test-info-skill").html("Kỹ năng: " + $(testSection).data("title"));
  updateTimer(".js-test-timer", time);
}

function summary() {
  $(".js-summary").show();
  calcAndShowModal();
}

function calcAndShowModal() {
  var name = $(".js-test").data("name") || "Khuyết Danh";
  var courseName = $(".js-test").data("course") || "JP";
  var totalPoint = parseFloat($(".js-test").data("totalpoint"));
  var vocabPoint = parseFloat($(`.js-test-skill[data-skill="1"]`).data("basepoint"));
  var readingPoint = parseFloat($(`.js-test-skill[data-skill="2"]`).data("basepoint"));
  var listeningPoint = parseFloat($(`.js-test-skill[data-skill="3"]`).data("basepoint"));

  var vocab = Array.from($(".js-vocab:checked"), function (el) {
    return parseFloat($(el).data("point"));
  }).reduce(function (total, item) {
    return total + item;
  }, 0);

  var grammar = Array.from($(".js-grammar:checked"), function (el) {
    return parseFloat($(el).data("point"));
  }).reduce(function (total, item) {
    return total + item;
  }, 0);

  var reading = Array.from($(".js-reading:checked"), function (el) {
    return parseFloat($(el).data("point"));
  }).reduce(function (total, item) {
    return total + item;
  }, 0);

  var listening = Array.from($(".js-listening:checked"), function (el) {
    return parseFloat($(el).data("point"));
  }).reduce(function (total, item) {
    return total + item;
  }, 0);

  var result = vocab + grammar && reading && listening && vocab + grammar > vocabPoint && reading > readingPoint && listening > listeningPoint && vocab + grammar + reading + listening > totalPoint;

  result = result ? "合格" : "不合格";

  var html = `
<div>
  <div class="test-result__title">${courseName}</div>
  <div class="test-result__info">
    <table>
        <tr>
            <td>氏名 Họ tên:</td>
            <td>${name}</td>
        </tr>
        <tr>
            <td>結果 Kết quả:</td>
            <td>${result}</td>
        </tr>
    </table>
  </div>
  <div class="test-result__table table-responsive">
    <table class="table table-bordered">
        <tr>
            <td colspan="3">得点区分別得点 Điểm thành phần</td>
            <td rowspan="2">
                <div>総合得点</div>
                <div>Tổng điểm</div>
            </td>
        </tr>
        <tr>
            <td>
                <div>言語知識（文字・語彙・文法）</div>
                <div>Từ vựng + Ngữ pháp</div>
            </td>
            <td>
                <div>読解</div>
                <div>Đọc hiểu</div>
            </td>
            <td>
                <div>聴解</div>
                <div>Nghe hiểu</div>
            </td>
        </tr>
        <tr>
            <td>${vocab + grammar}/60</td>
            <td>${reading}/60</td>
            <td>${listening}/60</td>
            <td>${vocab + grammar + reading + listening}/180</td>
        </tr>
    </table>
  </div>
  <div class="test-result__table-mobile">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td colspan="2">
                    <div>得点区分別得点</div>
                    <div>Điểm thành phần</div>
                </td>
                <td>
                    <div>総合得点</div>
                    <div>Tổng điểm</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div>(文字・語彙・文法）</div>
                    <div>Từ vựng + Ngữ pháp</div>
                </td>
                <td>${vocab + grammar}/60</td>
                <td rowspan="3">${vocab + grammar + reading + listening}/180</td>
            </tr>
            <tr>
                <td>
                    <div>読解</div>
                    <div>Đọc hiểu</div>
                </td>
                <td>${reading}/60</td>
            </tr>
            <tr>
                <td>
                    <div>聴解</div>
                    <div>Nghe hiểu</div>
                </td>
                <td>${listening}/60</td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
`;

  $(".js-test-result").html(html);
  $(".md-test-result").modal("show");

  // Send result to server
  if (window.saveTestResult && !window.send_result) {
    saveTestResult(vocab + grammar, reading, listening, vocab + grammar + reading + listening);
  }

  // Remove local data
  delete oldData[testId];
  localStorage.testData = JSON.stringify(oldData);
}

function updateTotalTime(time) {
  
  var m = Math.floor(time / 60);
  var h = Math.floor(m / 60);
  var s = Math.floor(time - m * 60);
  if (h>0) {
    m = m - h*60;
  }
  h = h ? h + " giờ" : 0;
  m = m ? " " + m + " phút" : 0;
  s = s ? " " + s + " giây" : 0;

  $(".js-total-time").html("Tổng thời lượng " + (h ? h : "") + (m ? m : "") + (s ? s : ""));
}

function updateTimer(el, time) {
  var h = Math.floor(time / 3600);
  var m = Math.floor((time - h * 3600) / 60);
  var s = Math.floor(time - h * 3600 - m * 60);

  h = ("0" + h).slice(-2);
  m = ("0" + m).slice(-2);
  s = ("0" + s).slice(-2);

  if (h === "00") {
    $(el).html(m + ":" + s);
  } else {
    $(el).html(h + ":" + m + ":" + s);
  }
}

function startTimer(time, timerEl, triggerEl) {
  interval = setInterval(function () {
    updateTimer(timerEl, --time);

    remainingTime = time;

    if (time > 10 && time % 5 == 0 && !currentPlay) {
      saveTheProcess();
    }

    if (time <= 0) {
      $(triggerEl).trigger("click");
    }
  }, 1000);
}

function stopTimer() {
  return clearInterval(interval);
}

function startPlayList(index) {
  var index = index || 0;
  playList[index].addEventListener("ended", function () {
    currentPlay = 0;
    startPlayList(index + 1);
  });
  playList[index].play();
  currentPlay = index;
  saveTheProcess();
}

function stopPlayList() {
  playList.map(function (audio) {
    audio.pause();
    audio.currentTime = 0;
  });
}

function getTotalDuration() {
  return playList.reduce(function (total, item) {
    return total + item.duration + 0.3;
  }, 0);
}

function enableQuestions() {
  $(".js-answer-input").prop("disabled", false);
  $(".js-answer-input").prop("checked", false);
}

function disableQuestions() {
  $(".js-answer-input").prop("disabled", true);
}

function showTranslations(isEnable) {
  if (isEnable) {
    $(".js-test-translation").show();
  }
}

function hideTranslations() {
  $(".js-test-translation").hide();
}

function showAnswers(answers) {
  disableQuestions();

  if (answers) {
    answers = answers.split(",");

    answers.forEach(answer => {
      var $input = $(`[data-answer-id="${answer}"]`);
      var name = $input.attr("name");

      $input.prop("checked", true);

      $('.question-2__query[data-name="' + name + '"]').parents(".question-2__group").children(".question-2__query").addClass("is-selected");
    });
  }

  $(".js-test-skill").show();
  $(".js-answer").addClass("show-answer");
  $(".question-2__query").addClass("show-answer");
}

function hideAnswers() {
  $(".js-test-skill").hide();
  $(".js-answer").remove("show-answer");
  $(".question-2__query").remove("show-answer");
}

function showTest() {
  var testSection = $(`.js-test-skill[data-skill="${testSkill}"]`);
  $(testSection).show();
  $(".js-complete-test-wrapper").show();

  if ($(testSection).find(".js-sound").length) {
    startPlayList(currentPlay);
  }
}

function hideTest() {
  $(`.js-test-skill[data-skill="${testSkill}"]`).hide();
  $(".js-complete-test-wrapper").hide();
}

function showStickyTimer() {
  $(".sticky-time").addClass("show");
}

function hideStickyTimer() {
  $(".sticky-time").removeClass("show");
}

function saveTheProcess() {
  var answer = Array.from(document.querySelectorAll(".js-answer-input:checked"), function (item) {
    return $(item).data("answerId");
  });

  data = {
    answer,
    testSkill,
    restTime,
    remainingTime,
    currentPlay
  };

  oldData[testId] = data;

  console.log(data);

  localStorage.testData = JSON.stringify(oldData);
}