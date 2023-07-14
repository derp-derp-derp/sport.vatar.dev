<?php require_once 'template/header.php'; ?>

<style type="text/css">
#deconstructor {
    background-image: repeating-linear-gradient(45deg, #444444 0, #444444 1px, #0e1617 0, #0e1617 50%);
    background-size: 10px 10px;
    position: fixed;
    left: 50%;
    transform: translate(-50%, 0);
    height: 2024px;
    width: 100%;
}
    
img {
    position: absolute;
    top: 0px;
    left: 0px;
    height: 700px;
    width: auto;
}

#sportvatar_slider {
    position: absolute;
    top: 750px;
    left: 50%;
    transform: translate(-50%, 0);
    width: 50%;
}

    input[type=range] {
        -webkit-appearance: none;
    }
    
    input[type=range]:focus {
       outline: none;
    }
    
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        background: #ddfc60;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
    }
    
    input[type=range]::-webkit-slider-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -14px;
    }
    
    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #ddfc60;
    }
    
    input[type=range]::-moz-range-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        background: #ddfc60;
        border-radius: 1.3px;
        border: 0.2px solid #010101;
    }
    
    input[type=range]::-moz-range-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
    }
    
    input[type=range]::-ms-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        background: transparent;
        border-color: transparent;
        border-width: 16px 0;
        color: transparent;
    }
    
    input[type=range]::-ms-fill-lower {
        background: #2a6495;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    
    input[type=range]::-ms-fill-upper {
        background: #3071a9;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    
    input[type=range]::-ms-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
    }
    
    input[type=range]:focus::-ms-fill-lower {
        background: #ddfc60;
    }
    
    input[type=range]:focus::-ms-fill-upper {
        background: #ddfc60;
    }

/* mobile */
@media screen and (max-width: 800px) {

}
</style>

<?php
    subpage_heading(
        '<em>The Deconstructor 5000</em>&#160;(beta)',
        'Drag the slider bar to see this Sportvatar\'s individual components.'
    );
    
    $mint = '';

    if(isset($_GET['mint']))
    {   
        $mint = $_GET['mint'];
    }

    if(is_numeric($mint) && ($mint <= $num_sportvatars))
    {
        $sportvatar = general_query("SELECT * FROM sportvatars WHERE mint_number=". $mint .";");
        $sportvatar = $sportvatar[0];
    }
    else
    {
        echo '<p align="center">No Sportvatar #'. $mint .' found.<br>Please double-check the mint #.<br><br>If it\'s a new mint, try again in 15 minutes.</p>';
        exit;
    }
?>

<div id="deconstructor">
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_body_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_clothing_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_mouth_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_facial_hair_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_hair_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_eyes_id']; ?>"></div>
    <div><img src="https://sportvatar.com/api/image/template/<?= $sportvatar['trait_nose_id']; ?>"></div>
    
    <?php if($sportvatar['sportbit_accessory_id'] > 0){ ?>
    <div><img id="accessory_sportbit" src="https://sportvatar.com/api/image/template/<?= $sportvatar['sportbit_accessory_id']; ?>"></div>
    <?php } ?>
    
    <div><img id="full_sportvatar_image" src="https://sportvatar.com/api/image/<?= $sportvatar['mint_number']; ?>"></div>

    <input type="range" min="0" max="10" value="0" class="sportvatar_slider" id="sportvatar_slider">
</div>

<script>
const sportvatar_slider = document.getElementById('sportvatar_slider');
sportvatar_slider.addEventListener('input', handleChange);

function handleChange(e) {
    const imgs = document.querySelectorAll('#deconstructor img');
    const {value, max} = e.target;
    
    for (var i = 0, len = imgs.length; i < len; i++)
    {
        switch (i)
        {
            case 1: // clothing
                imgs[i].style.left = `${((value*max)*(i+4))}px`;
                break;
            case 2: // mouth
                imgs[i].style.left = `${((value*max)*(i+4.5))}px`;
                break;
            case 3: // facial hair
                imgs[i].style.left = `${((value*max)*(i+3.5))}px`;
                break;
            case 4: // hair
                imgs[i].style.left = `${((value*max)*(i+5.5))}px`;
                break;
            case 5: // eyes
                imgs[i].style.left = `${((value*max)*(i+6.5))}px`;
                break;
            case 6:  // nose
                imgs[i].style.left = `${((value*max)*(i+2.5))}px`;
                break;
        }
        
        // sportbit accessory (optional)
        document.getElementById('accessory_sportbit').style.left = `${((value*max)*(i+3.5))}px`;
        
        // full sportvatar image
        document.getElementById('full_sportvatar_image').style.left = `${((value*max)*(i+9))}px`;
    }
}
</script>
<?php require_once 'template/footer.php'; ?>