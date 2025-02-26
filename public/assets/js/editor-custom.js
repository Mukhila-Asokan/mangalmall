document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    let csrfTokenMeta = document.querySelector('meta[name="_token"]');
	
    let csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

    function ajaxRequest(url, data, successCallback, errorCallback) {
        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => successCallback(data))
        .catch(error => errorCallback(error));
    }

    // User Toggle Script
    let userInfo = document.querySelector(".pg-user-info");
    let userLinks = document.querySelector(".pg-user-useful-links");

    if (userInfo && userLinks) {
        userInfo.addEventListener("click", function () {
            userLinks.classList.toggle("active");
            this.classList.toggle("active");
        });

        document.querySelector("body").addEventListener("click", function () {
            userLinks.classList.remove("active");
            userInfo.classList.remove("active");
        });
    }

    // Shape Load
    let shapeTab = document.getElementById("main_tab_shape");
    if (shapeTab) {
        shapeTab.addEventListener("click", function (e) {


			e.preventDefault();
			let ajax_url_element = document.getElementById("pg_ajax_url");
			if (!ajax_url_element) return;
		
			let ajax_url = ajax_url_element.dataset.ajax_url;
		
			fetch(ajax_url + "/cardinvitation/loadajax/shape", {
				method: "POST",
				headers: {
					"X-CSRF-TOKEN": document.querySelector('meta[name="_token"]').getAttribute('content'),
					"X-Requested-With": "XMLHttpRequest" // Helps Laravel detect AJAX request
				}
			})
			.then(response => response.text()) // Expect HTML, not JSON
			.then(html => {
				console.log("Loaded Shape HTML:", html); // Debugging
		
				let shapeContainer = document.querySelector(".pg-element-shape-loads");
				if (shapeContainer) {
					shapeContainer.innerHTML = html; // Insert entire Blade file content
				}
			})
			.catch(error => console.error("Error loading shapes:", error));

        });
    }

    // AI Image Generator
    let aiImageBtn = document.getElementById("pg_ai_images");
    if (aiImageBtn) {
        aiImageBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let ajax_url_element = document.getElementById("pg_ajax_url");
            if (!ajax_url_element) return;

            let ajax_url = ajax_url_element.dataset.ajax_url;
            let key_words_input = document.getElementById("ai_images_layer_gen");
            let image_size_input = document.getElementById("pg_openai_image_size");

            if (!key_words_input || !image_size_input) return;

            let key_words = key_words_input.value;
            let image_size = image_size_input.value;

            if (key_words === "") {
                alert("Enter a keyword");
                return;
            }

            let waitMessage = document.getElementById("pg_wait_message");
            if (waitMessage) waitMessage.style.display = "block";

            ajaxRequest(ajax_url + "/cardinvitation/loadajax/ai_image_generator", { key_words, image_size },
                function (res) {
                    if (waitMessage) waitMessage.style.display = "none";
                    let aiImageContainer = document.querySelector(".ed_append_ai_image");
                    if (aiImageContainer) aiImageContainer.innerHTML = res;
                },
                function (error) {
                    if (waitMessage) waitMessage.style.display = "none";
                    console.error("Error generating AI image:", error);
                }
            );
        });
    }

    // AI Text Generator
    let aiTextBtn = document.getElementById("pg_ai_text");
    if (aiTextBtn) {
        aiTextBtn.addEventListener("click", function (e) {
            e.preventDefault();
            let ajax_url_element = document.getElementById("pg_ajax_url");
            if (!ajax_url_element) return;

            let ajax_url = ajax_url_element.dataset.ajax_url;
            let search_key_input = document.getElementById("ai_images_layer");

            if (!search_key_input) return;

            let search_key_word = search_key_input.value;

            if (search_key_word === "") {
                alert("Enter a keyword");
                return;
            }

            let waitMessage = document.getElementById("pg_wait_message");
            if (waitMessage) waitMessage.style.display = "block";

            ajaxRequest(ajax_url + "/cardinvitation/loadajax/ai_text_generator", { search_key_word },
                function (res) {
                    if (waitMessage) waitMessage.style.display = "none";
                    let result = res;
                    if (result.status === 200) {
                        let textCopyContainer = document.querySelector(".pg-sidebar-input.pg-ai-text-copy");
                        if (textCopyContainer) textCopyContainer.style.display = "block";

                        let textArea = document.getElementById("ai_textarea");
                        if (textArea) textArea.value = result.content_data.trim();

                        if (waitMessage) waitMessage.innerHTML = result.message;
                    } else {
                        if (waitMessage) waitMessage.innerHTML = result.message;
                    }
                },
                function (error) {
                    if (waitMessage) waitMessage.style.display = "none";
                    console.error("Error generating AI text:", error);
                }
            );
        });
    }

    // Copy AI Text to Clipboard
    let aiTextCopyBtn = document.getElementById("ai_text_copy");
    if (aiTextCopyBtn) {
        aiTextCopyBtn.addEventListener("click", function () {
            let ai_textarea = document.getElementById("ai_textarea");
            if (!ai_textarea) return;

            ai_textarea.select();
            document.execCommand("copy");

            let waitMessage = document.getElementById("pg_wait_message");
            if (waitMessage) waitMessage.innerHTML = "Copied";
        });
    }
});