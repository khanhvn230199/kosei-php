if ($("#lessionVideoPlayer").length > 0) {
    var timer = null,
        totalTime = 0,
        running = 0,
        lostfocus = 0;

    var startTimer = new Date().getTime();
    var endTimer = new Date().getTime();
    var time = new Date();
}

$(document).ready(function() {




    setMenuActive();
    $(".embed-responsive").bind("contextmenu", function(e) {
        return false;
    });



    $('.js-show-tab').click(function(e) {
        var tab = $(this).attr('href');

        $('li > a[href="' + tab + '"]').tab("show");

        $('html, body').animate({
           
            scrollTop: $('.nav-item').offset().top - 80
           
        }, 1000);
    });

    $(window).on('load',function() {

        // alert('xxx');

        if ($('.js-show-combo').length>0){
            var tab = $('.js-show-combo').attr('href');
            $('li > a[href="' + tab + '"]').tab("show");
            $('html, body').animate({
                scrollTop: $('.js-show-combo').offset().top - 80
            }, 1000);
        }
    });


    $('.js_show_review_the_results').on('click',function() {

        $('html, body').animate({
            scrollTop: $('.list-unstyled').offset().top - 80
        }, 1000);
    });




    var mediaElements = document.querySelectorAll("video, audio");
    for (var i = 0, total = mediaElements.length; i < total; i++) {
        new MediaElementPlayer(mediaElements[i], {
            autoRewind: false,
            defaultSeekBackwardInterval: function(media) {
                return 10;
            },
            defaultSeekForwardInterval: function(media) {
                return 10;
            },
            features: ["playpause", "current", "progress", "duration", "volume", "skipback", "jumpforward", "speed", "quality", "fullscreen"],
        });




        //Added 08/03/2023
        if ($("#lessionVideoPlayer").length > 0) {

            player = document.getElementById("lessionVideoPlayer");

            window.onfocus = function() {
                if (lostfocus == 1) {
                    lostfocus = 0;
                    document.getElementById("lessionVideoPlayer").play();
                    startPlaying();
                }
            };
            window.onblur = function() {
                if (running == 1) {
                    lostfocus = 1;
                    document.getElementById("lessionVideoPlayer").pause();
                    pausePlaying();
                }
            };
            window.addEventListener('beforeunload', function(e) {
                e.preventDefault();
                e.returnValue = '';

                if (running == 1) {
                    lostfocus = 1;
                    endTimer = new Date().getTime();
                    updateStudyTimer(startTimer, endTimer);
                    startTimer = new Date().getTime();
                }
            });

            player.addEventListener("play", startPlaying);
            player.addEventListener("pause", pausePlaying);

            function startPlaying() {
                startTimer = new Date().getTime();
                running = 1;
                console.log("Start counter");
            }

            function pausePlaying() {
                if (running == 1) {
                    endTimer = new Date().getTime();
                    totalTime += endTimer - startTimer;
                    running = 0;
                    console.log(endTimer + " " + startTimer);
                    console.log("Played time " + parseInt(totalTime / 1000));
                    //update to CSDL
                    updateStudyTimer(startTimer, endTimer);
                }
            }
        }
        //End Added 08/03/2023

    }




    $(".js-btn-coupon").on("click", function() {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: VNCMS_URL + "/stage/ajax/get_discount",
            data: {
                coupon: $("#coupon").val(),
                cat_id: $("#cat_id").val(),
            },
            cache: false,
            success: function(data) {
                if (data.status == "success") {
                    $(".js-save-block").show();
                    $(".js-save-vn").text(data.data["save_vn"].toLocaleString());
                    $(".js-total-vn").text(data.data["total_vn"].toLocaleString());

                    $(".js-save-jp").text(data.data["save_jp"].toLocaleString());
                    $(".js-total-jp").text(data.data["total_jp"].toLocaleString());
                } else {
                    Swal.queue([{
                        title: "Thông báo",
                        type: data.status,
                        text: data.message,
                    }, ]);
                }
            },
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    $(".js-card-payment").on("change", function() {
        var title = $(".js-card-payment:checked").data("ah");
        $(".js-account-name").text(title);
        $("#account_holder").removeClass("d-none");
    });
});

function updateStudyTimer(beginTime, endTime) {
    $.ajax({
        type: "POST",
        url: "",
        dataType: "json",
        cache: false,
        data: { 'btnUpdateTime': 'UpdateTime', 'beginTime': beginTime, 'endTime': endTime },
    }).done(function(data) {
        console.log("updated");
    });
}

function updatePointQuestion(scores, total_question, result) {
    $.ajax({
        type: "POST",
        url: "",
        dataType: "json",
        cache: false,
        data: { 'btnUpdatePoint': 'UpdatePoint', 'scores': scores, 'total_question': total_question, 'result':result },
    }).done(function(data) {
        console.log("updated");
    });
}


// function updateResulQuestion(question_result) {
//     $.ajax({
//         type: "POST",
//         url: "",
//         dataType: "json",
//         cache: false,
//         data: { 'btnUpdateResult': 'UpdateResult', 'question_result': question_result },
//     }).done(function(data) {
//         console.log("updated");
//     });
// }



function ajax_login() {
    $.ajax({
        type: "POST",
        url: VNCMS_URL + "/account/ajax/login",
        dataType: "text",
        data: $("#login_form").serialize(),
    }).done(function(data) {
        if (data == "1") {
            location.reload();
        } else {
            alert("Đăng nhập không thành công, tài khoản hoặc mật khẩu không chính xác!");
        }
    });
}

function ajax_forgot() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: VNCMS_URL + "/account/ajax/forgot",
        data: $("#forgot_form").serialize(),
        cache: false,
        success: function(data) {
            Swal.queue([{
                title: "Thông báo",
                type: data.status,
                text: data.message,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    if (data.status === "success") {
                        $("#forgot_form").trigger("reset");
                        $(".md-recovery").modal("hide");
                    }
                },
            }, ]);
        },
    });
}

function ajax_advisory(num) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: VNCMS_URL + "/ajax/advisory",
        data: $("#advisory_form" + num).serialize(),
        cache: false,
        success: function(data) {
            Swal.queue([{
                title: "Thông báo",
                type: data.status,
                text: data.message,
            }, ]);
        },
    });
}

//Xem truoc anh avatar truoc khi upload
function setPreviewAvatar(input, imgobj) {
    if (!/(\.png|\.gif|\.jpg|\.jpeg)$/i.test(input.files[0].name)) {
        alert("Chỉ chấp nhận các tệp đuôi JPG, JPEG, GIF, PNG");
        input.value = "";
        return false;
    }
    if (input.files[0].size > 1 * 1024 * 1024) {
        alert("Tệp ảnh phải có dung lượng nhỏ hơn 1 MB");
        input.value = "";
        return false;
    }
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#" + imgobj).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
    return false;
}

function save_score(exam_id, lesson_id, scores, questions) {
    var url = VNCMS_URL + "/exams/ajax/save_score";
    var data = { exam_id: exam_id, scores: scores, questions: questions };
    if (lesson_id > 0) {
        url = VNCMS_URL + "/lessons/ajax/save_score";
        data = { lesson_id: lesson_id, scores: scores };
    }
    $.ajax({
        type: "POST",
        url: url,
        dataType: "text",
        data: data,
    }).done(function(t) {});
}

function save_trial_test_score(tt_id, vocabulary_score, reading_score, listening_score) {
    var url = VNCMS_URL + "/trial-test/ajax/save_score";
    var data = {
        tt_id: tt_id,
        vocabulary_score: vocabulary_score,
        reading_score: reading_score,
        listening_score: listening_score,
    };
    $.ajax({
        type: "POST",
        url: url,
        dataType: "text",
        data: data,
    }).done(function(t) {});
}

function saveTestResult(vocab, reading, listening, total) {
    var url = VNCMS_URL + "/trial-test/ajax/save_score";
    var tt_id = $(".js-test").data("test");
    var test_id = $(".js-test").data("testId");

    if (!tt_id) return;

    var answers = Array.from(document.querySelectorAll(".js-answer-input:checked"), function(item) {
        return $(item).data("answerId");
    }).join(",");

    $.ajax({
        type: "POST",
        url: url,
        dataType: "text",
        data: {
            test_id,
            tt_id,
            vocab,
            reading,
            listening,
            total,
            answers,
        },
    }).done(function(res) {
        console.log(res)
    });
}

function trial_registration(cat_id, user_id) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: VNCMS_URL + "/stage/ajax/trial_registration",
        data: { cat_id: cat_id, user_id: user_id },
        cache: false,
        success: function(data) {
            Swal.queue([{
                title: "Thông báo",
                type: data.status,
                text: data.message,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    if (data.status === "success") {
                        location.reload();
                    }
                },
            }, ]);
        },
    });
}



// đăng ký thi thử phuonghv2022

function ajax_trial() {

    $(".js-loading-icon").removeClass("d-none");
    $(".js-submit-btn").addClass("d-none");


    $.ajax({
        type: "POST",
        dataType: 'json',
        url: VNCMS_URL + "/ajax/trial",
        data: $('.trial_email_form').serialize(),
        cache: false,
        success: function(data) {
            $(".js-loading-icon").addClass("d-none");
            $(".js-submit-btn").removeClass("d-none");

            Swal.queue([{
                title: 'Thông báo',
                type: "success",
                text: "Đăng ký thành công"
            }])
            $('.trial_email_form').trigger("reset");
           location.href = "https://koseionline.vn/";
        }
    });
}





// End



function setMenuClicked(t) {
    $.cookie("menu_a_clicked", t, { path: "/", expires: 1 });
}

function getMenuClicked() {
    return $.cookie("menu_a_clicked");
}

function deletetMenuClicked() {
    $.cookie("menu_a_clicked", null, { path: "/", expires: 1 });
}

function setMenuActive() {
    var i;
    var base_url = VNCMS_URL + "/";
    i = getMenuClicked();
    if (i == 0 || i == null || window.location == base_url) i = 0;
    $("#menu_a_" + i).addClass("active");
}

$(function() {
    let token = true;
    // let tmpKey = "";

    $(".js-lesson-search").on("keyup input", function(e) {
        const key = $(this).val();
        const cat_id = $(this).data("catId");

        if (key === "") {
            $(".aside-2__search-result").removeClass("show");
            return;
        }

        if (!token) {
            return;
        }

        token = false;

        $.ajax({
            url: VNCMS_URL + "/ajax/searchlesson",
            type: "post",
            dataType: "json",
            data: {
                key,
                cat_id,
            },
        }).done(function(res) {
            token = true;

            if (!Array.isArray(res)) {
                $(".aside-2__search-result").removeClass("show");
                return;
            }

            showSearchResult(res);
        });
    });
});

function showSearchResult(lessons) {
    const $result = $(".aside-2__search-result");
    let html = "";

    $result.empty();

    if (!lessons.length) {
        $result.removeClass("show");
        return;
    }

    lessons.map(function(lesson) {
        html += `<a href="${lesson.url}">${lesson.name}</a>`;
    });

    $result.html(html);
    $result.addClass("show");
}

$(function() {
    $test = $(".js-test");
    $testAnswers = $test.data("answers");

    if (!$test || !$testAnswers) return;

    showAnswers($testAnswers);
});

$(function() {
    $(".js-payment-form").on("submit", function(e) {
        e.preventDefault();

        $(".js-payment-submit").attr("disabled", true);

        $.ajax({
            url: VNCMS_URL + "/ajax/payment",
            type: "post",
            dataType: "json",
            data: $(this).serialize(),
        }).done(function(res) {
            $(".js-payment-submit").attr("disabled", false);

            Swal.queue([{
                title: "Thông báo",
                type: res.status,
                text: res.message,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    if (res.status === 1) {
                        location.reload();
                    }
                },
            }, ]);
        });
    });
});

$(function() {
    $(".js-promo-btn").on("click", function(e) {
        e.preventDefault();

        let code = $(".js-promo-code").val();

        if (!code) {
            return;
        }

        $.ajax({
            url: VNCMS_URL + "/ajax/check_coupon",
            type: "post",
            dataType: "json",
            data: {
                code: code,
            },
        }).done(function(res) {
            if (res.status) {
                $(".js-promo-status").html(`
        <div class="alert alert-success py-1 mt-2 mb-0">
          Mã khuyến mại hợp lệ!
          <br />
          Bạn được giảm giá <strong>${res.price_vn}Vnđ</strong> hoặc <strong>${res.price_jp}¥</strong> khi thanh toán khoá học này.
        </div>
        `);
            } else {
                $(".js-promo-status").html(`<div class="alert alert-danger py-1 mt-2 mb-0">${res.message}</div>`);
            }
        });
    });
});