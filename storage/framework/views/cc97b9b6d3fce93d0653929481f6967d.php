<style>
    .cookie-card {
        display: none;
        margin-left: 10px;
        margin-bottom: 20px;
        border-radius: 15px;
        width: 390px;
        height: fit-content;
        background-color: rgb(246, 245, 245);
        position: fixed;
        bottom: 20px;
        box-shadow: 3px 4px 6px rgba(0, 0, 0, 0.38);
        padding: 15px;
    }

    .cookie-title {
        font-size: 20px;
        font-weight: bold;
        color: rgb(31 41 55);
    }

    .cookie-description {
        position: relative;
        top: 25px;
        font-size: .82em;
        text-align: center;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: rgb(75 85 99);

    }

    .cookies-policy {
        color: rgb(31 41 55);
        text-decoration: underline;
    }

    .cookies-policy:hover {
        text-decoration: none;
    }

    .cookies-policy:active {
        color: rgba(31, 41, 55, 0.61);
    }

    .accept-button {
        font-size: 13px;
        cursor: pointer;
        font-weight: bold;
        border: 1px solid dimgray;
        border-radius: 5px;
        width: 350px;
        /*height: 35px;*/
        background-color: rgba(0, 0, 0, 0.09);
        position: relative;
        /*left: 115px;*/
        /*top: 20px;*/
        margin: 5px;
        margin-top: 10px;
    }

    .accept-button:hover {
        background-color: #74D7AA;
        color: #fff;
    }

    .accept-button:active {
        font-weight: 100;
    }

    .accept-section {
        width: fit-content;
        display: flex;
        flex-direction: column;
        margin: auto;
        /*margin-bottom: 5px;*/
    }

    .exit-button {
        position: absolute;
        top: 17px;
        right: 17px;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .exit-button:hover {
        background-color: #ddd;
        color: white;
    }
    .svgIconCross {
        height: 10px;
    }

    .head-section {
        width: fit-content;
        margin: auto;
    }

</style>

<script type="text/javascript">
    function cookiesPolicyBar() {
        // Check cookie
        if ($.cookie('kandseu') != "active") {
            $('#cookie_card').show();
        }

        $(document).on('click', '#accept_all', function () {

            $.cookie('kandseu', 'active', {expires: 365, path: "/;SameSite=Lax", secure: false});
            $('#cookie_card').hide();
        });

        $(document).on('click', '#accept_necessary', function () {

            $.cookie('kandseu', 'active', {expires: 365, path: "/;SameSite=Lax", secure: false});
            $('#cookie_card').hide();
        });

    }
    $(document).ready(function () {
        cookiesPolicyBar();
    });

</script>

<div class="cookie-card" id="cookie_card">
    <div class="head-section">
        <span class="cookie-title">🍪 <?php echo e(__('home.cookie_head')); ?></span>
    </div>
    <p class="cookie-description">
        <?php echo e(__('home.cookie_message')); ?>

    </p>
    <div class="button-section">
        <div class="accept-section">
            <button class="accept-button" id="accept_all"><?php echo e(__('home.cookie_accept_all')); ?></button>
            <button class="accept-button" id="accept_necessary"><?php echo e(__('home.cookie_accept_necessary')); ?></button>
        </div>
    </div>
    <button class="exit-button" id="close_btn" onclick="hide_cookie_card()">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 162 162"
            class="svgIconCross"
        >
            <path
                stroke-linecap="round"
                stroke-width="17"
                stroke="black"
                d="M9.01074 8.98926L153.021 153"
            ></path>
            <path
                stroke-linecap="round"
                stroke-width="17"
                stroke="black"
                d="M9.01074 153L153.021 8.98926"
            ></path>
        </svg>
    </button>
    <script>
        function hide_cookie_card()
        {
            document.querySelector('#cookie_card').style.display = 'None';
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\SRV!^\resources\views/frontend/cookie_card.blade.php ENDPATH**/ ?>