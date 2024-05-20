<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
      <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <style>
      .sidebar {
        position: fixed;
        top: 3%;
        left: 20%;
        width: 200px; /* Adjust as needed */
        height: 90%;
        background-color: #223d63; /* Changed sidebar background color */
        padding: 20px;
        color: #fff; /* Changed text color to white */
      }

      .progress-bar {
        height: 20px;
        background-color: #e4e4e4;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
      }

      .progress-bar-inner {
        height: 100%;
        background-color: #6cb2eb;
        width: 0;
        transition: width 0.3s ease;
        display: flex;
        justify-content: center;
        font-size: small;
        font-weight: 700;
      }

      .content {
        margin-left: 200px; /* Sidebar width */
        padding: 20px;
      }
    </style>
  </head>
  <body class="bg-gray-100">
    <div class="sidebar">
      <h1 class="text-2xl font-bold mb-4">Quiz</h1>
      <div class="progress-bar">
        <div class="progress-bar-inner"></div>
      </div>
      <div id="timer">Time Left: <span id="time">10:00</span></div>
      <div id="student-info">
        <h2 class="text-lg font-semibold mt-6 mb-2">Employee Info</h2>
        <p>Name: John Doe</p>
        <p>Address: Bulacan</p>
        <p>Email: jd@gmail.com</p>
      </div>
    </div>

    <div class="content">
      <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
        <form id="quizForm" class="space-y-8">
        
        <?php
        $counter = 0;
        // print_r($questions);
        foreach($questions as $v ):
        $counter++;
        ?>
        
          <div class="question">
            <p class="font-semibold"><?php echo $counter.'. '.$v['question'] ?></p>
            <label class="block">
              <input
                type="radio"
                name="<?php echo 'choice'.$counter ?>"
                id="<?php echo $v['question_id'] ?>"
                value="a"
                class="mr-2"
              />
              <?php echo $v['a'] ?>
            </label>
            <label class="block">
              <input
                type="radio"
                name="<?php echo 'choice'.$counter ?>"
                id="<?php echo $v['question_id'] ?>"
                value="b"
                class="mr-2"
              />
              <?php echo $v['b'] ?>
            </label>
            <label class="block">
              <input
                type="radio"
                name="<?php echo 'choice'.$counter ?>"
                id="<?php echo $v['question_id'] ?>"
                value="c"
                class="mr-2"
              />
              <?php echo $v['c'] ?>
            </label>
            <label class="block">
              <input type="radio" 
              name="<?php echo 'choice'.$counter ?>" 
              id="<?php echo $v['question_id'] ?>" 
              value="d" 
              class="mr-2"
             />
             <?php echo $v['d'] ?>
            </label>
          </div>
        <?php endforeach ?>
          <!-- More questions... -->
        </form>
      </div>
    </div>
    <button class="btn" onclick="submitExam()" >Submit</button>
    <script>
      const radioButtons = document.querySelectorAll('input[type="radio"]');
      const progressBar = document.querySelector(".progress-bar-inner");
      const progressStep = ( 100 / <?php echo intVal(count($questions)) ?> ); // Assuming 5 questions, so each question represents 20% progress
      // 100 / total questions

      radioButtons.forEach((radioButton) => {
        radioButton.addEventListener("change", updateProgressBar);
      });

      // update progress bar when page reload
      setTimeout(() => {
        updateProgressBar();
      }, 2000);

      function updateProgressBar() {
        const answeredCount = document.querySelectorAll(
          'input[type="radio"]:checked'
        ).length;
        const progressWidth = answeredCount * progressStep + "%";
        progressBar.style.width = progressWidth;
        // progressBar.textContent = progressWidth.toFixed(2);
      }

      const duration = <?php echo $duration ?>; // Duration of the exam in minutes
      let timer = localStorage.getItem("timer") || duration * 60; // Get remaining time from local storage or set default
      let countdownTimer;

      // Function to update timer display
      function updateTimer() {
        const minutes = Math.floor(timer / 60);
        let seconds = timer % 60;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        document.getElementById("time").textContent = `${minutes}:${seconds}`;
      }

      // Function to save timer to local storage
      function saveTimer() {
        localStorage.setItem("timer", timer);
      }

      // Function to start the countdown timer
      function startTimer() {
        countdownTimer = setInterval(() => {
          // saveUserAnswers();
          updateTimer();
          saveTimer();
          if (--timer < 0) {
            clearInterval(countdownTimer);
            document.getElementById("time").textContent = "Time Up!";
            // Call a function to submit the exam automatically when time runs out
            // submitExam();
            disableInputFields();
          }
        }, 1000);
      }

      // Start the timer when the page is loaded
      startTimer();

      // Function to disable input fields when time is up
      function disableInputFields() {
        document.querySelectorAll('input[type="radio"]').forEach((input) => {
          input.disabled = true;
        });
      }

      // // Add event listener to save user answers when they change
      document.querySelectorAll('input[type="radio"]').forEach((input) => {
        input.addEventListener("input", () => {
          saveUserAnswers();
        });
      });
      // Function to save user answers to local storage
      function saveUserAnswers() {
        const answers = {};
        document.querySelectorAll('input[type="radio"]').forEach((input) => {
          if (input.checked) {
            answers[input.name] = [input.value, input.id] ;
          }
        });
        localStorage.setItem("userAnswers", JSON.stringify(answers));
      }

      // Function to restore user answers from local storage
      function restoreUserAnswers() {
        const answers = JSON.parse(localStorage.getItem("userAnswers"));
        if (answers) {
          Object.keys(answers).forEach((name) => {
            document.querySelector(
              `input[name="${name}"][value="${answers[name][0]}"]`
            ).checked = true;
          });
        }
      }
      // Restore user answers when the page is loaded
      restoreUserAnswers();

      // Function to submit the exam
      function submitExam(){
        const answers = JSON.parse(localStorage.getItem("userAnswers"));
        // You need to replace this with your actual URL and appropriate data
        const submitUrl = "<?php echo base_url('emp_training/submit_exam') ?>";
        $.ajax({
          type: "POST",
          url: submitUrl,
          data: { id: <?php echo $ass_id ?>, data: answers },
          success: function (response) {
            // Handle success response
            console.log(response);
          },
          error: function (xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
          },
        });
      }

      // Event listener for submit button click
      document
        .getElementById("submitBtn")
        .addEventListener("click", function () {
          clearInterval(countdownTimer); // Stop the timer
          submitExam(); // Submit the exam
          disableInputFields(); // Disable input fields
        });
    </script>
  </body>
</html>
