<div id="chatbot-container" class="<?= get_bot_cookie() ? "" : "bot-hidden"; ?>">
    <div class="behinder-blur-light"></div>
    <iframe
        src="https://app.gptmaker.ai/widget/3E846D0FBA9B12AF7EF11689122422E7/iframe"
        width="100%"
        height="100%"
        style="border: none;"
        allow="microphone; clipboard-read; clipboard-write">
    </iframe>
</div>
<div id="nandi-bot" onclick="change_nandibot()">
    <img src="images/nandibot.png" width="100%" height="auto">
    <span class="visible"><?= get_translation('hello_can_i_help'); ?></span>
</div>
<script>
    function change_nandibot() {
        if ($('#chatbot-container').hasClass('bot-hidden')) {
            $('#chatbot-container').removeClass('bot-hidden')
            $('#nandi-bot span').removeClass('visible')
        } else {
            $('#chatbot-container').addClass('bot-hidden')
            $('#nandi-bot span').addClass('visible')
        }

        $.ajax({
            type: "POST",
            url: "api.php",
            dataType: 'json',
            data: {
                action: 'change_bot',
                visivel: !$('#chatbot-container').hasClass('bot-hidden'),
            },
            error: function(error) {
                manage_error_response(error)
            }
        });
    }
</script>