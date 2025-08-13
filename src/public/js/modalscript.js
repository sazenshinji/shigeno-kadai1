
    // ボタンをクリックしてモーダルを開く
    document.querySelectorAll("[data-modal]").forEach(button => {
      button.addEventListener("click", () => {
        const modalId = button.getAttribute("data-modal");
        document.getElementById(modalId).style.display = "block";
      });
    });

    // 閉じるボタン
    document.querySelectorAll("[data-close]").forEach(closeBtn => {
      closeBtn.addEventListener("click", () => {
        const modalId = closeBtn.getAttribute("data-close");
        document.getElementById(modalId).style.display = "none";
      });
    });

    // モーダル背景クリックで閉じる
    window.addEventListener("click", (event) => {
      if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
      }
    });



