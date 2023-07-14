<?php require_once 'template/header.php'; ?>

<style type="text/css">
.q_a_container {
    padding: 25px;
    border-bottom: 2px solid #ddfc60;
}

.question {
    cursor: pointer;
    font-weight: bold;
    font-size: 125%;
}

.answer {
    display: none;
    cursor: default;
    color: #ddfc60;
    font-weight: normal;
    padding: 10px;
}

    .answer ul {
        margin: 10px 0 0 20px;
    }

/* mobile */
@media screen and (max-width: 800px) {

}
</style>

<?php
    subpage_heading(
        'Questions &amp; Answers',
        'Select a question for more information.'
    );
    
    $possible_highlights = array (
        'Minted on day 1 (May 5th, 2023 UTC)',
        'First ever epic Sportvatar',
        'First ever legendary Sportvatar',
        'Minted by the creator of &lt;Project Name&gt;',
        'Maxed out &lt;ability stat name&gt;',
        'Meme mint number',
        'Milestone mint number',
        'Newest mint',
        'Single digit mint number',
        '2 digit mint number',
        'Repeater mint number',
        'Consecutive count up mint number',
        'Consecutive count down mint number',
        '&lt;Name&gt; from the Famous Sportvatars gallery',
        '#1-10 top score overall',
        '#1-10 top traits score',
        '#1-10 top Sportbits score',
    );
?>
            
<div class="q_a_container">
    <div class="question noselect">
        How does your rarity scoring work?

        <div class="answer noselect">
            
            <p style="font-weight: bold;">Traits:</p>
            <span class="fixed-width-font">( .01 / ( [number_of_sportvatars_with_same_trait] / [number_of_sportvatars] ) )</span>
            
            <p style="font-weight: bold;">Sportbits:</p>
            <span class="fixed-width-font">( .01 / ( [number_of_sportvatars_with_same_sportbit_equipped] / [number_of_sportvatars] ) )</span>
            
            <p style="font-weight: bold;">Total rarity score:</p>
            <span class="fixed-width-font">( [traits_score] + [sportbits_score] + [native_sportvatar_ability_average] )</span>
            
            <br>
            <p style="font-size: 75%;">Scoring method was heavily influenced by this great write up by <a href="https://raritytools.medium.com/ranking-rarity-understanding-rarity-calculation-methods-86ceaeb9b98c" target="_blank" class="text_link_bright">Rarity Tools</a>.</p>
        </div>
    </div>
</div>

<div class="q_a_container">
    <div class="question noselect">
        I just updated my Sportvatar - why haven't my scores and other information updated yet?

        <div class="answer noselect">
            <p>Your Sportvatar's image on the site will update instantly, but data updates usually take 15 minutes or less. You might also try clearing your browser's cache.</p>
                
            <p>Ping derp in Discord with your mint number if you're still not seeing updates after more than 30 minutes.</p>
        </div>
        
    </div>
</div>

<div class="q_a_container">
    <div class="question noselect">
        What are all of the possible highlights for a Sportvatar?

        <div class="answer noselect">

            <ul>
                <?php foreach($possible_highlights as $highlight){ ?>
                <li><?= $highlight; ?></li>
                <?php } ?>
            </ul>

        </div>
    </div>
</div>

<div class="q_a_container">
    <div class="question noselect">
        How can I contact you about the site?

        <div class="answer noselect">
            <p>Please ping <span style="font-family: monospace;">derp3x:0001</span> in Discord or email <a href="mailto:email@flov.dev" class="text_link">email@flov.dev</a>.</p>
        </div>
    </div>
</div>

<div class="q_a_container">
    <div class="question noselect">
        If my Sportvatar is listed on the marketplace is it still counted in my collection score?

        <div class="answer noselect">
            <p>Yep!</p>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.question').on( "click", function(){
        $('.answer').hide();
        $(this).find(".answer").show();
    });
});
</script>
<?php require_once 'template/footer.php'; ?>