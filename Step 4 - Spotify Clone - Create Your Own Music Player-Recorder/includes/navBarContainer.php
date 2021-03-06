<div id="navBarContainer">

<nav class="navBar">
    <span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
        <img src="assets/images/icons/icon.png">
    </span>

    <div class="group">

    <div class="navItem">
            <span role='link' class="navItemLink" tabIndex='0' onclick='openPage("search.php")'>Search
                <img class="icon" alt="alt" src="assets/images/icons/search.png">
            </span>
        </div>

    </div>

    <div class="group">

        <div class="navItem">
        <span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse Your Music</span>
        </div>

        <div class="navItem">
        <span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your Music</span>
        </div>

        <div class="navItem">
        <span role="link" tabindex="0" onclick="openPage('newMusic.php')" class="navItemLink">Create your own Music</span>
        </div>

        <div class="navItem">
        <span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
        </div>

    </div>

</nav>
</div>