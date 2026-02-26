
    <style>
        
        .construction-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); */
            max-width: 100vw;
            height: 70vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 5.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 30px;
        }

        .icon {
            font-size: 16rem;
            color: #ff6f61;
            margin-bottom: 20px;
        }

        .countdown {
            font-size: 3.5rem;
            color: #333;
            margin-top: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }
            p {
                font-size: 1rem;
            }
            .icon {
                font-size: 3rem;
            }
            .countdown {
                font-size: 1.2rem;
            }
        }
    </style>

    <div class="construction-container">
        <!-- Construction Icon -->
        <div class="icon">🚧</div>
        
        <!-- Heading -->
        <h1>Under Construction</h1>
        
        <!-- Message -->
        <p>We're working hard to bring you something amazing! Please check back soon.</p>
        
        <!-- Optional Countdown Timer -->
        <div class="countdown" id="countdown"></div>
    </div>

    <!-- Optional JavaScript for Countdown Timer -->
    <script>
        // Set the date we're counting down to (4 hours from now)
        const countDownDate = new Date().getTime() + (4 * 60 * 60 * 1000);

        // Update the countdown every 1 second
        const countdownFunction = setInterval(() => {
            // Get today's date and time
            const now = new Date().getTime();

            // Find the distance between now and the countdown date
            const distance = countDownDate - now;

            // Calculate hours, minutes, and seconds
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the countdown element
            document.getElementById("countdown").innerHTML =
                `Coming in: ${hours}h ${minutes}m ${seconds}s`;

            // If the countdown is over, display a message
            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("countdown").innerHTML = "We're Live!";
            }
        }, 1000);
    </script>
