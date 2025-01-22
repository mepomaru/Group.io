// Scrollify スクロール
$.scrollify({
    section: ".box", 
    scrollbars: false, 
    easing: "swing", 
    scrollSpeed: 700, 
    before: function (i, panels) {
        var ref = panels[i].attr("data-section-name");
        $(".pagination .active").removeClass("active");
        $(".pagination").find("a[href=\"#" + ref + "\"]").addClass("active");
    },
    afterRender: function () {
        var pagination = "<ul class=\"pagination\">";
        var activeClass = "";
        $(".box").each(function (i) {
            activeClass = "";
            if (i === $.scrollify.currentIndex()) {
                activeClass = "active";
            }
            pagination += "<li><a class=\"" + activeClass + "\" href=\"#" + $(this).attr("data-section-name") + "\"><span class=\"hover-text\">" + $(this).attr("data-section-name").charAt(0).toUpperCase() + $(this).attr("data-section-name").slice(1) + "</span></a></li>";
        });
        pagination += "</ul>";

        $("#box1").append(pagination);
        $(".pagination a").on("click", $.scrollify.move);
    }
});


// // Particles.js 星
// particlesJS("particles-js", {
//     "particles": {
//         "number": { "value": 346, "density": { "enable": true, "value_area": 800 } },
//         "color": { "value": "#ffffff" },
//         "shape": { "type": "circle", "stroke": { "width": 0 } },
//         "opacity": { "value": 1, "random": true, "anim": { "enable": true, "speed": 3, "opacity_min": 0, "sync": false } },
//         "size": { "value": 2, "random": true, "anim": { "enable": false, "speed": 4, "size_min": 0.3, "sync": false } },
//         "line_linked": { "enable": false },
//         "move": { "enable": true, "speed": 120, "direction": "none", "random": true, "straight": true, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 600 } }
//     },
//     "interactivity": {
//         "detect_on": "canvas",
//         "events": { "onhover": { "enable": false }, "onclick": { "enable": false }, "resize": true }
//     },
//     "retina_detect": true
// });

// Scrollifyの設定部分はそのままとする

// クリックイベントの設定をjQueryからVanilla JavaScriptに修正
const goRegister = document.querySelector('.goRegister');

goRegister.addEventListener("click", () => {
    document.querySelector(".active").classList.remove("active");
    document.querySelector(".pagination a[href=\"#Register\"]").classList.add("active");
});

// プレーンのアニメーションを設定する部分
const plane = document.querySelector('.plane');
const animationDuration = 10000; // 10秒
const pauseDuration = 30000; // 停止時間

function startPlaneAnimation() {
    plane.style.animation = `flyAcross ${animationDuration / 1000}s linear`;
    plane.style.animationPlayState = 'running';
    setTimeout(() => {
        plane.style.animationPlayState = 'paused';
        resetPlaneAnimation();
        setTimeout(startPlaneAnimation, pauseDuration);
    }, animationDuration);
}

function resetPlaneAnimation() {
    plane.style.animation = 'none';
    plane.offsetHeight; // リフローを促すための処理（必要な場合のみ）
    plane.style.animation = null;
}

// プレーンのアニメーションを開始する
startPlaneAnimation();

// バルーンのアニメーションを設定する部分
const balloons = document.querySelectorAll('.balloon');

function startBalloonAnimation() {
    balloons.forEach((balloon) => {
        const speed = Math.random();
        balloon.style.animation = `flyAcross ${animationDuration / 1000}s linear`;
        balloon.style.animationPlayState = 'running';
        setTimeout(() => {
            balloon.style.animationPlayState = 'paused';
            resetBalloonAnimation(balloon); // Pass 'balloon' here
            setTimeout(startBalloonAnimation, pauseDuration);
        }, animationDuration);
    });
}

function resetBalloonAnimation(balloon) {
    balloon.style.animation = 'none';
    balloon.offsetHeight; // Trigger reflow if needed
    balloon.style.animation = null;
}

// Call startBalloonAnimation to begin the animation cycle
startBalloonAnimation();
