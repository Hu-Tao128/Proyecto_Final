<?php include "includes/header.php";

require_once 'includes/config/MySQL_ConexionDB.php';
require_once 'functions.php';
?>

<section class="faq-section">
    <h2>Frequently asked questions</h2>
    <div class="faq-item">
        <div class="faq-question">
            What can I do on the page?
            <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
            <div class="scrollable-paragraph">
            On the page you can perform various actions, such as requesting vacations, applying for internal company promotions, making a complaint, reporting an incident that has happened in the company, viewing your personal information, and sending a report for not attending work.

            </div>
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question">
            Who manages permits and requests?
            <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
            Human resources personnel and your supervisor are those who accept and view the requests and reports you make.
        </div>
    </div>
    <div class="faq-item">
        <div class="faq-question">
            Where can I change my password?
            <span class="toggle-icon">+</span>
        </div>
        <div class="faq-answer">
            In the personal information part, in the password section, you change it to a new one and save the changes made, these will be saved in the database.
        </div>
    </div>
</section>
<br><br><br><br><br><br><br>
<script>
    document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', () => {
        const answer = question.nextElementSibling;
        const icon = question.querySelector('.toggle-icon');

        if (answer.classList.contains('open')) {
            answer.classList.remove('open');
            icon.textContent = '+';
        } else {
            document.querySelectorAll('.faq-answer.open').forEach(openAnswer => {
                openAnswer.classList.remove('open');
                openAnswer.previousElementSibling.querySelector('.toggle-icon').textContent = '+';
            });
            answer.classList.add('open');
            icon.textContent = '-';
        }
    });
});

</script>

<?php include "includes/footer.php" ?>