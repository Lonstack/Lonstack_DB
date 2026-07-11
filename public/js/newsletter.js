document.addEventListener("DOMContentLoaded", function () {
    console.log("Newsletter JS Loaded");

    const form = document.getElementById("newsletterForm");

    if (!form) return;

    form.addEventListener("submit", async function (e) {

        e.preventDefault();

        const button = form.querySelector("button");
        const message = document.getElementById("newsletterMessage");
        const email = document.getElementById("newsletterEmail").value;

        button.disabled = true;
        button.innerHTML = "Subscribing...";

        try {

            const response = await fetch("/newsletter", {

                method: "POST",

                headers: {

                    "Content-Type": "application/json",

                    "X-CSRF-TOKEN":
                        document.querySelector('meta[name="csrf-token"]').content

                },

                body: JSON.stringify({

                    email: email

                })

            });

            const result = await response.json();

            message.innerHTML = result.message;

            if (result.success) {

                message.style.color = "#28a745";

                form.reset();

            } else {

                message.style.color = "#dc3545";

            }

        } catch (error) {

            message.style.color = "#dc3545";

            message.innerHTML = "Something went wrong. Please try again.";

        }

        button.disabled = false;

        button.innerHTML = `
            <span>Sign Up</span>
            <i class="icon-arrow-right"></i>
        `;

    });

});