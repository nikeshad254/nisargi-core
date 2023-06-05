<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <img src="Views/images/icons/tick.svg" alt="" class="icon">
    <img src="Views/images/icons/cross.svg" onclick="closeModal()" class="cross"/>
    <p class="title">This is the Title</p>
    <p class="msg">This is a modal! and the message</p>
</div>

</div>

<script>
function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

function openModal(title, msg, status, time) {
    let myModal = document.getElementById("myModal");
    myModal.style.display = "block";
    myModal.querySelector('.title').innerHTML = title;
    myModal.querySelector('.msg').innerHTML = msg;
    if(status == 0){    // 0 for tick
        myModal.querySelector('.icon').src ='Views/images/icons/tick.svg';
    }else if(status == 1){  // 1 for cross
        myModal.querySelector('.icon').src = 'Views/images/icons/cross.svg';
    }
    if(time>0){
        setTimeout(()=>{
            closeModal();
        }, time*1000);
    }
}
</script>