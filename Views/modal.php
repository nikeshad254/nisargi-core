<style>
    /* Style the modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        width: 100svw;
        height: 100svh;
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Style the modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 2px solid #000;
        border-bottom: 4px solid;
        border-right: 3px solid;
        width: 40%;
        min-height: 50%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        justify-content: center;
        position: relative;
        border-radius: 10px;
    }

    .modal-content .icon {
        height: 5rem;
        width: 5rem;
        border: 1px solid var(--gray-500);
        border-radius: 50%;
        padding: 0.3rem;
    }

    .modal-content .title {
        font-weight: 600;
        font-size: 1.3rem;
        text-transform: uppercase;
    }

    .modal-content .msg {
        width: 90%;
        text-align: center;
    }

    .modal-content .cross {
        height: 2.5rem;
        width: 2.5rem;
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        cursor: pointer;
    }
</style>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <img src="Views/images/icons/tick.svg" alt="" class="icon">
        <img src="Views/images/icons/cross.svg" onclick="closeModal()" class="cross" />
        <p class="title">This is the Title</p>
        <p class="msg">This is a modal! and the message</p>
    </div>

</div>

<script>
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function openModal(title, msg, status, time, link = "") {
        let myModal = document.getElementById("myModal");
        myModal.style.display = "block";
        myModal.querySelector('.title').innerHTML = title;
        myModal.querySelector('.msg').innerHTML = msg;
        if (status == 0) { // 0 for tick
            myModal.querySelector('.icon').src = 'Views/images/icons/tick.svg';
        } else if (status == 1) { // 1 for cross
            myModal.querySelector('.icon').src = 'Views/images/icons/cross.svg';
        }
        if (time > 0) {
            setTimeout(() => {
                closeModal();
                // if (link ===  undefined || link === null){ link = "" }
                window.location.href = link;
            }, time * 1000);
        }

    }
</script>