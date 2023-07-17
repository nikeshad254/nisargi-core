<div class="changePass">

    <h3 class="heading">Change password</h3>
    
    <small>once password is changed cant be undone!</small>
    <form action="" method="post" class="passForm">

        <div class="inp-label">
            <label for="opass">Origin password: </label>
            <input type="password" name="opass" class="pass" value="<?=$opass?>">
        </div>


        <div class="inp-label">
            <label for="npass">New password: </label>
            <input type="password" name="npass" class="pass" value="<?=$npass?>">
        </div>

        <div class="inp-label">
            <label for="cnpass">Confrim password: </label>
            <input type="password" name="cnpass" class="pass" value="<?=$cnpass?>">
        </div>

        <div class="show-pass">
            <input type="checkbox" id="showPass">
            <small>show password</small>
        </div>

        <button type="submit" class="btn">Change Password</button>
    </form>
</div>

<script>
    let allPass = document.querySelectorAll('.pass')
    let showPass = document.querySelector('#showPass')

    showPass.addEventListener("change", ()=>{
        if(showPass.checked){
            allPass.forEach(inp => {
                inp.type = 'text'
            });
        }else{
            allPass.forEach(inp =>{
                inp.type = 'password'
            })
        }
    })
</script>