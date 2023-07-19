<!-- this is a upload image layout onclick change image and preview too -->

<?php

// necessary varibles to integrate
// $name = as file upload name
// $initial_img = as initial display image
// $required = for setting if photo is required or not
// $value = to add value to files used while updating

// echo $initial_img;

if(!isset($required)){
    $required = false;
}

if(!isset($value)){
    $value = '';
}

if(!isset($name)){
    echo 'integration uploadImg failed';
    exit;
}

if(!isset($initial_img)){
    $initial_img = 'Views/images/blank_img.png';
}

?>

<style>
    label.label input[type="file"] {
        position: absolute;
        top: -1000px;
    }

    .label {
        cursor: pointer;
        border: 2px solid var(--gray-400);
        border-radius: 5px;
        overflow: hidden;
        padding: 5px 15px;
        margin: 5px;
        height: 10rem;
        width: 10rem;
        display: inline-block;
        position: relative;
    }

    .label span {
        position: absolute;
        bottom: 0rem;
        left: 0;
        font-size: 0.8rem;
        font-weight: 600;
        letter-spacing: 1px;
        color: #ffffff;
        background-color: #000000ad;
        text-align: center;
        width: 100%;
    }

    .inputImg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .label:hover {
        background: #5cbd95;
    }

    .label:active {
        background: #9fa1a0;
    }

    .label:invalid+span {
        color: #000000;
    }

    .label:valid+span {
        color: #ffffff;
    }
</style>

<label class="label">
    <img class="inputImg" src="<?=$initial_img?>">
    <input type="file" name="<?=$name?>" id="file" <?php if($value !== ''){ echo 'value="'.$value.'"';}?> <?=($required)? 'required': ''?> />
    <span>click to replace <?=$required?'*':''?></span>
</label>

<script>
    let fileBtn = document.querySelector('#file');
    let inputImg = document.querySelector('.inputImg');
    fileBtn.addEventListener('change', (e) => {
        let file = e.target.files[0];
        console.log(e.target.files);
        console.log(URL.createObjectURL(file));
        console.log(file.name);
        inputImg.src = URL.createObjectURL(file);
    })
</script>